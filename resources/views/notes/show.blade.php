@extends('layouts.app')

@section('content')
    <h1 class="mt-4">Note Details</h1>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $note->note }}</h5>
            <a href="{{ route('notes.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
