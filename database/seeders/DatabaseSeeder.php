<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        category::create([
            "name"=>"Software",
            "desc"=>"Aplikasi, service dll"
        ]);
        category::create([
            "name"=>"Hardware",
            "desc"=>"Product barang"
        ]);
        $cat = category::create([
            "name"=>"Paket Software & Hardware",
            "desc"=>"Paket yang berisi produk software dan hardware"
        ]);
        function seedProduct($name,$price,$image,$cat){
            try {
            $id = $cat->id;
            product::create([
                "name"=>$name,
                "price"=>$price,
                "image"=>$image,
                "category_id"=>$id,
                "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut quo exercitationem tenetur expedita vero magnam nostrum. Labore velit ipsa ipsum quia? Mollitia quam atque pariatur repellat ducimus dolores enim repudiandae."
            ]);
            } catch (\Throwable $th) {
                //throw $th;
            }           
        }
        seedProduct("Majoo Pro",2750000,"standard_repo.png",$cat);
        seedProduct("Majoo Advance",2750000,"paket-advance.png",$cat);
        seedProduct("Majoo Lifestyle",2750000,"paket-lifestyle.png",$cat);
        seedProduct("Majoo Dekstop",2750000,"paket-desktop.png",$cat);
    }
}
