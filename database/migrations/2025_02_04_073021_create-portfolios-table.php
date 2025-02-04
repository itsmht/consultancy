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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->bigIncrements('portfolio_id');
            $table->string('title');
            $table->string('image_path');
            $table->longText('description');
            $table->string('status');
            $table->bigInteger("portfolio_category_id")->unsigned();
            $table->foreign('portfolio_category_id')->references('portfolio_category_id')->on('portfolio_categories');
            $table->timestamps();
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
