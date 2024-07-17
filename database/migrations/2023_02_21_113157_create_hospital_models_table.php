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
        Schema::create('hospital_models', function (Blueprint $table) {
            $table->id();
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('hospital');
            $table->string('image_first');
            $table->string('image_second')->nullable();
            $table->longText('description');
            $table->integer('status')->default(1);
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_models');
    }
};
