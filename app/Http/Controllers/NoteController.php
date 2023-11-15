<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;


class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', ['notes' => $notes]);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        Note::create($request->all());
        return redirect()->route('notes.index');
    }

    public function show(Note $note)
    {
        return view('notes.show', ['note' => $note]);
    }

    public function edit(Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->all());
        return redirect()->route('notes.show', ['note' => $note]);
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index');
    }
}