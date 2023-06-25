<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clear;
use Illuminate\View\View;
use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClearStoreRequest;
use App\Http\Requests\ClearUpdateRequest;

class ClearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Clear::class);

        $search = $request->get('search', '');

        //check is the user is not super-admin to show only his/her clear
        if (auth()->user()->hasRole('super-admin')) {
            $clears = Clear::search($search)
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return view('app.clears.index', compact('clears', 'search'));
        } else {
            $clears = Clear::search($search)
                ->where('user_id', auth()->user()->id)
                ->latest()
                ->paginate(5)
                ->withQueryString();

            return view('app.clears.user-clear', compact('clears', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Clear::class);

        $clearances = Clearance::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('app.clears.create', compact('clearances', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClearStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Clear::class);

        $validated = $request->validated();

        $clear = Clear::create($validated);

        return redirect()
            ->route('clears.edit', $clear)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Clear $clear): View
    {
        $this->authorize('view', $clear);

        return view('app.clears.show', compact('clear'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Clear $clear): View
    {
        $this->authorize('update', $clear);

        $clearances = Clearance::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $user_role_name = Auth()->user()->roles->pluck('name')->first();
        $clear_role = $clear->where('user_id', auth()->user()->id)->where('clearance_id',$clear->clearance_id)->first();
        return view('app.clears.update-clear', compact('clear', 'clearances', 'users', 'clear_role', 'user_role_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ClearUpdateRequest $request,
        Clear $clear
    ): RedirectResponse {
        $this->authorize('update', $clear);
        $validated = $request->validated();
        $validated['date'] = date('Y-m-d');
        $clear->update($validated);
        //update clearance column with name like $validated['role]
        $clearance = $clear->clearance()->update([$validated['role'] => $validated['status']]);
        return redirect()
            ->route('clears.index', $clear)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Clear $clear): RedirectResponse
    {
        $this->authorize('delete', $clear);

        $clear->delete();

        return redirect()
            ->route('clears.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
