<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\User;

class User_listingController extends Controller
{
	/**
	 * Display a listing of the Users.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
        $AllUsers = DB::table('users')->WHERE('type', 'user')->orderBy('created_at', 'DESC')->get();
        return view('la.user_listing.index', compact('AllUsers'));
	}

	public function status($id)
	{
        $GetUser = DB::table('users')->WHERE('id', $id)->first();
        $newStatus = ($GetUser->status == 'deactive') ? 'active' : 'deactive';

        $UpdateStatus = ['status' => $newStatus];
		DB::table('users')->where('id', $id)->update($UpdateStatus);
        $AllUsers = DB::table('users')->WHERE('type', 'user')->orderBy('created_at', 'DESC')->get();
        return view('la.user_listing.index', compact('AllUsers'));
	}

}
