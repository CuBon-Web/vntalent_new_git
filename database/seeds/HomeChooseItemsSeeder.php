<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Gợi ý: php artisan db:seed --class=HomeChooseItemsSeeder
 * (chỉ thêm khi bảng trống)
 */
class HomeChooseItemsSeeder extends Seeder
{
    public function run()
    {
        if (DB::table('home_choose_items')->exists()) {
            return;
        }

        $now = now();
        $rows = [
            [
                'title' => 'TƯ VẤN MIỄN PHÍ',
                'description' => 'Nhận lộ trình du học từ A đến Z MIỄN PHÍ cùng Chuyên gia dày dặn kinh nghiệm',
                'icon' => url('frontend/img/support.svg'),
                'sort_order' => 1,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'HỖ TRỢ NHANH CHÓNG, CHÍNH XÁC, THUẬN TIỆN',
                'description' => 'Xây dựng lộ trình du học NHANH CHÓNG - CHÍNH XÁC - PHÙ HỢP cho từng học viên',
                'icon' => url('frontend/img/support.svg'),
                'sort_order' => 2,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'KHO HỌC BỔNG 100% ĐỘC QUYỀN',
                'description' => 'Cập nhật liên tục HỌC BỔNG 100%',
                'icon' => url('frontend/img/certified.svg'),
                'sort_order' => 3,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'REVIEW HỒ SƠ 1:1 CÙNG CHUYÊN GIA',
                'description' => 'Chuyên gia hàng đầu tại VNTALENTHUB giàu KINH NGHIỆM - CHUYÊN NGHIỆP review & hướng dẫn chuẩn bị hồ sơ du học',
                'icon' => url('frontend/img/team.svg'),
                'sort_order' => 4,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'HỖ TRỢ TOÀN DIỆN TỪ A-Z',
                'description' => 'Tư vấn chi tiết mọi bước từ APPLY đến HOÀN THIỆN thủ tục',
                'icon' => url('frontend/img/support.svg'),
                'sort_order' => 5,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('home_choose_items')->insert($rows);
    }
}
