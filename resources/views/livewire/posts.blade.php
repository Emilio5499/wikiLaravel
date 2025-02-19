<div>
    <h2>Posts recientes</h2>
    <ul>
        @foreach ($posts as $post)
            <li>
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
            </li>
        @endforeach

            <button wire:click="refreshPosts">🔄 Actualizar</button>
    </ul>
</div>
