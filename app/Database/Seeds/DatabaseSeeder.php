<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UserSeeder');
        echo 'Users seeded successfully';
        $this->call('PostSeeder');
        echo 'Posts seeded successfully';
        $this->call('AlbumSeeder');
        echo 'Albums seeded successfully';
        $this->call('TodoSeeder');
        echo 'Todos seeded successfully';
        $this->call('CommentSeeder');
        echo 'Comment seeded successfully';
        $this->call('PhotoSeeder');
        echo 'Photos seeded successfully';
    }
}
