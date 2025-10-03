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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_url')->nullable()->after('description');
        });

        // Update existing products with sample images from Unsplash
        DB::table('products')->update([
            'image_url' => DB::raw("CASE
                WHEN name LIKE '%laptop%' OR name LIKE '%computer%' THEN 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=400&fit=crop'
                WHEN name LIKE '%phone%' OR name LIKE '%mobile%' THEN 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=400&fit=crop'
                WHEN name LIKE '%headphone%' OR name LIKE '%earphone%' THEN 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=400&fit=crop'
                WHEN name LIKE '%watch%' THEN 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=400&fit=crop'
                WHEN name LIKE '%camera%' THEN 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&h=400&fit=crop'
                WHEN name LIKE '%tablet%' OR name LIKE '%ipad%' THEN 'https://images.unsplash.com/photo-1561154464-82e9adf32764?w=600&h=400&fit=crop'
                WHEN name LIKE '%shoe%' OR name LIKE '%sneaker%' THEN 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=400&fit=crop'
                WHEN name LIKE '%shirt%' OR name LIKE '%tshirt%' OR name LIKE '%t-shirt%' THEN 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=600&h=400&fit=crop'
                WHEN name LIKE '%dress%' THEN 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?w=600&h=400&fit=crop'
                WHEN name LIKE '%bag%' OR name LIKE '%backpack%' THEN 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&h=400&fit=crop'
                WHEN name LIKE '%book%' THEN 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=600&h=400&fit=crop'
                WHEN name LIKE '%coffee%' THEN 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&h=400&fit=crop'
                WHEN name LIKE '%furniture%' OR name LIKE '%chair%' OR name LIKE '%table%' THEN 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=400&fit=crop'
                WHEN name LIKE '%plant%' THEN 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?w=600&h=400&fit=crop'
                WHEN name LIKE '%toy%' THEN 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=600&h=400&fit=crop'
                ELSE 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=400&fit=crop'
            END")
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
};
