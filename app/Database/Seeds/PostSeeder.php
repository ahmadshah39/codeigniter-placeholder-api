<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class PostSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('users')->get();
        $users = $query->getResultArray();
        
        $faker = Faker\Factory::create();

        $posts = [];
        foreach ($users as $key => $value) {
            $i = 0;
            while($i < 10){
                $posts[] = [
                    'title' => $faker->sentence(),
                    'body' => $faker->paragraph(),
                    'user_id' => $value['id']
                ];
                $i++;
            }
        }

        $this->db->table('posts')->insertBatch($posts);
    }
}
