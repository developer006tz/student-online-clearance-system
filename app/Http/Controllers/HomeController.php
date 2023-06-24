<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clearance;
use App\Models\Clear;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //get loged in user
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
       
         $student = Student::where('user_id', $user->id)->first();
        //get clearances of loged in student
        if ($role == 'student' && $student) {
            $clearances = Clearance::where('student_id', $user->student->id)->get();
            $clearance = Clearance::where('student_id', $user->student->id)->first();
            return view('home', compact('user', 'role', 'student', 'clearances', 'clearance'));
        }elseif($role != 'student' && $role != 'super-admin'){
            if(!empty($user)){
                $clearances = Clear::where('user_id', $user->id)->get();
            }else{
                $clearances = array();
            }
            
            return view('home', compact('user','clearances','role'));

        }
        else{
            return view('home', compact('user', 'role','student'));
        }
        
        
    }

    public function clearances()
    {
        $user = Auth::user();
        $clearances = Clear::where('user_id', $user->id)->get();
        return view('clearances', compact('clearances'));
    }

    public function clearancesShow($id)
    {
        $user = Auth::user();
        $clearance = Clear::where('id', $id)->first();
        return view('clearances-show', compact('clearance'));
    }

    public function clearancesUpdate(Request $request, $id)
    {
        $user = Auth::user();
        $clearance = Clear::where('id', $id)->first();
        $clearance->status = $request->status;
        $clearance->save();
        return redirect()->back()->with('success', 'Clearance Updated Successfully');
    }

}
