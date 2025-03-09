<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function product(Request $request){
        $user = auth()->user();
        $userIp = $request->ip();
        if($user){
            $like = Like::where('likable_type' , 'App\\Models\\Product')->where(function ($query) use($user,$userIp) {
                $query->where("user_id" , $user->id)
                    ->orWhere('user_ip', $userIp);
            })->where('likable_id' , $request->model)->first();
        }else{
            $like = Like::where('likable_type' , 'App\\Models\\Product')->where('user_ip', $userIp)->where('likable_id' , $request->model)->first();
        }
        if($like){
            $like->delete();
            return 'delete';
        }else{
            $like = Like::create([
                'user_id' => $user ? $user->id : 0,
                'user_ip' => $userIp,
                'likable_type' => 'App\\Models\\Product',
                'likable_id' => $request->model,
            ]);
            return 'success';
        }
    }
}
