<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // home page
    public function createPage()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        // dd($posts);
        return view('create', compact('posts'));
    }

    // post create
    public function postCreate(Request $request)
    {
        $this->validation_check($request);
        $data = $this->getPostData($request);
        Post::create($data);
        return back()->with([$data, 'insertSuccess' => "ပို့စ်ဖန်တီးခြင်းအောင်မြင်ပါသည်။"]);
    }

    // post delete
    public function postDelete($id)
    {
        // first way
        Post::where('id', $id)->delete();
        return redirect()->route('post#home');

        // second way
        // Post::find($id)->delete();
        // return redirect()->route('post#home');
    }

    // post update page
    public function read($id)
    {
        $post_data = Post::where('id', $id)->get()->toArray();
        // dd($post_data);
        return view('update', compact('post_data'));
    }

    // post edit
    public function edit($id)
    {
        // dd($id);
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }

    // get edit data
    public function update(Request $request, $id)
    {
        $this->validation_check($request);
        $editData = $this->getEditData($request);
        Post::where('id', $id)->update($editData);
        // dd($editData);
        return redirect()->route('post#home')->with(['updateSuccess' => 'ပို့စ်အဆင့်မြှင့်တင်ခြင်းအောင်မြင်ပါသည်။']);
    }


    // get edit data
    private function getEditData($request)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        return $data;
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

    // validation check
    private function validation_check($request)
    {
        $validation_rules = [
            'title' => 'required|min:5|max:100|unique:posts,title',
            'description' => 'required',
        ];

        $validation_message = [
            'title.required' => 'ခေါင်းစဉ်ဖြည့်သွင်းရန်လိုအပ်ပါသည် ။',
            'title.min' => 'စာလုံးအရေအတွက် ၅ လုံးနှင့်အထက်ဖြစ်ရပါမည် ။',
            'title.unique' => 'ခေါင်းစဉ်တူနေပါသည်။ ထပ်မံဖြည့်သွင်းပါ ။',
            'description.required' => 'အကြောင်းအရာဖြည့်သွင်းရန်လိုအပ်ပါသည်။',
        ];

        Validator::make($request->all(), $validation_rules, $validation_message)->validate();
    }
}
