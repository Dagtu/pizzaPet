<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('name');
            $table->string('last_name');
            $table->integer('location_id');
            $table->boolean('is_active');
            $table->string('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('couriers');
    }
};
