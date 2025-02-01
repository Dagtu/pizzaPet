<?php

use App\Modules\Order\Infrastructure\Models\Order;
use App\Modules\Product\Infrastructure\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('price');
            $table->float('total_price');
            $table->foreignIdFor(Product::class);
            $table->foreignIdFor(Order::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
