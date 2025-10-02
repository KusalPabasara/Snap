<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs
        $electronicsId = \App\Models\Category::where('slug', 'electronics')->first()?->id;
        $mobilePhonesId = \App\Models\Category::where('slug', 'mobile-phones')->first()?->id;
        $laptopsId = \App\Models\Category::where('slug', 'laptops-computers')->first()?->id;
        $fashionId = \App\Models\Category::where('slug', 'fashion')->first()?->id;
        $mensClothingId = \App\Models\Category::where('slug', 'mens-clothing')->first()?->id;
        $womensClothingId = \App\Models\Category::where('slug', 'womens-clothing')->first()?->id;
        $booksId = \App\Models\Category::where('slug', 'books-items')->first()?->id;
        $groceriesId = \App\Models\Category::where('slug', 'groceries')->first()?->id;
        $gamingId = \App\Models\Category::where('slug', 'gaming')->first()?->id;
        $beautyId = \App\Models\Category::where('slug', 'beauty')->first()?->id;

        $products = [
            // Electronics
            [
                'name' => 'iPhone 15 Pro Max',
                'slug' => 'iphone-15-pro-max',
                'description' => 'Latest Apple flagship smartphone with A17 Pro chip',
                'price' => 549900.00,
                'category_id' => $mobilePhonesId,
                'shop_id' => 1,
                'is_active' => true,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'slug' => 'samsung-galaxy-s24-ultra',
                'description' => 'Premium Android smartphone with S Pen',
                'price' => 479900.00,
                'category_id' => $mobilePhonesId,
                'shop_id' => 1,
                'is_active' => true,
                'stock_quantity' => 20,
            ],
            [
                'name' => 'Dell XPS 15',
                'slug' => 'dell-xps-15',
                'description' => 'High-performance laptop with Intel i7, 16GB RAM',
                'price' => 389900.00,
                'category_id' => $laptopsId,
                'shop_id' => 1,
                'is_active' => true,
                'stock_quantity' => 8,
            ],
            [
                'name' => 'MacBook Pro 14"',
                'slug' => 'macbook-pro-14',
                'description' => 'Apple M3 Pro chip, 18GB RAM, 512GB SSD',
                'price' => 629900.00,
                'category_id' => $laptopsId,
                'shop_id' => 9,
                'is_active' => true,
                'stock_quantity' => 5,
            ],

            // Fashion
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'slug' => 'levis-501-original-jeans',
                'description' => 'Classic straight fit denim jeans',
                'price' => 12500.00,
                'category_id' => $mensClothingId,
                'shop_id' => 2,
                'is_active' => true,
                'stock_quantity' => 50,
            ],
            [
                'name' => 'Nike Air Max Sneakers',
                'slug' => 'nike-air-max-sneakers',
                'description' => 'Comfortable running shoes with Air Max technology',
                'price' => 18900.00,
                'category_id' => $fashionId,
                'shop_id' => 2,
                'is_active' => true,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'Summer Floral Dress',
                'slug' => 'summer-floral-dress',
                'description' => 'Elegant floral print midi dress',
                'price' => 8500.00,
                'category_id' => $womensClothingId,
                'shop_id' => 2,
                'is_active' => true,
                'stock_quantity' => 25,
            ],
            [
                'name' => 'Formal Shirt - White',
                'slug' => 'formal-shirt-white',
                'description' => 'Premium cotton formal shirt',
                'price' => 4500.00,
                'category_id' => $mensClothingId,
                'shop_id' => 11,
                'is_active' => true,
                'stock_quantity' => 40,
            ],

            // Books
            [
                'name' => 'The Great Gatsby',
                'slug' => 'the-great-gatsby',
                'description' => 'Classic American novel by F. Scott Fitzgerald',
                'price' => 1200.00,
                'category_id' => $booksId,
                'shop_id' => 4,
                'is_active' => true,
                'stock_quantity' => 35,
            ],
            [
                'name' => 'Atomic Habits',
                'slug' => 'atomic-habits',
                'description' => 'Self-help book by James Clear',
                'price' => 2500.00,
                'category_id' => $booksId,
                'shop_id' => 4,
                'is_active' => true,
                'stock_quantity' => 20,
            ],
            [
                'name' => 'Harry Potter Box Set',
                'slug' => 'harry-potter-box-set',
                'description' => 'Complete 7-book series by J.K. Rowling',
                'price' => 15000.00,
                'category_id' => $booksId,
                'shop_id' => 4,
                'is_active' => true,
                'stock_quantity' => 10,
            ],

            // Groceries
            [
                'name' => 'Organic Bananas (1kg)',
                'slug' => 'organic-bananas-1kg',
                'description' => 'Fresh organic bananas from local farms',
                'price' => 350.00,
                'category_id' => $groceriesId,
                'shop_id' => 5,
                'is_active' => true,
                'stock_quantity' => 100,
            ],
            [
                'name' => 'Fresh Milk (1L)',
                'slug' => 'fresh-milk-1l',
                'description' => 'Full cream fresh milk',
                'price' => 420.00,
                'category_id' => $groceriesId,
                'shop_id' => 5,
                'is_active' => true,
                'stock_quantity' => 80,
            ],
            [
                'name' => 'Brown Rice (5kg)',
                'slug' => 'brown-rice-5kg',
                'description' => 'Premium quality brown rice',
                'price' => 1850.00,
                'category_id' => $groceriesId,
                'shop_id' => 13,
                'is_active' => true,
                'stock_quantity' => 40,
            ],

            // Gaming
            [
                'name' => 'PlayStation 5',
                'slug' => 'playstation-5',
                'description' => 'Sony PS5 gaming console with DualSense controller',
                'price' => 189900.00,
                'category_id' => $gamingId,
                'shop_id' => 7,
                'is_active' => true,
                'stock_quantity' => 12,
            ],
            [
                'name' => 'Xbox Series X',
                'slug' => 'xbox-series-x',
                'description' => 'Microsoft Xbox Series X console',
                'price' => 179900.00,
                'category_id' => $gamingId,
                'shop_id' => 7,
                'is_active' => true,
                'stock_quantity' => 10,
            ],
            [
                'name' => 'God of War Ragnarök',
                'slug' => 'god-of-war-ragnarok',
                'description' => 'Action-adventure game for PS5',
                'price' => 8900.00,
                'category_id' => $gamingId,
                'shop_id' => 7,
                'is_active' => true,
                'stock_quantity' => 25,
            ],
            [
                'name' => 'Logitech G Pro Headset',
                'slug' => 'logitech-g-pro-headset',
                'description' => 'Professional gaming headset with surround sound',
                'price' => 15900.00,
                'category_id' => $gamingId,
                'shop_id' => 7,
                'is_active' => true,
                'stock_quantity' => 18,
            ],

            // Beauty
            [
                'name' => 'MAC Ruby Woo Lipstick',
                'slug' => 'mac-ruby-woo-lipstick',
                'description' => 'Iconic matte red lipstick',
                'price' => 4500.00,
                'category_id' => $beautyId,
                'shop_id' => 8,
                'is_active' => true,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'Neutrogena Hydro Boost',
                'slug' => 'neutrogena-hydro-boost',
                'description' => 'Water gel moisturizer for all skin types',
                'price' => 3200.00,
                'category_id' => $beautyId,
                'shop_id' => 8,
                'is_active' => true,
                'stock_quantity' => 45,
            ],
            [
                'name' => 'L\'Oreal Paris Hair Serum',
                'slug' => 'loreal-paris-hair-serum',
                'description' => 'Nourishing hair serum with argan oil',
                'price' => 2800.00,
                'category_id' => $beautyId,
                'shop_id' => 8,
                'is_active' => true,
                'stock_quantity' => 35,
            ],
        ];

        foreach ($products as $productData) {
            \App\Models\Product::create($productData);
        }

        $this->command->info('Products seeded successfully!');
    }
}
