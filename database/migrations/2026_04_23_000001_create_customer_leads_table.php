<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->date('birth_date');
            $table->string('gender')->nullable();
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->string('province');
            $table->string('education_level', 20);
            $table->string('major')->nullable();
            $table->unsignedSmallInteger('graduation_year')->nullable();
            $table->string('learned_german', 10);
            $table->string('german_level', 10)->nullable();
            $table->string('ready_to_learn_german');
            $table->string('program_interest', 30);
            $table->string('desired_job', 30);
            $table->string('planned_departure_time')->nullable();
            $table->string('financial_capacity')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('current_job')->nullable();
            $table->string('registrant_type', 30)->nullable();
            $table->string('parent_phone', 20)->nullable();
            $table->string('marketing_source')->nullable();
            $table->text('consultation_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_leads');
    }
}
