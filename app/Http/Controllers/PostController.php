<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    // home page
    public function create()
    {
        $posts = Post::all()->toArray();
        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $request)
    {
        $data = $this->getPostData($request);
        Post::create($data);
        return back()->with($data);
    }

    // post delete
    public function postDelete($id)
    {
        // first way
        Post::where('id', $id)->delete();
        return back();

        // second way
        // Post::find($id)->delete();
        // return redirect()->route('post#home');
    }

    // get post data
    private function getPostData($request)
    {
        $response = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        return $response;
    }
}
