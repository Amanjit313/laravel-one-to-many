<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('admin.posts.index', compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->rulesValidate(), $this->messagesValidate());


        $data = $request->all();

        $new_post = new Post();

        $data['slug'] = Post::generatoreSlug($data['name']);

        $new_post->fill($data);

        $new_post->save();

        return redirect()->route('admin.posts.index', $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate($this->rulesValidate(), $this->messagesValidate());


        $data = $request->all();

        $data['slug'] = Post::generatoreSlug($data['name']);

        $post->update($data);

        return redirect()->route('admin.posts.index', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    private function rulesValidate(){
        return[
            'name' => 'required|max:50|min:3',
            'category_id' => 'required|numeric',
            'location' => 'required|max:50|min:2',
            'email' => 'required|max:50|min:5'
        ];
    }

    private function messagesValidate(){
        return[
            'name.required' => 'Questo campo ?? obbligatorio',
            'name.max' => 'Questo campo non pu?? superare i :max caratteri',
            'name.min' => 'Questo campo non pu?? essere inferiore ai :min caratteri',
            'category_id.numeric' => 'Questo campo ?? obbligatorio',
            'location.required' => 'Questo campo ?? obbligatorio',
            'location.max' => 'Questo campo non pu?? superare i :max caratteri',
            'location.min' => 'Questo campo non pu?? essere inferiore ai :min caratteri',
            'email.required' => 'Questo campo ?? obbligatorio',
            'email.max' => 'Questo campo non pu?? superare i :max caratteri',
            'email.min' => 'Questo campo non pu?? essere inferiore ai :min caratteri',
        ];
    }
}
