<?php

namespace App\Http\Controllers\Api;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClearanceResource;
use App\Http\Resources\ClearanceCollection;
use App\Http\Requests\ClearanceStoreRequest;
use App\Http\Requests\ClearanceUpdateRequest;

class ClearanceController extends Controller
{
    public function index(Request $request): ClearanceCollection
    {
        $this->authorize('view-any', Clearance::class);

        $search = $request->get('search', '');

        $clearances = Clearance::search($search)
            ->latest()
            ->paginate();

        return new ClearanceCollection($clearances);
    }

    public function store(ClearanceStoreRequest $request): ClearanceResource
    {
        $this->authorize('create', Clearance::class);

        $validated = $request->validated();

        $clearance = Clearance::create($validated);

        return new ClearanceResource($clearance);
    }

    public function show(
        Request $request,
        Clearance $clearance
    ): ClearanceResource {
        $this->authorize('view', $clearance);

        return new ClearanceResource($clearance);
    }

    public function update(
        ClearanceUpdateRequest $request,
        Clearance $clearance
    ): ClearanceResource {
        $this->authorize('update', $clearance);

        $validated = $request->validated();

        $clearance->update($validated);

        return new ClearanceResource($clearance);
    }

    public function destroy(Request $request, Clearance $clearance): Response
    {
        $this->authorize('delete', $clearance);

        $clearance->delete();

        return response()->noContent();
    }
}
