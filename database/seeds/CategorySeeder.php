<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Cucina', 'Arte','Musica','Moda','Cultura'];

        foreach ($categories as $category) {
            $new_category_obj = new Category();
            $new_category_obj->name = $category;
            $new_category_obj->slug = Str::slug($category,'-');

            $new_category_obj->save();
        }
    }
}
