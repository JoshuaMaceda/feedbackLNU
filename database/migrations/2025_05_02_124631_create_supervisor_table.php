<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade'); // Foreign key from users table
            $table->unsignedBigInteger('supervisor_id')->primary(); // External ID source
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('department')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('supervisors');
    }
};
