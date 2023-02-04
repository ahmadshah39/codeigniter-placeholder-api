<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class TodoSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('users')->get();
        $users = $query->getResultArray();
        
        $faker = Faker\Factory::create();

        $todos = [];
        foreach ($users as $key => $value) {
            $i = 0;
            while($i < 20){
                $todos[] = [
                    'title' => $faker->sentence(),
                    'completed' => $faker->boolean(),
                    'user_id' => $value['id']
                ];
                $i++;
            }
        }

        $this->db->table('todos')->insertBatch($todos);
    }
}
