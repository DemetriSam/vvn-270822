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
        Schema::create('pr_images', function (Blueprint $table) {
            $table->id();
            $table->string('orig_img');
            $table->foreignId('imageable_id')->nullable();
            $table->string('imageable_type')->nullable();
            $table->json('resizes')->nullable();
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pr_images');
    }
};
