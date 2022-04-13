<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = User::role('admin')->first()->id;
        $categories = [
            [
                'user_id' => $admin_id,
                'name' => 'Uncategories',
                'slug' => 'uncategories',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Oil',
                'slug' => 'oil',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Ghee',
                'slug' => 'ghee',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Juice',
                'slug' => 'juice',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Frozen Foods',
                'slug' => 'frozen-foods',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Dairy',
                'slug' => 'dairy',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Bread Bakery',
                'slug' => 'bread-bakery',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Meat',
                'slug' => 'meat',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
