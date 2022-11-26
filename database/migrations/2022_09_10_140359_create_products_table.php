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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('catagories');
            $table->foreignId('section_id')->constrained('sections');
            $table->string('product_name');
            $table->string('product_code')->unique();
            $table->string('product_color')->nullable();
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->decimal('regular_price');
            $table->decimal('sale_price');
            $table->float('product_discount')->nullable();
            $table->enum('stok_status',['instock','outofstock']);
            $table->unsignedInteger('quantity')->default(1);
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('added_by');
            $table->tinyInteger('is_featured')->default('0');
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('products');
    }
};
