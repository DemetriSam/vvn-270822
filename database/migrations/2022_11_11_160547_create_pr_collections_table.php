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
        Schema::create('pr_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('nickname')->nullable()->unique();
            $table->text('description')->nullable();

            $table->enum('published', ['true', 'false'])->default('false');
            $table->enum('currency_of_price', ['eur', 'usd', 'rub'])->default('eur'); 
            //to add new_enum_value:
            //ALTER TYPE name ADD VALUE [ IF NOT EXISTS ] new_enum_value [ { BEFORE | AFTER } neighbor_enum_value ]
            
            $table->float('default_price');
            $table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('pr_collections');
    }
};
