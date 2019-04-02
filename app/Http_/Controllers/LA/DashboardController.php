<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
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
     * @return Response
     */
    public function index()
    {

        $AllStudents = DB::table('users')->WHERE('type', 'user')->count();
        // $AllStaff = DB::table('users')->WHERE('type', 'Employee')->count();
        $AllStaff = DB::table('employees')->WHERE('role', 2)->count();
        $All_courses = DB::table('all_courses')->WHERE('deleted_at', Null)->count();
        $DeactiveCourses = DB::table('all_courses')->WHERE([['status', 'Deactive'], ['deleted_at', Null]])->count();

        $user_Id = Auth::user()->id;
        $Role_User = DB::table('role_user')->WHERE('user_id', $user_Id)->first();
        if ($Role_User->role_id == 1) {
        return view('la.dashboard',  compact('AllStudents', 'AllStaff', 'All_courses', 'DeactiveCourses'));
        }
        elseif ($Role_User->role_id == 3) {
            return redirect('/');
        }
        else {
            return redirect('/admin/all_courses');
            
        }
    }
}