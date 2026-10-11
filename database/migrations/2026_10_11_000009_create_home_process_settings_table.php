<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHomeProcessSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('home_process_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tagline')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('home_process_settings')->insert([
            'tagline' => 'Step by step',
            'title' => 'Quy trình hồ sơ',
            'description' => 'Quy trình hồ sơ của chúng tôi được thiết kế để phù hợp với nhu cầu và năng lực của từng học viên, đảm bảo quý khách có thể đạt được các mới trong quá trình học tập và phát triển.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('home_process_settings');
    }
}
