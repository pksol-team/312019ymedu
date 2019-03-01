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

use App\Models\All_Course;

class All_CoursesController extends Controller
{
	public $show_action = true;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'user_id', 'image', 'status', 'price'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('All_Courses', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('All_Courses', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the All_Courses.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('All_Courses');
		
		if(Module::hasAccess($module->id)) {
			return View('la.all_courses.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new all_course.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created all_course in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("All_Courses", "create")) {
		
			$rules = Module::validateRules("All_Courses", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			
			
			$request->description = str_replace("<script>", htmlspecialchars('<script>'), $request->description);
			$request->what_learn = str_replace("<script>", htmlspecialchars('<script>'), $request->what_learn);
// 			$request->content = str_replace("<script>", htmlspecialchars('<script>'), $request->content);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("All_Courses", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.all_courses.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified all_course.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("All_Courses", "view")) {
			
			$all_course = All_Course::find($id);
			if(isset($all_course->id)) {
				$module = Module::get('All_Courses');
				$module->row = $all_course;
				
				return view('la.all_courses.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('all_course', $all_course);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("all_course"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified all_course.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("All_Courses", "edit")) {			
			$all_course = All_Course::find($id);
			
		$all_course->description = str_replace("&lt;script&gt;", htmlspecialchars('&lt;script&gt;'), $all_course->description);
		$all_course->description = str_replace("&lt;/script&gt;", htmlspecialchars('&lt;/script&gt;'), $all_course->description);
		
		$all_course->what_learn = str_replace("&lt;script&gt;", htmlspecialchars('&lt;script&gt;'), $all_course->what_learn);
		$all_course->what_learn = str_replace("&lt;/script&gt;", htmlspecialchars('&lt;/script&gt;'), $all_course->what_learn);
		
		$all_course->content = str_replace("&lt;script&gt;", htmlspecialchars('&lt;script&gt;'), $all_course->content);
		$all_course->content = str_replace("&lt;/script&gt;", htmlspecialchars('&lt;/script&gt;'), $all_course->content);
			if(isset($all_course->id)) {	
				$module = Module::get('All_Courses');
				$module->row = $all_course;
				
				return view('la.all_courses.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('all_course', $all_course);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("all_course"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified all_course in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("All_Courses", "edit")) {
			
			$rules = Module::validateRules("All_Courses", $request, true);
			
			$validator = Validator::make($request->all(), $rules);

          
			$request->description = str_replace("<script>", htmlspecialchars('<script>'), $request->description);
			$request->what_learn = str_replace("<script>", htmlspecialchars('<script>'), $request->what_learn);
// 			$request->content = str_replace("<script>", htmlspecialchars('<script>'), $request->content);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("All_Courses", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.all_courses.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified all_course from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("All_Courses", "delete")) {
			All_Course::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.all_courses.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$user_Id = Auth::user()->id;
        $Role_User = DB::table('role_user')->WHERE('user_id', $user_Id)->first();
		if ($Role_User->role_id != 1) {
			$values = DB::table('all_courses')->select($this->listing_cols)->whereNull('deleted_at')->where('user_id', $user_Id)->orderBy('id','DESC');
		} else {
			$values = DB::table('all_courses')->select($this->listing_cols)->whereNull('deleted_at')->orderBy('id','DESC');
            
		}
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('All_Courses');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/all_courses/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				if($col == 'image') {
		            $uploded_image_TB = DB::table('uploads')->WHERE('id', $data->data[$i][$j])->first();
		            if ($uploded_image_TB) {
	                $uploded_image = "/files/$uploded_image_TB->hash/$uploded_image_TB->name";
					$data->data[$i][$j] = '<a class="preview" target="_blank" href="'.$uploded_image.'"><img src="'.$uploded_image.'" alt="Course Image" /></a>';
		            } else {
		            	$data->data[$i][$j] = '<img src="/la-assets/img/no_image_uploaded.png" alt="Course Image" />';
		            }
				}
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("All_Courses", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/all_courses/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("All_Courses", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.all_courses.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
	
}
