<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function allTags(){
     $tags = Tag::all();
     return view('tags.index' , compact('tags'));
    }
    public function create(Request $request){
        Tag::create([
            'name' => $request->name
        ]);
        return redirect('/tags');
    }
    public function edit($id){
        $tag = Tag::find($id);
        return view('tags.edit' , compact('tag'));

    }
      public function show($id){
        $getTag = Tag::find($id);
        return view('tags.show' , compact('tag'));

    }
    public function update(Request $request ,$id){
        $getTag = Tag::find($id);
        $getTag->name = $request->name;
        return redirect('/tags');
    }
    public function delete($id){
        $getTag = Tag::find($id);
        $getTag->delete();

    }

}