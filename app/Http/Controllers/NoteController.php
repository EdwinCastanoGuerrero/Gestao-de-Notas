<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\HttpCache\Store;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 15); 
        $notas = Note::paginate($perPage);
        return response()->json($notas->toResourceCollection(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $data = $request->validated(); 
        try {
            $note = new Note();
            $note->fill($data);
            $note->save();
            return response()->json($note->toResource(), 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Falha ao criar a nota'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $note = Note::findOrFail($id);
            return response()->json($note->toResource(), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $data = $request->validated();
        try {
            $note->fill($data);
            $note->save();
            return response()->json($note->toResource(), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Falha ao atualizar a nota'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {

        try {
            Note::destroy($note->id);
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Falha ao deletar a nota'], 400);
        }
    }
}
