<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'icon' => '📱',
                'description' => 'Phones, Laptops, Accessories & More',
                'children' => [
                    ['name' => 'Mobile Phones', 'slug' => 'mobile-phones', 'icon' => '📱'],
                    ['name' => 'Laptops & Computers', 'slug' => 'laptops-computers', 'icon' => '💻'],
                    ['name' => 'Tablets', 'slug' => 'tablets', 'icon' => '📱'],
                    ['name' => 'Accessories', 'slug' => 'electronics-accessories', 'icon' => '🔌'],
                ]
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'icon' => '👕',
                'description' => 'Clothing, Shoes & Accessories',
                'children' => [
                    ['name' => "Men's Clothing", 'slug' => 'mens-clothing', 'icon' => '👔'],
                    ['name' => "Women's Clothing", 'slug' => 'womens-clothing', 'icon' => '👗'],
                    ['name' => 'Shoes', 'slug' => 'shoes', 'icon' => '👟'],
                    ['name' => 'Bags & Accessories', 'slug' => 'bags-accessories', 'icon' => '👜'],
                ]
            ],
            [
                'name' => 'Food & Beverages',
                'slug' => 'food',
                'icon' => '🍔',
                'description' => 'Restaurants, Cafes & Food Items',
                'children' => [
                    ['name' => 'Restaurants', 'slug' => 'restaurants', 'icon' => '🍽️'],
                    ['name' => 'Cafes & Bakery', 'slug' => 'cafes-bakery', 'icon' => '☕'],
                    ['name' => 'Fast Food', 'slug' => 'fast-food', 'icon' => '🍕'],
                ]
            ],
            [
                'name' => 'Books & Stationery',
                'slug' => 'books',
                'icon' => '📚',
                'description' => 'Books, Stationery & Educational',
                'children' => [
                    ['name' => 'Books', 'slug' => 'books-items', 'icon' => '📖'],
                    ['name' => 'Stationery', 'slug' => 'stationery', 'icon' => '✏️'],
                    ['name' => 'Art Supplies', 'slug' => 'art-supplies', 'icon' => '🎨'],
                ]
            ],
            [
                'name' => 'Groceries',
                'slug' => 'groceries',
                'icon' => '🥬',
                'description' => 'Fresh Produce & Daily Essentials',
                'children' => [
                    ['name' => 'Fruits & Vegetables', 'slug' => 'fruits-vegetables', 'icon' => '🍎'],
                    ['name' => 'Dairy Products', 'slug' => 'dairy', 'icon' => '🥛'],
                    ['name' => 'Household Items', 'slug' => 'household', 'icon' => '🧴'],
                ]
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home',
                'icon' => '🏠',
                'description' => 'Furniture, Decor & Garden',
                'children' => [
                    ['name' => 'Furniture', 'slug' => 'furniture', 'icon' => '🛋️'],
                    ['name' => 'Home Decor', 'slug' => 'home-decor', 'icon' => '🖼️'],
                    ['name' => 'Garden & Outdoor', 'slug' => 'garden', 'icon' => '🌱'],
                ]
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'icon' => '🎮',
                'description' => 'Games, Consoles & Accessories',
                'children' => [
                    ['name' => 'Video Games', 'slug' => 'video-games', 'icon' => '🎮'],
                    ['name' => 'Gaming Consoles', 'slug' => 'consoles', 'icon' => '🕹️'],
                    ['name' => 'Gaming Accessories', 'slug' => 'gaming-accessories', 'icon' => '🎧'],
                ]
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => 'beauty',
                'icon' => '💄',
                'description' => 'Cosmetics, Skincare & Wellness',
                'children' => [
                    ['name' => 'Makeup', 'slug' => 'makeup', 'icon' => '💄'],
                    ['name' => 'Skincare', 'slug' => 'skincare', 'icon' => '🧴'],
                    ['name' => 'Hair Care', 'slug' => 'hair-care', 'icon' => '💇'],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $category = Category::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $category->id;
                $childData['description'] = $childData['name'];
                Category::create($childData);
            }
        }

        $this->command->info('Categories seeded successfully!');
    }
}
