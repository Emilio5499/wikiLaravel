<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::where('is_approved', true)->latest()->get();
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
