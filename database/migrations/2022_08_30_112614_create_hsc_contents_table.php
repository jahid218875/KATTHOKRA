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
        Schema::create('hsc_contents', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id');
            $table->string('paper_id');
            $table->string('chapter_id');
            $table->string('type_id');
            $table->text('editor1');
            $table->text('editor2');
            $table->text('editor3');
            $table->text('editor4');
            $table->text('editor5');
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
        Schema::dropIfExists('hsc_contents');
    }
};