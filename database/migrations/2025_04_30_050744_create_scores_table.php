<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id(); // score_id
            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
            $table->text('comments')->nullable();
            $table->string('course_id');
            $table->set('professionalism', ['q1','q2','q3','q4','q5']);
            $table->set('commitment', ['q1','q2','q3','q4','q5']);
            $table->set('knowledge', ['q1','q2','q3','q4','q5']);
            $table->set('independent_learning', ['q1','q2','q3','q4','q5']);
            $table->set('management', ['q1','q2','q3','q4','q5']);
            $table->set('critical_factors', ['q1','q2','q3','q4','q5']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
};

