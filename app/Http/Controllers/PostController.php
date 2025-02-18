<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create()
    {
        $statuses = ['Borrador', 'Publicado', 'Archivado'];

        return view('posts.create', ['post' => new Post(), 'statuses' => $statuses]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        $status = auth()->user()->isAdmin() ? 'aprobado' : 'pendiente';

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = auth()->id();
        $post->status = $status;
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post creado.');
    }


    public function index()
    {
        $posts = Post::where('status', 'approved')->get();
        return view('posts.index', compact('posts'));
    }

    public function pending()
    {
        $this->authorize('moderate');

        $posts = Post::where('status', 'pending')->get();
        return view('posts.pending', compact('posts'));
    }

    public function approve($id)
    {
        $this->authorize('moderate');

        $post = Post::findOrFail($id);
        $post->update(['status' => 'approved']);

        return redirect()->route('posts.pending')->with('success', 'Post aprobado.');
    }

    public function reject($id)
    {
        $this->authorize('moderate');

        $post = Post::findOrFail($id);
        $post->update(['status' => 'rejected']);

        return redirect()->route('posts.pending')->with('error', 'Post rechazado.');
    }
}
