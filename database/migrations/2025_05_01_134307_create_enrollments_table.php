<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            $table->bigInteger('student_id');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade'); 
                    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}
