<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoppingLists = [
            [
                'id' => 1,
                'name' => 'Tester List',
                'pieces' => 3,
                'created_at' => '2023-07-14 21:05:23',
                'item_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Tester List',
                'pieces' => 3,
                'created_at' => '2023-07-14 21:05:23',
                'item_id' => 2,
            ],
            [
                'id' => 3,
                'name' => 'A List',
                'pieces' => 5,
                'created_at' => '2022-07-15 21:05:23',
                'item_id' => 3,
            ],
            [
                'id' => 4,
                'name' => 'A List',
                'pieces' => 2,
                'created_at' => '2022-07-15 21:05:23',
                'item_id' => 9,
            ],
            [
                'id' => 5,
                'name' => 'B List',
                'pieces' => 1,
                'created_at' => '2022-09-16 21:05:23',
                'item_id' => 15,
            ],
            [
                'id' => 6,
                'name' => 'B List',
                'pieces' => 20,
                'created_at' => '2022-09-16 21:05:23',
                'item_id' => 38,
            ],
            [
                'id' => 7,
                'name' => 'C List',
                'pieces' => 8,
                'created_at' => '2022-11-17 21:05:23',
                'item_id' => 35,
            ],
            [
                'id' => 8,
                'name' => 'C List',
                'pieces' => 15,
                'created_at' => '2022-11-17 21:05:23',
                'item_id' => 49,
            ],
            [
                'id' => 9,
                'name' => 'D List',
                'pieces' => 18,
                'created_at' => '2023-01-18 21:05:23',
                'item_id' => 18,
            ],
            [
                'id' => 10,
                'name' => 'E List',
                'pieces' => 31,
                'created_at' => '2023-03-19 21:05:23',
                'item_id' => 25,
            ],
        ];

        DB::table('shopping_lists')->insert($shoppingLists);
    }
}

