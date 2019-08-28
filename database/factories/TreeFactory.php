<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Tree;

use Illuminate\Database\Seeder;


class TreeFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trees = [
             [
            'name' => 'Facebook',
            'icon' => '<i class="fab fa-facebook"></i>',
            
        ],
        [
            'name' => 'Instagram',
            'icon' => '<i class="fab fa-instagram"></i>',
        ],
        [
            'name' => 'Twitter',
            'icon' => '<i class="fab fa-twitter-square"></i>',
        ],
        [
             'name' => 'Snapchat',
            'icon' => '<i class="fab fa-snapchat"></i>',
        ]
        ];

        foreach ($trees as $tree) {
            Tree::create($tree);
        }
    }
}
