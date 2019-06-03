<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('duration_hours')->default(0);
            $table->integer('duration_minutes');
            $table->integer('activity_type_id')->unsigned();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('entry_student', function (Blueprint $table) {
            $table->integer('entry_id')->unsigned()->index();
            $table->foreign('entry_id')->references('id')->on('entries')->onDelete('cascade');

            $table->integer('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

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
        Schema::dropIfExists('entries');
        Schema::dropIfExists('entry_student');
    }
}
