<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Note;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Resources\V1\UserResource;

class ApiNoteController extends Controller
{
  public function index()
  {
    $user = User::find(auth()->user()->id);
    $users_with_notes = $user->following()->with(['notes' => function ($query) {
      $query->orderBy('created_at')->limit(1);  
    }])->get();
    return UserResource::collection(($users_with_notes));
  }

  public function store(NoteStoreRequest $request)
  {
    $note = Note::create([
      'note' => $request->note,
      'user_id' => auth()->user()->id,
    ]);
    return [
      'data' => [
        'note' => $note
      ]
    ];
  }

  public function destroy(Note $note)
  {
    $note->delete();
    return 'sucess';
  }
}
