<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    public function cacheUsers()
    {
        $users = User::all();

        foreach ($users as $user) {
            Redis::zadd('user_ranks', 0, $user->id);
        }

        return response()->json(['message' => 'Users cached successfully']);
    }


    public function increaseRank($id)
    {
        Redis::zincrby('user_ranks', 1, $id);
        $user = User::find($id);
        $user->rank += 1;
        $user->save();
        return response()->json(['message' => 'Rank increased successfully']);
    }

    public function decreaseRank($id)
    {
        Redis::zincrby('user_ranks', -1, $id);
        $user = User::find($id);
        $user->rank -= 1;
        $user->save();
        return response()->json(['message' => 'Rank decreased successfully']);
    }

    public function getRank(Request $request)
    {
        $rank_from = intval($request->query('rank_from'));
        $rank_to = intval($request->query('rank_to'));
        $userIds = Redis::zrange('user_ranks', 0, -1);
        $users = User::whereIn('id', $userIds)
            ->whereBetween('rank', [$rank_from, $rank_to])
            ->orderByRaw('ARRAY_POSITION(ARRAY['.implode(',', $userIds).']::int[], id)')
            ->get();
        return response()->json($users);
    }
}
