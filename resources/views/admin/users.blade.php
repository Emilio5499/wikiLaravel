<h1>Usuarios</h1>
<ul>
    @foreach($users as $user)
        <li>{{ $user->name }} - {{ $user->email }}
            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>
