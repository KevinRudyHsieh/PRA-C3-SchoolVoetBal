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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('toernooi_id');
            $table->unsignedBigInteger('team_a_id');
            $table->unsignedBigInteger('team_b_id');
            $table->integer('team_a_score')->default('0');
            $table->integer('team_b_score')->default('0');
            $table->integer('matchField')->default('0');
            $table->string('status')->default('moet nog beginnen');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
