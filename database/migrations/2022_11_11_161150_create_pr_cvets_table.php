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
            $table->string('nameInFolder');
            $table->string('title');
            $table->foreignId('pr_collection_id')->constrained();
            $table->foreignId('color')->constrained();
            $table->text('description')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('inStock')->default(false);
            $table->float('currentPrice');
            $table->float('salePrice');
            $table->integer('sort');
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
