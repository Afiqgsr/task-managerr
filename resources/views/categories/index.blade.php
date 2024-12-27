@extends('layouts.app')

@section('content')
    <h1>Daftar Kategori</h1>
    <a href="{{ route('category.task') }}" class="btn btn-success">Tambah Kategori</a> Green button

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Logout Form -->
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger float-end">Logout</button> <!-- Red button -->
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Deskription</th>
                <th>Button</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->slug }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <a href="{{ route('category', $task->id) }}" class="btn btn-info">Detail</a>

                        <!-- Check if the logged-in user is the owner of the tasak -->
                        @if (Auth::id() === $task->user_id)
                            <a href="{{ route('category', $task->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('category.delete', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
