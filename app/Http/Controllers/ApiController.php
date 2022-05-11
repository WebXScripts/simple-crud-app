<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //TODO basic auth (JWT?)

    /**
     * Display a listing of the resource from database.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            "status" => true,
            "data" => Game::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show()
    {
        $game_id = request(['id']);
        $check = Validator::make($game_id, [
            'id' => 'int|required',
        ]);

        if($check->fails()) {
            return response()->json([
                "status" => false,
                "data" => "Incorrect or no ID provided"
            ]);
        }

        return response()->json([
            "status" => true,
            "data" => Game::find($game_id)
        ]);
    }

    /**
     * Push new resource to database.
     *
     * @return JsonResponse
     */
    public function push()
    {
        $request = request([
            'appid',
            'name',
            'playtime_forever',
            'img_icon_url',
            'img_logo_url',
            'has_community_visible_stats'
        ]);

        $check = Validator::make($request, [
            'appid' => 'int|required',
            'name' => 'string|required',
        ]);

        if($check->fails()) {
            return response()->json([
                "status" => false,
                "data" => "Incorrect or no ID/Name provided"
            ]);
        }

        $id = DB::table('games')->insertGetId([
            'appid' => $request['appid'],
            'name' => $request['name'],
            'playtime_forever' => $request['playtime_forever'] ?? 0,
            'img_icon_url' => $request['img_icon_url'] ?? "default",
            'img_logo_url' => $request['img_logo_url'] ?? "default",
            'has_community_visible_stats' => $request['has_community_visible_stats'] ?? false
        ]);

        return response()->json([
            'status' => true,
            'data' => Game::find($id)
        ]);
    }

    /**
     * Modify resource in database.
     *
     * @return JsonResponse
     */
    public function update()
    {
        $request = request([
            'id',
            'appid',
            'name',
            'playtime_forever',
            'img_icon_url',
            'img_logo_url',
            'has_community_visible_stats'
        ]);

        $check = Validator::make($request, [
            'id' => 'int|required',
        ]);

        if($check->fails()) {
            return response()->json([
                "status" => false,
                "data" => "Incorrect or no ID provided"
            ]);
        }

        //TODO better way
        if(Game::find($request['id']) == null) {
            return response()->json([
                'status' => false,
                'data' => "No ID found in database"
            ]);
        }

        DB::table('games')->where('id', $request['id'])->update([
            'appid' => $request['appid'],
            'name' => $request['name'],
            'playtime_forever' => $request['playtime_forever'] ?? 0,
            'img_icon_url' => $request['img_icon_url'] ?? "default",
            'img_logo_url' => $request['img_logo_url'] ?? "default",
            'has_community_visible_stats' => $request['has_community_visible_stats'] ?? false
        ]);

        return response()->json([
            'status' => true,
            'data' => Game::find($request['id'])
        ]);
    }

    /**
     * Remove the specified resource from database.
     *
     * @return JsonResponse
     */
    public function delete()
    {
        $request = request([
            'id'
        ]);

        $check = Validator::make($request, [
            'id' => 'int|required',
        ]);

        if($check->fails()) {
            return response()->json([
                "status" => false,
                "data" => "Incorrect or no ID provided"
            ]);
        }

        $to_remove = Game::find($request['id']);
        //TODO better way
        if($to_remove == null) {
            return response()->json([
                'status' => false,
                'data' => "No ID found in database"
            ]);
        }

        Game::find($request['id'])->delete();
        return response()->json([
            'status' => true,
            'data' => "Game has been removed"
        ]);
    }
}
