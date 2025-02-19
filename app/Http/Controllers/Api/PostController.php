<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Events\PostCreado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::where('approved', true)->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            $status = auth()->user()->isAdmin() ? 'aprobado' : 'pendiente'
        ]);
        event(new PostCreado($post));
        return redirect()->route('posts.index')->with('success', 'Se ha creado el post, esperando confirmacion de admin.');
    }

    public function descargarPDF($id)
    {
        $post = Post::findOrFail($id);

        $pdf = Pdf::loadView('posts.pdf', compact('post'));

        return $pdf->download('post_' . $post->id . '.pdf');
    }

}

