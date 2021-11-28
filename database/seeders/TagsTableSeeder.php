<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name' => 'Tag 1',
                'slug' => 'tag-1',
            ],
            [
                'name' => 'Tag 2',
                'slug' => 'tag-2',
            ],
            [
                'name' => 'Tag 3',
                'slug' => 'tag-3',
            ]
        ];
        DB::table('tags')->insert($data);

    }
}
