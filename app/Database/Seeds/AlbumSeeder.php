<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class AlbumSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('users')->get();
        $users = $query->getResultArray();
        
        $faker = Faker\Factory::create();

        $albums = [];
        foreach ($users as $key => $value) {
            $i = 0;
            while($i < 10){
                $albums[] = [
                    'title' => $faker->sentence(),
                    'user_id' => $value['id']
                ];
                $i++;
            }
        }

        $this->db->table('albums')->insertBatch($albums);
    }
}
