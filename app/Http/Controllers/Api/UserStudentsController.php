<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class UserStudentsController extends Controller
{
    public function index(Request $request, User $user): StudentCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $students = $user
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    public function store(Request $request, User $user): StudentResource
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'id_number' => ['required', 'max:255', 'string'],
            // 'block_number' => ['required', 'max:255', 'string'],
            // 'room_number' => ['required', 'max:255', 'string'],
        ]);

        $student = $user->students()->create($validated);

        return new StudentResource($student);
    }
}
