<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
class PhotoSeeder extends Seeder
{
    public function run()
    {
        $query = $this->db->table('albums')->get();
        $users = $query->getResultArray();
        
        $faker = Faker\Factory::create();

        $photos = [];

        foreach ($users as $key => $value) {
            $i = 0;
            while($i < 10){
                $image_url = $faker->imageUrl(600, 600, 'animals');
                $photos[] = [
                    'title' => $faker->sentence(),
                    'url' => $image_url,
                    'thumbnail_url' => str_replace('600x600', '150x150', $image_url),
                    'album_id' => $value['id']
                ];
                $i++;
            }
        }

        $this->db->table('photos')->insertBatch($photos);
    }
}
