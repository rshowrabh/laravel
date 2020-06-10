<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstantTutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instant_tutors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_id')->index()->unsigned();
            $table->integer('tutor_id')->nullable();
            $table->boolean('status')->default(false);
            $table->string('skills')->nullable();
            $table->string('chapter')->nullable();
            $table->string('image')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('instant_tutors');
    }
}
