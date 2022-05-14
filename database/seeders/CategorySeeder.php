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
                'image' => 'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Oil',
                'slug' => 'oil',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Ghee',
                'slug' => 'ghee',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Juice',
                'slug' => 'juice',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Frozen',
                'slug' => 'frozen',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Dairy',
                'slug' => 'dairy',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Bread Bakery',
                'slug' => 'bread-bakery',
                'image'=>'null',
            ],
            [
                'user_id' => $admin_id,
                'name' => 'Meat',
                'slug' => 'meat',
                'image'=>'null',
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
