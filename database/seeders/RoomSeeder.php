<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
            ['name' => 'Lumbung Suite', 'price' => 1500000, 'available' => 5],
            ['name' => 'Walekayu Suite', 'price' => 1200000, 'available' => 3],
            ['name' => 'Walekayu Family Suite', 'price' => 1800000, 'available' => 2],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
