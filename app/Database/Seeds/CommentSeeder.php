<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class CommentSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('posts')->get();
        $users = $query->getResultArray();
        
        $faker = Faker\Factory::create();

        $comments = [];

        foreach ($users as $key => $value) {
            $i = 0;
            while($i < 5){
                $comments[] = [
                    'name' => $faker->name(),
                    'email' => $faker->email(),
                    'body' => $faker->text(100),
                    'post_id' => $value['id']
                ];
                $i++;
            }
        }

        $this->db->table('comments')->insertBatch($comments);
    }
}
