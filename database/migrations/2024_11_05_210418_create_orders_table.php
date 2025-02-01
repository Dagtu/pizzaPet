<?php

use App\Modules\Courier\Infrastructure\Models\Courier;
use App\Modules\User\Infrastructure\Models\Client;
use App\Modules\User\Infrastructure\Models\ClientAddress;
use App\Modules\User\Infrastructure\Models\ClientPhone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamp('time');
            $table->foreignIdFor(Client::class);
            $table->foreignIdFor(ClientAddress::class);
            $table->foreignIdFor(ClientPhone::class);
            $table->string('status');
            $table->foreignIdFor(Courier::class)->nullable();
            $table->text('comment')->nullable();
            $table->float('total_price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
