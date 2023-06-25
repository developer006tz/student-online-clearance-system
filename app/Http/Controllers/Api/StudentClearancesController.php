<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClearanceResource;
use App\Http\Resources\ClearanceCollection;

class StudentClearancesController extends Controller
{
    public function index(
        Request $request,
        Student $student
    ): ClearanceCollection {
        $this->authorize('view', $student);

        $search = $request->get('search', '');

        $clearances = $student
            ->clearances()
            ->search($search)
            ->latest()
            ->paginate();

        return new ClearanceCollection($clearances);
    }

    public function store(Request $request, Student $student): ClearanceResource
    {
        $this->authorize('create', Clearance::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'registration_number' => ['required', 'max:255', 'string'],
            // 'block_number' => ['required', 'max:255', 'string'],
            // 'room_number' => ['required', 'max:255', 'string'],
            'level' => ['required', 'in:5,6'],
            'hall-wadern' => ['nullable', 'in:0,1'],
            'librarian-udsm' => ['nullable', 'in:0,1'],
            'librarian-cse' => ['nullable', 'in:0,1'],
            'coordinator' => ['nullable', 'in:0,1'],
            'principal' => ['nullable', 'in:0,1'],
            'smart-card' => ['nullable', 'in:0,1'],
        ]);

        $clearance = $student->clearances()->create($validated);

        return new ClearanceResource($clearance);
    }
}
