<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeChooseItemsTable extends Migration
{
    public function up()
    {
        Schema::create('home_choose_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable()->comment('URL ảnh/SVG icon');
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('status')->default(1)->comment('1=hiện, 0=ẩn');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_choose_items');
    }
}
