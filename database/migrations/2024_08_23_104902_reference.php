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
        Schema::table('thumbs', function(Blueprint $table){
            $table->foreign('id_usr_a') -> references('id')->on('users');
        });

        Schema::table('thumbs', function(Blueprint $table){
            $table->foreign('id_usr_b') -> references('id')->on('users');
        });

        Schema::table('mutuals', function(Blueprint $table){
            $table->foreign('id_usr_a') -> references('id')->on('users');
        });

        Schema::table('mutuals', function(Blueprint $table){
            $table->foreign('id_usr_b') -> references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
