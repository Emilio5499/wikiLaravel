<h1>Posts Pendientes</h1>
@foreach ($posts as $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <form action="{{ route('posts.approve', $post->id) }}" method="POST">
        @csrf
        <button type="submit">Aprobar</button>
    </form>
    <form action="{{ route('posts.reject', $post->id) }}" method="POST">
        @csrf
        <button type="submit">Rechazar</button>
    </form>
@endforeach
