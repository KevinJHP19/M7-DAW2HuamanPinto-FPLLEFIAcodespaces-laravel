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
        Schema::table('tarjets', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        });
        if (!Schema::hasColumn('tarjets', 'user_id')) {
    $table->unsignedBigInteger('user_id')->nullable();
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarjets', function (Blueprint $table) {
            //
        });
    }
};
