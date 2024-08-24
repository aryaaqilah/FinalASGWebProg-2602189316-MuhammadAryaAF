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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};

// Schema::create('details', function (Blueprint $table) {
//     $table->id();
//     $table->unsignedBigInteger('book_id');
//     $table->string('author');
//     $table->string('publisher');
//     $table->integer('year');
//     $table->longText('description');
//     $table->timestamps();
// });

// Schema::table('books', function(Blueprint $table){
//     $table->foreign('category_id') -> references('id')->on('categories');
// });
// Schema::table('details', function(Blueprint $table){
//     $table->foreign('book_id') -> references('id')->on('books');
// });
