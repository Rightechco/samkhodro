<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index(){
        $widgets = Widget::orderBy('number')->select(['id','name','title','status'])->get();
        return view('admin.widget.index',compact('widgets'));
    }
    public function change(Request $request){
        for ( $i = 0; $i < count($request->widget); $i++) {
            Widget::where('id' , $request->widget[$i])->update([
                'number' => $i
            ]);
        }
        return 'success';
    }
    public function create(){
        return view('admin.widget.create');
    }
    public function edit(Widget $widget){
        return view('admin.widget.edit',compact('widget'));
    }
    public function store(Request $request){
        $widget = Widget::orderBy('number','DESC')->pluck('number')->first();
        if($widget){
            $number = (int)$widget++;
        }else{
            $number = 0;
        }
        Widget::create([
            'name'=> $request->name,
            'title'=> $request->title,
            'more'=> $request->more,
            'description'=> $request->description,
            'background'=> $request->background,
            'slug'=> $request->slug,
            'count'=> $request->count,
            'status'=> $request->status,
            'number'=> $number,
            'ads1'=> $request->ads1,
            'ads2'=> $request->ads2,
            'ads3'=> $request->ads3,
        ]);
        return 'success';
    }
    public function update(Request $request , Widget $widget){
        $widget->update([
            'name'=> $request->name,
            'title'=> $request->title,
            'more'=> $request->more,
            'description'=> $request->description,
            'background'=> $request->background,
            'slug'=> $request->slug,
            'count'=> $request->count,
            'status'=> $request->status,
            'ads1'=> $request->ads1,
            'ads2'=> $request->ads2,
            'ads3'=> $request->ads3,
        ]);
        return 'success';
    }
    public function delete(Widget $widget){
        $widget->delete();
        return redirect()->back()->with([
            'message' => 'ویجت با موفقیت حذف شد'
        ]);
    }
}
