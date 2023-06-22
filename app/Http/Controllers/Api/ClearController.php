<?php

namespace App\Http\Controllers\Api;

use App\Models\Clear;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClearResource;
use App\Http\Resources\ClearCollection;
use App\Http\Requests\ClearStoreRequest;
use App\Http\Requests\ClearUpdateRequest;

class ClearController extends Controller
{
    public function index(Request $request): ClearCollection
    {
        $this->authorize('view-any', Clear::class);

        $search = $request->get('search', '');

        $clears = Clear::search($search)
            ->latest()
            ->paginate();

        return new ClearCollection($clears);
    }

    public function store(ClearStoreRequest $request): ClearResource
    {
        $this->authorize('create', Clear::class);

        $validated = $request->validated();

        $clear = Clear::create($validated);

        return new ClearResource($clear);
    }

    public function show(Request $request, Clear $clear): ClearResource
    {
        $this->authorize('view', $clear);

        return new ClearResource($clear);
    }

    public function update(
        ClearUpdateRequest $request,
        Clear $clear
    ): ClearResource {
        $this->authorize('update', $clear);

        $validated = $request->validated();

        $clear->update($validated);

        return new ClearResource($clear);
    }

    public function destroy(Request $request, Clear $clear): Response
    {
        $this->authorize('delete', $clear);

        $clear->delete();

        return response()->noContent();
    }
}
