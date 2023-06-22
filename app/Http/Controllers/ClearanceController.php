<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Clearance;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClearanceStoreRequest;
use App\Http\Requests\ClearanceUpdateRequest;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Clearance::class);

        $search = $request->get('search', '');

        $clearances = Clearance::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.clearances.index', compact('clearances', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Clearance::class);

        $students = Student::pluck('id_number', 'id');

        return view('app.clearances.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClearanceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Clearance::class);

        $validated = $request->validated();

        $clearance = Clearance::create($validated);

        return redirect()
            ->route('clearances.edit', $clearance)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Clearance $clearance): View
    {
        $this->authorize('view', $clearance);

        return view('app.clearances.show', compact('clearance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Clearance $clearance): View
    {
        $this->authorize('update', $clearance);

        $students = Student::pluck('id_number', 'id');

        return view('app.clearances.edit', compact('clearance', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ClearanceUpdateRequest $request,
        Clearance $clearance
    ): RedirectResponse {
        $this->authorize('update', $clearance);

        $validated = $request->validated();

        $clearance->update($validated);

        return redirect()
            ->route('clearances.edit', $clearance)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Clearance $clearance
    ): RedirectResponse {
        $this->authorize('delete', $clearance);

        $clearance->delete();

        return redirect()
            ->route('clearances.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
