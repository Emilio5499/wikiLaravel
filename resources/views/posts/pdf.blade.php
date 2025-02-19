<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $post->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        .content { margin-top: 20px; }
    </style>
</head>
<body>
    <h1>{{ $post->title }}</h1>
    <p><strong>autor:</strong> {{ $post->user->name }}</p>
    <div class="content">
        {!! nl2br(e($post->content)) !!}
    </div>
</body>
</html>
