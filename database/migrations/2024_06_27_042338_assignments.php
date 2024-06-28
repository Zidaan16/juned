<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignment', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('classroom_id');
            $table->string('title');
            $table->boolean('is_expired')->default(false);
            $table->mediumInteger('number_of_question');
            $table->timestamp('expired_at');
            $table->timestamps();

            $table->foreign('classroom_id')->references('id')->on('classroom')->onDelete('cascade');
        });

        Schema::create('question', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->text('description');
            $table->boolean('is_essay')->default(false);
            $table->string('choice_1')->nullable();
            $table->string('choice_2')->nullable();
            $table->string('choice_3')->nullable();
            $table->string('choice_4')->nullable();
            $table->string('correct_answer')->nullable();
            $table->integer('point');

            $table->foreign('assignment_id')->references('id')->on('assignment')->onDelete('cascade');
        });

        Schema::create('score', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assignment_id');
            $table->integer('point');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assignment_id')->references('id')->on('assignment');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
