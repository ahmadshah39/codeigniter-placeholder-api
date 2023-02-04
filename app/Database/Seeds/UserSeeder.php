<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        
        $i = 0;
        $users = [];
        while($i <= 10){
            $users[] = [
                'user_name' => $faker->userName(),
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email'    => $faker->email(),
                'password' => password_hash('123456', PASSWORD_DEFAULT),
            ];
            $i++;
        }
        
        $this->db->table('users')->insertBatch($users);
    }
}
