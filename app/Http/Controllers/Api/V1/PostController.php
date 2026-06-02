<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use MessageFormatter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return [
        //         'id'=>1,
        //         'title'=>'test',
        //         'body'=>'body test',
        //     ];

        // return Post::all();

        return PostResource::collection(Post::with('author')->get()); //->paginate(3);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // $data=$request->all();
        // $data=$request->only('title','body');
        $data = $request->validated();

        $data['author_id'] = 1;

        $post = Post::create($data);

        return response()->json(new PostResource($post), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        // $post=Post::findOrFail($id);

        // return response()->json(
        //     new PostResource($post)
        //     )->header('Test', 'Zayar');

        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:2'],
            'body' => ['required', 'string', 'min:2']
        ]);

        $post->update($data);
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
