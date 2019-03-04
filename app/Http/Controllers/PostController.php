<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.list', compact('posts'));
    }
    public  function create(){
        return view('posts.create');

    }
    public function store(Request $request){
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        Session::flash('seccess', 'Tao moi thanh cong');
        return redirect()->route('posts.create');

    }
    public function edit($id){
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        Session::flash('seccess', 'Cap nhat thanh cong');
        return redirect()->route('posts.index');
    }
    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('seccess', 'Xoa thanh cong');
        return redirect()->route('posts.index');
    }
}
