<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engineering_contents', function (Blueprint $table) {
            $table->id();
            $table->string('editor_name');
            $table->string('editor_id');
            $table->string('subject_id');
            $table->string('chapter_id');
            $table->string('type_id');
            $table->text('editor1');
            $table->text('editor2')->nullable();
            $table->text('editor3')->nullable();
            $table->text('editor4')->nullable();
            $table->text('editor5')->nullable();
            $table->string('course_type')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engineering_contents');
    }
};
