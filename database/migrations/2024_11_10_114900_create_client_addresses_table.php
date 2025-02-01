<?php

use App\Modules\User\Infrastructure\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('city');
            $table->string('street');
            $table->integer('house_number');
            $table->integer('apartment');
            $table->foreignIdFor(Client::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
    }
};
