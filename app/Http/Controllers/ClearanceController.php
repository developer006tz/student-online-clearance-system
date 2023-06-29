<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Clearance;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClearanceStoreRequest;
use App\Http\Requests\ClearanceUpdateRequest;
use App\Models\Clear;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Exception;

class ClearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        $this->middleware('auth');

    }
     
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

    public function request_clearance(Request $request, Student $student ): RedirectResponse
    {
        $this->authorize('create', Clearance::class);
        $data = [
            'student_id' => $student->id,
            'name' => $student->user->name,
            'registration_number' => $student->id_number,
            'block_number' => $student->block_number,
            'room_number' => $student->room_number,
            'level' => $student->level,
        ];

        $check = Clearance::where('student_id', $student->id)->first();
        if($check){
            return redirect()
                ->route('home')
                ->with('error', 'You have already requested for clearance');
        }else{
            try {
                DB::transaction(function () use ($data) {
                    $clearance = Clearance::create($data);
                    //for each of the roles on system except student and super-admin create clear in Clear::model
                    $roles = Role::whereNotIn('name', ['super-admin', 'admin', 'student', 'user'])->pluck('id', 'name');
                    //check if the role has users and if it does create a clear for each user else return back with error
                    $missingRoles = [];

                    foreach ($roles as $role_name => $role_id) {
                        $users = User::whereHas('roles', function ($query) use ($role_id) {
                            $query->where('id', $role_id);
                        })->get();
                        if ($users->isEmpty()) {
                            $missingRoles[] = $role_name;
                        }
                    }

                    if (!empty($missingRoles)) {
                        throw new Exception('No users found for the following roles: ' . implode(', ', $missingRoles));
                    }

                    foreach ($roles as $role_name => $role_id) {
                        $users = User::whereHas('roles', function ($query) use ($role_id) {
                            $query->where('id', $role_id);
                        })->get();
                        foreach ($users as $user) {
                            Clear::create([
                                'clearance_id' => $clearance->id,
                                'user_id' => $user->id,
                                'role' => $role_name,
                                'comment' => trim('No comment'),
                                'date' => now(),
                            ]);
                        }
                    }
                });
            } catch (\Throwable $th) {
                return redirect()
                    ->route('home')
                    ->with('error', 'Clearance request failed: ' . $th->getMessage());
            }


            return redirect()
                ->route('home')
                ->with('success', 'Clearance request created successfully');

            }
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
