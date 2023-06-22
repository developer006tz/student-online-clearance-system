<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClearResource;
use App\Http\Resources\ClearCollection;

class UserClearsController extends Controller
{
    public function index(Request $request, User $user): ClearCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $clears = $user
            ->clears()
            ->search($search)
            ->latest()
            ->paginate();

        return new ClearCollection($clears);
    }

    public function store(Request $request, User $user): ClearResource
    {
        $this->authorize('create', Clear::class);

        $validated = $request->validate([
            'clearance_id' => ['required', 'exists:clearances,id'],
            'role' => ['required', 'max:255', 'string'],
            'comment' => ['required', 'max:255', 'string'],
            'signature' => ['required', 'in:0,1'],
            'date' => ['required', 'date'],
            'status' => ['nullable', 'in:0,1'],
        ]);

        $clear = $user->clears()->create($validated);

        return new ClearResource($clear);
    }
}
