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
        Schema::create('base_postables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('base_posts');

            $table->morphs('entity');

            $table->string('record_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('base_postables');
    }
};
