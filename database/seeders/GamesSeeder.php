<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = "https://raw.githubusercontent.com/dudeonthehorse/datasets/master/steam.games.json";
        $json_to_array = json_decode(file_get_contents($url), true);

        foreach($json_to_array["response"]["games"] as $index => $game) {

            $visible_stats = $game['has_community_visible_stats'] ?? false;
            DB::table('games')->updateOrInsert([
                'appid' => $game['appid'],
                'name' => $game['name'],
                'playtime_forever' => $game['playtime_forever'],
                'img_icon_url' => $game['img_icon_url'],
                'img_logo_url' => $game['img_logo_url'],
                'has_community_visible_stats' => $visible_stats
            ]);
        }
    }
}
