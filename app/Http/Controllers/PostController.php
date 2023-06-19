<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // home page
    public function createPage()
    {
        // $posts = Post::orderBy('created_at', 'desc')->paginate(3);

        // $posts = Post::select("title")->first();
        // $posts = Post::pluck("title");
        // $posts = Post::select("title", "description")->get();
        // $posts = Post::get()->last();
        // $posts = Post::where('id', '<', 11)->get()->random();
        // $posts = Post::orderBy('id', 'asc')->get();
        // $posts = Post::whereBetween('id', [10, 40])->get();
        // $posts = Post::whereBetween('id', [10, 20])->orderBy('id', 'desc')->get();
        // $posts = Post::select('id', 'created_at')
        //     ->whereBetween('id', [10, 15])
        //     ->where('created_at', '2023-06-08T03:24:23.000000Z')
        //     ->orderBy('id', 'asc')
        //     ->dd();
        $posts = Post::where('id', '<', 10)->orderBy('description', 'desc')->value('description');
        dd($posts);
        // dd($posts->toArray());
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

    // get edit data & update
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
        // dd($status);
        $validation_rules = [
            'title' => 'required|min:5|max:100|unique:posts,title,' . $request->id,
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
