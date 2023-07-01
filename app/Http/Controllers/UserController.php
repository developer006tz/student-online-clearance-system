<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use App\Models\Message;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', User::class);

        $search = $request->get('search', '');

        $users = User::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', User::class);

        $roles = Role::get();

        return view('app.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.jpg';
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(400, 400);
            $image_resize->encode('jpg',80);
            $image_resize->save(storage_path('app/public/' . $filename));
            $validated['image'] = $filename;
        }

        // check if user with taht role exists

        $user = User::create($validated);

        $user->syncRoles($request->roles);

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user): View
    {
        $this->authorize('view', $user);

        $role_name = $user->getRoleNames()->first();

        return view('app.users.profile', compact('user','role_name'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, User $user): View
    {
        $this->authorize('update', $user);

        $roles = Role::get();

        return view('app.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UserStoreRequest $request,
        User $user
    ): RedirectResponse {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $image = $request->file('image');
            $filename = time() . '.jpg';
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(132, 132);
            $image_resize->encode('jpg', 80);
            $image_resize->save(storage_path('app/public/' . $filename));
            $validated['image'] = $filename;
        }

        $user->update($validated);
        if(Auth()->user()->hasRole('super-admin')){
            $user->syncRoles($request->roles);
        }
        

        return redirect()
            ->route('users.edit', $user)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->authorize('delete', $user);

        if ($user->image) {
            Storage::delete($user->image);
        }
        
        $user->delete();

        return redirect()
            ->route('users.index')
            ->withSuccess(__('crud.common.removed'));
    }

    // edit student profile as well as its user profile
    public function edit_student_profile($student_id): View
    {
        $student = Student::find($student_id);
        $user = $student->user;
        $this->authorize('update', $user);
        return view('app.students.edit-profile', compact('user', 'student'));
    }

    // update student profile as well as its user profile
    public function updateProfile( Request $request, User $user): RedirectResponse
     {
        $this->authorize('update', $user);
        $user_validated = $request->validate(
            [
                'name' => ['required', 'max:255', 'string','min:3'],
                'email' => [
                    'required',
                    Rule::unique('users', 'email')->ignore($user->id),
                    'email',
                ],
                'role' => [
                    'required',
                    'in:student',
                ],
                'username' => [
                    'required',
                    Rule::unique('users', 'username')->ignore($user->id),
                    'max:255',
                    'string',
                ],
                'password' => ['nullable', 'max:255', 'string'],
                'image' => ['nullable', 'image', 'max:9024'],
            ]
        );


        $student_validated = $request->validate(
            [
                
                'user_id' => ['required', 'exists:users,id'],
                'id_number' => ['required', 'max:255', 'string'],
                'level' => ['required', 'in:certificate,diploma'],
                // 'block_number' => ['required', 'max:255', 'string'],
                // 'room_number' => ['required', 'max:255', 'string'],
            ]
        );

        if (empty($user_validated['password'])) {
            unset($user_validated['password']);
        } else {
            $user_validated['password'] = Hash::make($user_validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $image = $request->file('image');
            $filename = time() . '.jpg';
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(132, 132);
            $image_resize->encode('jpg', 80);
            $image_resize->save(storage_path('app/public/' . $filename));
            $user_validated['image'] = $filename;
        }

        $user->update($user_validated);
        $student = $user->student;
        $student->update($student_validated);

        //if user is updated, and if username is updated to the new value send email to alert username change
        $sms = $this->getSmsBody($user, $request['password']);
        try {
            Message::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'body' => $sms,
            ]);
            sendEmail($user->email, $user->name, 'PROFILE UPDATED', $sms);

        } catch (\Throwable $th) {
            $th->getMessage();
        }

        return redirect()->route('students.show',$student)->withSuccess(__('crud.common.saved'));
            
    }

    private function getSmsBody($user, $password)
    {
        $sms = " ";
        $warning = "If you did not make this change, please contact the system administrator immediately.\n\n";
   
        $footer = "Regards,\n" .
            "UDSM Online Clearance System\n" .
            "Mwalimu Julius Nyerere Mlimani Campus\n" .
            "P.O. Box 35091\n" .
            "Dar es Salaam, Tanzania\n" .
            "Tel: +255 754 311 439\n" .
            "Email:lms@udsm.ac.tz";

        if ($user->wasChanged('username') && $user->wasChanged('password')) {
            $sms .= "Your username and password have been changed to " . $user->username . " and " . $password . " respectively.\n\n";
        } elseif ($user->wasChanged('username')) {
            $sms .= "Your username has been changed to " . $user->username . ".\n\n";
        } elseif ($user->wasChanged('password')) {
            $sms .= "Your password has been changed to " . $password . ".\n\n";
        } else {
            $sms .= "Your profile has been updated.\n\n";
        }

        return $sms .$warning. $footer;
    }


}
