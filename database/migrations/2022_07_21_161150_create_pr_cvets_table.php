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
        Schema::create('pr_cvets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('pr_collection_id')->constrained();
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->json('specs')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_cvets');
    }
};
