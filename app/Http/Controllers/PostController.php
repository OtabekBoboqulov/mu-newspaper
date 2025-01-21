<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        // Fetch latest posts with their authors and paginate the results
        $posts = Post::with('author')->where('published', true)->latest()->paginate(6);
        return view('posts.index', ['posts' => $posts, 'query' => null]);
    }

    public function welcome()
    {
        $posts = Post::withCount('likes')  // Assuming 'likes' is the relationship name
        ->orderBy('likes_count', 'desc')  // Ordering by the count of likes in descending order
        ->take(3)  // Limit the result to the top 3
        ->get();
        return view('welcome', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        // Show a specific post with its details
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        // Show the form to create a new post
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $attributes['author_id'] = Auth::id();
        $user_status = Auth::user()->status;
        if ($user_status == 'admin' || $user_status == 'superadmin') {
            $attributes['published'] = true;
        }

        Post::create($attributes);
        return redirect('/my-posts')->with('success', 'Your post has been submitted to admin!');
    }

    public function edit(Post $post)
    {
        Auth::user()->can('edit', $post);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        Auth::user()->can('edit', $post);
        $attributes = request()->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $attributes['published'] = false;
        $post->update($attributes);
        return redirect('/my-posts')->with('success', 'Your updated post has been submitted to admin!');
    }

    public function destroy(Post $post)
    {
        Auth::user()->can('admin');
        $post->delete();
        return redirect('/admin')->with('success', 'Post deleted!');
    }

    public function publish(Post $post)
    {
        $message = 'Post has been published!';
        Auth::user()->can('admin');
        if ($post->published) {
            $post->update(['published' => false]);
            $message = 'Post has been removed!';
        } else {
            $post->update(['published' => true]);
            $author = User::find($post->author_id);
            if ($author->status != 'admin' && $author->status != 'superadmin' && $author->status != 'author') {
                $author->update(['status' => 'author']);
            }
        }
        return redirect('/admin')->with('success', $message);
    }

    public function toggleLike(Request $request, Post $post)
    {
        // Check if the user has already liked the post
        $like = $post->likes()->where('user_id', Auth::id())->first();

        if ($like) {
            // If the post is already liked, unlike it
            $like->delete();
            $liked = false;
        } else {
            // If the post is not liked, like it
            $post->likes()->create([
                'user_id' => Auth::id(),
            ]);
            $liked = true;
        }

        // Return the updated like count and like status
        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ]);
    }

    public function myPosts()
    {
        $posts = Post::where('author_id', Auth::id())->latest()->paginate(6);

        if (!$posts->isEmpty()) {
            return view('posts.myposts', ['posts' => $posts]);
        } else {
            return view('posts.no-posts');
        }
    }

    public function unpublishedPosts()
    {
        Auth::user()->can('admin');
        $posts = Post::where('published', false)->latest()->paginate(6);
        return view('posts.unpublishedposts', ['posts' => $posts]);
    }

    public function authors()
    {
        $authors = User::whereIn('status', ['author', 'admin', 'superadmin'])->get();
        return view('posts.authors', ['authors' => $authors]);
    }

    public function author(User $user)
    {
        $posts = Post::where('author_id', $user->id)->where('published', true)->latest()->paginate(6);
        return view('posts.author_page', ['author' => $user, 'posts' => $posts]);
    }

    public function search()
    {
        $query = request('query');

        $posts = Post::with('author')
            ->where(function ($q) use ($query) {
                $q->whereRaw('LOWER(body) LIKE ?', ['%' . Str::lower($query) . '%'])
                    ->orWhereRaw('LOWER(title) LIKE ?', ['%' . Str::lower($query) . '%'])
                    ->orWhereHas('author', function ($q) use ($query) {
                        $q->whereRaw('LOWER(username) LIKE ?', ['%' . Str::lower($query) . '%']);
                    });
            })
            ->where('published', true)
            ->latest()
            ->paginate(6);

        return view('posts.index', ['posts' => $posts, 'query' => $query]);
    }

}
