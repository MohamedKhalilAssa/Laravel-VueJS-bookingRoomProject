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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('address');
            $table->longText('description');
            $table->string('image')->default('http://localhost:8000/storage/images/no-image.png');
            // amenities
            $table->boolean('amenity_wifi')->default(false);
            $table->boolean('amenity_pets')->default(false);
            $table->boolean('amenity_tv')->default(false);
            $table->boolean('amenity_kitchen')->default(false);
            $table->boolean('amenity_breakfast')->default(false);
            $table->boolean('amenity_laptop')->default(false);
            $table->boolean('amenity_air_conditioning')->default(false);
            // prices
            $table->decimal('price_per_night',6,2)->nullable();
            $table->decimal('price_extra_people',6,2)->nullable();
            $table->decimal('price_weekly_discount',8,2)->nullable();
            $table->decimal('price_monthly_discount',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
