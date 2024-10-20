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
            $table->id();
        $table->integer('type');
        $table->string('title');
        $table->string('title_sp');
        $table->string('title_fr');
        $table->string('sub_title');
        $table->string('subtitle_sp');
        $table->string('subtitle_fr');
        $table->enum('single_api', ['1', '0'])->default('0');
        $table->integer('image_id');
        $table->string('image');
        $table->integer('bg_image_id');
        $table->string('bg_image');
        $table->enum('status', ['0', '1'])->default('1');
        $table->timestamps();  // This adds created_at and updated_at columns
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
