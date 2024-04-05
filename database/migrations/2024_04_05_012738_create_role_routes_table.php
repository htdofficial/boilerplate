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
        Schema::create('base_role_routes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('base_roles');

            $table->string('route_name');

            $table->timestamps();

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('base_users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_routes');
    }
};
