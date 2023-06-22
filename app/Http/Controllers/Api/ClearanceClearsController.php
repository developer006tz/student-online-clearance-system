<?php

namespace App\Http\Controllers\Api;

use App\Models\Clearance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClearResource;
use App\Http\Resources\ClearCollection;

class ClearanceClearsController extends Controller
{
    public function index(
        Request $request,
        Clearance $clearance
    ): ClearCollection {
        $this->authorize('view', $clearance);

        $search = $request->get('search', '');

        $clears = $clearance
            ->clears()
            ->search($search)
            ->latest()
            ->paginate();

        return new ClearCollection($clears);
    }

    public function store(Request $request, Clearance $clearance): ClearResource
    {
        $this->authorize('create', Clear::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'role' => ['required', 'max:255', 'string'],
            'comment' => ['required', 'max:255', 'string'],
            'signature' => ['required', 'in:0,1'],
            'date' => ['required', 'date'],
            'status' => ['nullable', 'in:0,1'],
        ]);

        $clear = $clearance->clears()->create($validated);

        return new ClearResource($clear);
    }
}
