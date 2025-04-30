<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_teachers_table.php
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->string('teacher_id')->primary(); // not sure kun pure numerical it teacher_id so string lanay
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('first_name');
            $table->json('teacher_load');
            $table->string('department');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};

