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
        Schema::create('engineering_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('group');
            $table->string('subject');
            $table->string('chapter');
            $table->string('type');
            $table->string('page');
            $table->string('save_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('engineering_bookmarks');
    }
};
