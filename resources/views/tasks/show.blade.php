@extends('layouts.app')

@section('content')
    <h1>Detail Task</h1>

    <div class="card">
        <div class="card-header">
            <h2>{{ $task->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $task->description }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p><strong>Tanggal Jatuh Tempo:</strong> 
    {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}
</p>
            <p><strong>Kategori:</strong> {{ $task->category->name ?? 'Tidak Ada Kategori' }}</p>
            <p><strong>User ID:</strong> {{ $task->user_id }}</p>
        </div>
    </div>

    <h2>Riwayat Perubahan Status</h2>
    <ul>
        @forelse ($task->histories as $history)
            <li>
                <strong>Status:</strong> {{ ucfirst($history->status) }} <br>
                <strong>Tanggal Perubahan:</strong> {{ $history->created_at->format('Y-m-d H:i') }} <br>
                <strong>Deskripsi:</strong> {{ $history->description ?? 'Tidak ada deskripsi' }}
            </li>
        @empty
            <li>Belum ada riwayat perubahan status.</li>
        @endforelse
    </ul>

    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali ke Daftar Task</a>
@endsection
