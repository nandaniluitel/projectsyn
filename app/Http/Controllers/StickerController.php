<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StickerController extends Controller
{
    public function index()
    {
        // Sample data, replace it with your actual data source
        $stickers = [
            [
                'name' => 'Project Defense',
                'image' => 'https://example.com/sticker1.jpg',
                'description' => 'Description for sticker 1',
            ],
            [
                'name' => 'Report Writing',
                'image' => 'https://example.com/sticker2.jpg',
                'description' => 'Description for sticker 2',
            ],
            [
                'name' => 'Attendace Report',
                'image' => 'https://example.com/sticker2.jpg',
                'description' => 'Description for sticker 2',
            ],
            [
                'name' => 'Tutorial1 Submission Report',
                'image' => 'https://example.com/sticker2.jpg',
                'description' => 'Description for sticker 2',
            ],
            [
                'name' => 'Lab1 Submission Report',
                'image' => 'https://example.com/sticker2.jpg',
                'description' => 'Description for sticker 2',
            ],
            // Add more stickers as needed
        ];

        return response()->json($stickers);
    }
}
