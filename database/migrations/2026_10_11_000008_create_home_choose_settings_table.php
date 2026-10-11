<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHomeChooseSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('home_choose_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tagline')->nullable();
            $table->string('title')->nullable();
            $table->string('title_highlight')->nullable();
            $table->text('description')->nullable();
            $table->text('image_1')->nullable();
            $table->text('image_2')->nullable();
            $table->text('image_shape')->nullable();
            $table->timestamps();
        });

        DB::table('home_choose_settings')->insert([
            'tagline' => 'Why Choose Us',
            'title' => 'Tại sao nên chọn',
            'title_highlight' => 'VNTALENTHUB',
            'description' => 'VNTALENTHUB mang lại giải pháp du học nghề và lao động quốc tế uy tín và chuyên nghiệp nhất cho khách hàng. Chúng tôi sẽ đồng hành cùng các bạn trên chặng đường phía trước với giấc mơ xuất ngoại trong tầm tay, mọi thủ tục và chi phí sẽ được tối ưu nhất.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('home_choose_settings');
    }
}
