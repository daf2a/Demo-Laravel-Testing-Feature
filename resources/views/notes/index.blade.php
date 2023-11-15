@extends('layouts.app')

@section('content')

<h1 class="mt-4"> Note App </h1>
    <a href="{{ route('notes.create') }}" class="btn btn-primary">Create a new note</a>
    @foreach ($notes as $note)
        <h4 class="mt-3">Note {{ $note->id-1 }}</h3>
        <p>{{ $note->note }}</p>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('notes.show', $note->id) }}" class="mr-1 btn btn-primary">Show</a>
            <a href="{{ route('notes.edit', $note->id) }}" class="mr-1 btn btn-warning">Edit</a>
            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endforeach
@endsection
