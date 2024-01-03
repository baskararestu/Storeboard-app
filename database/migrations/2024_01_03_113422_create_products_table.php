<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("products", function (Blueprint $table) {
            $table->increments("id_product");
            $table->string("name", 100);
            $table->string("category", 50);
            $table->string("supplier", 100);
            $table->string("stock", 5);
            $table->string("price", 50);
            $table->foreignId("user_id")->constrained("users", "id_user");
            $table->text("note");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("products");
    }
};
