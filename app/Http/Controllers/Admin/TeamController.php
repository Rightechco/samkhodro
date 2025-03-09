<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request){
        $team = Team::latest()->paginate(50);
        return view('admin.taxonamy.team',compact('team'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'body' => 'required',
            'image' => 'required',
        ]);
        $post = Team::create([
            'name' => $request->name,
            'body' => $request->body,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
        ]);
        return redirect()->back()->with([
            'message' => 'عضو با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Team::where('id' , $request->team)->first();
    }
    public function update(Request $request , Team $team){
        $request->validate([
            'name' => 'required|max:220',
            'body' => 'required',
            'image' => 'required',
        ]);
        $team->update([
            'name' => $request->name,
            'body' => $request->body,
            'image' => Gallery::where('id',$request->image)->pluck('url')->first() ?? $request->image,
        ]);
        return redirect()->back()->with([
            'message' => 'عضو ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Team $team){
        $team->delete();
        return redirect()->back()->with([
            'message' => 'عضو با موفقیت حذف شد'
        ]);
    }
}
