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
        Schema::create('menu', function (Blueprint $table) {
            $table->id('id');
            $table->integer('module_id');
            $table->string('name', 255);
            $table->string('url', 255);
            $table->integer('parent_id');
            $table->string('icon', 255);
            $table->integer('sequence');
            $table->text('description');
            $table->tinyInteger('show_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
