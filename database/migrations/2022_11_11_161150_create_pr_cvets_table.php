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
            $table->string('name_in_folder');
            $table->string('title');
            $table->foreignId('pr_collection_id')->constrained();
            $table->foreignId('color_id')->nullable();
            $table->text('description')->nullable();

            $table->enum('published', ['true', 'false'])->default('false');
            //to add new_enum_value:
            //ALTER TYPE name ADD VALUE [ IF NOT EXISTS ] new_enum_value [ { BEFORE | AFTER } neighbor_enum_value ]

            $table->float('current_price')->nullable();
            $table->float('sale_price')->nullable();
            $table->unsignedInteger('sort')->nullable();
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
