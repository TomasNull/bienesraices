<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->enum('status_estate', [
                \App\RealEstate::PENDING, \App\RealEstate::RENTAL, \App\RealEstate::SALE
            ])->default(\App\RealEstate::PENDING);
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->decimal('price');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->boolean('yard');
            $table->boolean('pool');
            $table->boolean('garage');
            $table->boolean('new_construct');
            $table->string('slug');
            $table->string('picture')->nullable();
            $table->enum('status', [
                \App\RealEstate::PUBLISHED, \App\RealEstate::PENDING, \App\RealEstate::REJECTED
            ])->default(\App\RealEstate::PENDING);
            $table->boolean('previous_approved')->default(false);
            $table->boolean('previous_rejected')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
