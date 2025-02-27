<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostSearchRequest;

class PostController extends Controller
{
    public function index(){
        $perPage=request()->per_page ?? 10;
        $posts=Post::paginate( $perPage);
        return response()->json($posts);
    }
    public function search(PostSearchRequest $request)
    {
    $searchTerm = $request->get('query', '');
    $perPage = $request->get('per_page', 20);
    $posts=Post::paginate( $perPage);
    $posts = Post::where('title', 'like', "%$searchTerm%")
        ->orWhere('content', 'like', "%$searchTerm%")
        ->paginate($perPage);
    return response()->json($posts);
    }
}
