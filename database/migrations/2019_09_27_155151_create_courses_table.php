<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('teacher_id')->index();
            $table->string('title');
            $table->text('description');
            $table->string('short_description');
            $table->unsignedInteger('grade_id')->index();
            $table->unsignedInteger('subject_id')->index();
            $table->unsignedInteger('tuition_fee');
            $table->unsignedInteger('lp_complete_bonus');
            $table->unsignedTinyInteger('type')->index();
            $table->unsignedInteger('max_student')->nullable();
            $table->unsignedInteger('min_student')->default(0);
            $table->unsignedInteger('joined_students')->default(0);
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->unsignedTinyInteger('status')->index();
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
        Schema::dropIfExists('courses');
    }
}
