<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old enum and create new one
        DB::statement("ALTER TABLE products MODIFY COLUMN stock_status ENUM('in_stock', 'out_of_stock') DEFAULT 'in_stock'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to original enum
        DB::statement("ALTER TABLE products MODIFY COLUMN stock_status ENUM('In Stock', 'Out of Stock') DEFAULT 'In Stock'");
    }
};