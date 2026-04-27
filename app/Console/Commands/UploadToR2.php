<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Throwable;

class UploadToR2 extends Command
{
    private const MIME_BY_EXTENSION = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'map' => 'application/json',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'otf' => 'font/otf',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:r2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload all files from storage/app/public to Cloudflare R2';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $localPath = public_path('frontend'); // Đường dẫn thư mục cần upload
        $disk = Storage::disk('r2');

        if (!is_dir($localPath)) {
            $this->error("Thư mục frontend không tồn tại!");
            return self::FAILURE;
        }

        $this->info("Bắt đầu upload các file từ: $localPath");
        $successCount = 0;
        $failCount = 0;

        // Duyệt qua tất cả file trong thư mục frontend
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($localPath));
        foreach ($iterator as $file) {
            if ($file->isDir()) continue; // Bỏ qua thư mục

            $filePath = $file->getRealPath();
            $relativePath = str_replace($localPath . DIRECTORY_SEPARATOR, '', $filePath);
            $cloudPath = "frontend/" . str_replace('\\', '/', $relativePath); // Định dạng path cho Cloudflare

            try {
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $mimeType = self::MIME_BY_EXTENSION[$extension]
                    ?? (mime_content_type($filePath) ?: 'application/octet-stream');

                // Upload file lên Cloudflare
                $uploaded = $disk->put($cloudPath, file_get_contents($filePath), [
                    'visibility' => 'public',
                    'ContentType' => $mimeType,
                    'ContentDisposition' => 'inline',
                ]);

                if ($uploaded) {
                    $successCount++;
                    $this->info("Đã upload: $cloudPath");
                } else {
                    $failCount++;
                    $this->error("Upload thất bại (put trả về false): $cloudPath");
                }
            } catch (Throwable $e) {
                $failCount++;
                $this->error("Upload lỗi $cloudPath: " . $e->getMessage());
            }
        }

        $this->line("Success: {$successCount}, Fail: {$failCount}");
        $this->info("Upload hoàn tất!");

        return $failCount > 0 ? self::FAILURE : self::SUCCESS;
    }
}
