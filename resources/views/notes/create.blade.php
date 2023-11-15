@extends('layouts.app')

@section('content')
    <h1 class="mt-4">Create Note</h1>
    <form action="{{ route('notes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="note">Note:</label>
            <input type="text" class="form-control" id="note" name="note">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
