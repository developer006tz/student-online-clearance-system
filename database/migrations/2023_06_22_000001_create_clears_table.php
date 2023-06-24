<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clears', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clearance_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role');
            $table->string('comment')->nullable();
            $table->enum('signature', ['0', '1'])->default('0');
            $table->date('date')->default(now());
            $table
                ->enum('status', ['0', '1'])
                ->default('0')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clears');
    }
};
