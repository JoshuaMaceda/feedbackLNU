<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigInteger('student_id')->primary()->unsigned();
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('first_name');
            $table->string('section');
            $table->string('school_year');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};

