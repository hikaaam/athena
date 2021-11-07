<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\outlet;
use App\Models\product;
use App\Models\User;
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
            "name"=>"Makanan",
            "desc"=>"lorem ipsum"
        ]);

       $cat = category::create([
            "name"=>"Minuman",
            "desc"=>"lotem ipsum"
        ]);

        //admin
        User::create([
            "name"=>"admin",
            "email"=>"admin@admin.com",
            "password"=>bcrypt("password")
        ]);

        //master user
        $user = User::create([
            "name"=>"Indomaret",
            "email"=>"indomaret@indomaret.com",
            "password"=>bcrypt("password")
        ]);

        //outlet 1
        $outlet = outlet::create([
            "name"=>"Indomaret Tegal",
            "address"=>"Jalan ini nomor ini rt ini/ini",
            "user_id"=>$user->id
        ]);

        function seedProduct($name,$price,$image,$cat,$user,$outlet){
            $id = $cat->id;
            product::create([
                "name"=>$name,
                "price"=>$price,
                "image"=>$image,
                "category_id"=>$id,
                "user_id"=>$user->id,
                "outlet_id"=>$outlet->id,
                "desc"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut quo exercitationem tenetur expedita vero magnam nostrum. Labore velit ipsa ipsum quia? Mollitia quam atque pariatur repellat ducimus dolores enim repudiandae."
            ]);        
        }
        seedProduct("Kopi",5000,"standard_repo.png",$cat,$user,$outlet);
        seedProduct("Teh Manis",3000,"paket-advance.png",$cat,$user,$outlet);
    }
}
