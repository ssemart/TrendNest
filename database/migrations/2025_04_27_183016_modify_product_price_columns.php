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
        // First backup the data
        $products = DB::table('products')->get();
        
        // Modify the columns
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['regular_price', 'discounted_price']);
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('regular_price', 15, 2)->after('store_id');
            $table->decimal('discounted_price', 15, 2)->nullable()->after('regular_price');
        });

        // Restore the data
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'regular_price' => $product->regular_price,
                    'discounted_price' => $product->discounted_price
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First backup the data
        $products = DB::table('products')->get();
        
        // Modify the columns back
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['regular_price', 'discounted_price']);
        });
        
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('regular_price', 12, 2)->after('store_id');
            $table->decimal('discounted_price', 12, 2)->nullable()->after('regular_price');
        });

        // Restore the data
        foreach ($products as $product) {
            DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'regular_price' => $product->regular_price,
                    'discounted_price' => $product->discounted_price
                ]);
        }
    }
};
