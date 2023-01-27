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
        Schema::create('pr_rolls', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_code')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->float('quantity_m2');
            $table->foreignId('pr_cvet_id')->nullable();
            $table->foreignId('supplier_id')->constrained();
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
        Schema::dropIfExists('pr_rolls');
    }
};
