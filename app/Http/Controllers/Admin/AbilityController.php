<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function index(Request $request){
        $abilities = Ability::latest()->paginate(50);
        return view('admin.taxonamy.ability',compact('abilities'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:220',
            'percent' => 'required',
        ]);
        $post = Ability::create([
            'name' => $request->name,
            'percent' => $request->percent,
        ]);
        return redirect()->back()->with([
            'message' => 'توانایی با موفقیت اضافه شد'
        ]);
    }
    public function edit(Request $request){
        return Ability::where('id' , $request->ability)->first();
    }
    public function update(Request $request , Ability $ability){
        $request->validate([
            'name' => 'required|max:220',
            'percent' => 'required',
        ]);
        $ability->update([
            'name' => $request->name,
            'percent' => $request->percent,
        ]);
        return redirect()->back()->with([
            'message' => 'توانایی ' . $request->name . ' با موفقیت ویرایش شد'
        ]);
    }
    public function delete(Ability $ability){
        $ability->delete();
        return redirect()->back()->with([
            'message' => 'توانایی با موفقیت حذف شد'
        ]);
    }
}
