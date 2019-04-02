<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Auth;



class IndexController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {

    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     
     
     
     public function index_current()
	{
		$title = 'Home';
        $haveCourses = DB::table('all_courses')->WHERE('status', 'Active')->orderBy('created_at', 'DESC')->paginate(9);
        $haveCategories = DB::table('categories')->WHERE('parent_id', '!=', '[]')->orderBy('created_at', 'DESC')->get();
         $coursesCount = DB::table('all_courses')->whereNull('deleted_at')->WHERE('status', 'Active')->count();
// 		return view('frontend.index', compact('title', 'haveCourses', 'haveCategories'));
return view('frontend.index_current', compact('title', 'haveCourses', 'haveCategories', 'coursesCount'));
	}
	
	public function index()
	{
		$title = 'Home';
        $haveCourses = DB::table('all_courses')->WHERE('status', 'Active')->orderBy('created_at', 'DESC')->paginate(9);
        $haveCategories = DB::table('categories')->WHERE('parent_id', '!=', '[]')->orderBy('created_at', 'DESC')->get();
         $coursesCount = DB::table('all_courses')->whereNull('deleted_at')->WHERE('status', 'Active')->count();
// 		return view('frontend.index', compact('title', 'haveCourses', 'haveCategories'));
return view('frontend.index', compact('title', 'haveCourses', 'haveCategories', 'coursesCount'));
	}


    public function search_course(request $search){
        
    //   echo $search->search;
            $selectCourses = DB::table('all_courses')->whereNull('deleted_at')->WHERE([['status', '=' , 'Active'], ['name', 'like', '%'.$search->search.'%']])->get();
            $output = '';
            if($selectCourses){
                foreach ($selectCourses as $key => $course) {
                    $output = $output.'<li><a href="/single_course/'.$course->id.'">'.$course->name.'</a></li><br>';
                }    
             echo $output;
            }else{
                echo "<li>No Course Found...</li>";
            }
        
        
        
       
    }
	public function search($query)
	{
		$title = 'Ethical Hacking Course In Tamil';
        $haveCourses = DB::table('all_courses')->WHERE([['status', '=' , 'Active'], ['name', 'like', '%'.$query.'%']])->orderBy('created_at', 'DESC')->paginate(9);
        $haveCategories = DB::table('categories')->WHERE('parent_id', '!=', '[]')->orderBy('created_at', 'DESC')->get();
		return view('frontend.index', compact('title', 'haveCourses', 'haveCategories'));
	}

	public function single_course($id)
	{
        $singleCourse = DB::table('all_courses')->WHERE('id', $id)->first();
	    $title = $singleCourse->name;
		return view('frontend.single', compact('title', 'singleCourse'));
	}

	// public function buyNow($course_id, $user_id)
	// {
 //        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
 //        if ($singleCourse->purchased_by == '[]') {
 //        	$user = '["'.$user_id.'"]';
 //        } else {
 //        	$user = trim($singleCourse->purchased_by, ']');
 //        	$user .= ',"'.$user_id.'"]';
 //        }
 //    	$UpdatePur = ['purchased_by' => $user];
 //        $done = DB::table('all_courses')->where('id', $course_id)->update($UpdatePur);
        
 //        DB::table('payments')->insert([
	// 		'user_id' => $user_id,
	// 		'course_id' => $course_id,
	// 		'amount' => $singleCourse->price,
	// 		'instructor' => $singleCourse->user_id
	// 	]);
 //        return redirect('/single_course/'.$course_id);
	// }

	public function buyNow($course_id, $user_id)
	{
	    $status = $_GET['payment_status'];
		if($status == 'Failed'){
		     \Session::flash('message','Payment Failed');
		     return redirect('/single_course/'.$course_id);
            // return redirect('/single_course/'.$course_id)->with('error','Payment Failed');
		}else{
		    $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
        if ($singleCourse->purchased_by == '[]') {
        	$user = '["'.$user_id.'"]';
        } else {
        	$user = trim($singleCourse->purchased_by, ']');
        	$user .= ',"'.$user_id.'"]';
        }
    	$UpdatePur = ['purchased_by' => $user];
        $done = DB::table('all_courses')->where('id', $course_id)->update($UpdatePur);
        
        
        DB::table('payments')->insert([
			'user_id' => $user_id,
			'course_id' => $course_id,
			'amount' => $singleCourse->price,
			'instructor' => $singleCourse->user_id
		]);
        return redirect('/single_course/'.$course_id);    
		}
        
	}

	public function profile()
	{
		$title = 'Profile Ethical Hacking';
		if (Auth::check()) {
			return view('frontend.profile', compact('title'));
		} else {
			return redirect('/');
			
		}
	}

	public function course_videos($course_id)
	{
		$title = 'Course Videos Ethical Hacking';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();

	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	           if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.course_videos', compact('title', 'singleCourse'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
	}

	public function course_questions($course_id)
	{		

		$title = 'F.A.Q';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
	        $allQuestions = DB::table('faq_questions')->WHERE('course_id', $course_id)->orderBy('id', 'DESC')->limit(10)->get();

	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	           if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.questions', compact('title', 'singleCourse', 'allQuestions'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
	}

	public function questions_answer($course_id, $question_id)
	{		
		$title = 'Answers';
		if (Auth::check()) {
	        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();
	        $Question = DB::table('faq_questions')->WHERE('id', $question_id)->first();
	        $AllAnswers = DB::table('faq_answers')->WHERE([['course_id', $course_id], ['question_id', $question_id]])->orderBy('created_at', 'DESC')->get();
	        $purchased = explode(',', trim($singleCourse->purchased_by, "[]"));
	        if ($purchased != '') {
	        	if (in_array('"'.Auth::user()->id.'"', $purchased))  {
					return view('frontend.answer', compact('title', 'singleCourse', 'AllAnswers', 'Question'));
				}
				return redirect('/single_course/'.$course_id);
			}
		} else {
			return redirect('/');
		}
	}

	public function make_fav($course_id, $user_id)
	{
        $singleCourse = DB::table('all_courses')->WHERE('id', $course_id)->first();

        $arrayfavourite = explode(',', trim($singleCourse->favourite, "[]"));
        if (in_array('"'.$user_id.'"', $arrayfavourite)) {
        	$array_without_Fav = array_diff($arrayfavourite, array('"'.$user_id.'"'));
        	$newFav = '['.implode(",",$array_without_Fav).']';
        	$UpdateFav = ['favourite' => $newFav];
        } else {
        	if ($singleCourse->favourite == '[]') {
        		$IDforUpdate = '["'.$user_id.'"]';
	        	$UpdateFav = ['favourite' => $IDforUpdate];
        		
        	} else {
        	array_push($arrayfavourite, '"'.$user_id.'"');
        	$newFav = '['.implode(",",$arrayfavourite).']';
        	$UpdateFav = ['favourite' => $newFav];
        	}
        }
        $done = DB::table('all_courses')->where('id', $course_id)->update($UpdateFav);
		return redirect()->back();
	}
	public function student_login()
	{
		// echo "testing";
		$title = 'Login Ethical Hacking';
		return view('frontend.login', compact('title'));
	}

	public function studentverify($hash)
	{
        $studentGet = DB::table('users')->WHERE('hash_key', $hash)->first();
        if ($studentGet) {
	        $Updatehash = ['status' => 'active', 'hash_key' => Null];
			$done = DB::table('users')->where('hash_key', $hash)->update($Updatehash);
			return redirect('/frontend/login')->with('message', 'Thank You for Register Please login with your Email & Password');
        } else {
			return redirect('/frontend/login')->with('message', 'Token Expire !');
        }
	}

	public function student_register()
	{
		$title = 'Register Ethical Hacking';
		if (Auth::check()) {
			return redirect('/');
		}else {
			return view('frontend.register', compact('title'));
			
		}
	}

	public function login_check(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$userGet = DB::table('users')->Where([['email', $email], ['type', 'user']])->first();
		if ($userGet) {
			$passwordchecked = $userGet->password;
			if (Hash::check($password, $passwordchecked)) {
				$authenticateResult = $this->login_authenticate($userGet);
				if ($authenticateResult === true) {
					Auth::attempt(['email' => $email, 'password' => $password]);
					return redirect('/frontend/profile');
				}
				else {
					return redirect()->back()->withInput()->with('message', $authenticateResult);
				}
			}
			else{
				return redirect()->back()->withInput()->with('message', 'User Password Does Not Match! if you dont have your accout  <a href="/frontend/register">Register Here </a>');
			}
		}else {
			return redirect()->back()->withInput()->with('message', 'This Email address is not registered <a href="/frontend/register">Register Here </a>');
			
		}
		
	}

	public function register_check(Request $request)
	{
		$email = $request->input('email');
		$authenticateResult = $this->register_authenticate($email);
		$name = $request->input('first_name')." ".$request->input('last_name');
		if ($authenticateResult === true) {
		$employee = [
		    'name' => $name,
		    'role' => 3,
		    'mobile' => "",
		    'mobile2' => "",
		    'email' => $email,
		    'gender' => '',
		    'dept' => "1",
		    'city' => "",
		    'address' => "",
		    'about' => "About Student / biography",
		    'date_birth' => date("Y-m-d"),
		    'date_hire' => date("Y-m-d"),
		    'date_left' => date("Y-m-d"),
		    'salary_cur' => 0,
		    'created_at' => Carbon::now(),
		  ];
		$insertedEmployees = DB::table('employees')->insert($employee);
		$getInsertedId = DB::getPdo()->lastInsertId();
       
		if ($insertedEmployees) {
			$user = [
	            'name' => $name,
	            'email' => $email,
	            'password' => bcrypt($request->input('password')),
	            'context_id' => $getInsertedId,
	            'type' => "user",
	            'hash_key' => null,
			    'created_at' => Carbon::now(),
			    'status' => 'active',
	        ];
			$insertedUsers = DB::table('users')->insert($user);
			if ($insertedUsers) {
				$role = [
					'role_id' => 3,
					'user_id' => $getInsertedId,
				];
				DB::table('role_user')->insert($role);
			}
		}

			return redirect('/frontend/login')->with('message', 'Registerd Successfully Kindly Login');
		}
		else {
			return redirect()->back()->withInput()->with('message', $authenticateResult);
		}

	}

	public function register_authenticate($email)
	{
        $haveUser = DB::table('users')->WHERE('email', $email)->first();
        if ($haveUser) {
        	if ($haveUser->hash_key != Null && $haveUser->status == 'deactive') {
        		return $messsage = 'You have already submitted register form Please check your Email and click the confirmation link before <a href="/frontend/login">Login </a>';
        	}
        	if ($haveUser->hash_key == Null && $haveUser->status == 'deactive') {
        		return $messsage = 'Your profile is in under review process';
    		}
    		if ($haveUser->hash_key == Null && $haveUser->status == 'active' && $haveUser->type == 'user') {
        		return $messsage = 'Email Address already exists!';
    		}
    		if ($haveUser->hash_key == Null && $haveUser->status == 'active' && $haveUser->type == 'Employee') {
        		return $messsage = 'You dont have permission to register';
    		}

        }
        else {
        	return true;
        }
	}
	public function login_authenticate($userGet) {
    	if ($userGet->hash_key != Null && $userGet->status == 'deactive') {
    		return $messsage = 'Please check your Email and click the confirmation link before <a href="/frontend/login">Login </a>';
    	}
    	if ($userGet->hash_key == Null && $userGet->status == 'deactive') {
    		return $messsage = 'Your profile is in under review process';
		}
        else {
        	return true;
        }
	}

	public function logout() {
		Auth::logout();
		session()->flush();
		return redirect()->back();
	}


	public function submit_comment(Request $request){	
		$UserImage = $request->user_image;

		$current_time = Carbon::now()->toDateTimeString();
		DB::table('comments')->insert([
			'course_id' => $request->course_name,
			'user_id' => $request->user_id,
			'user_comments' => $request->current_user_comment,
			'created_at' => $current_time,
			'instructor' => $request->instructorID
		]);

		$current_comment = "<div class='post-author' style='margin-top:2%;'>
                     <div class='alignleft no-shrink rounded-circle'>                        
                        <img src=".$UserImage." class='rounded-circle' alt='image description'>
                     </div>
                     <div class='description-wrap'>
                        <h2 class='author-heading'><b>". Auth::user()->name."</b>".\Carbon\Carbon::parse($request->currentDate)->diffForHumans()."</h2>
                        <h3 class='author-heading-subtitle'>". $request->current_user_comment."</h3>
                     </div>
                  </div> ";

                  return $current_comment;
	}

	public function ask_question(Request $request){	

		$UserImage = $request->user_image;
		$current_time = Carbon::now()->toDateTimeString();
		DB::table('faq_questions')->insert([
			'course_id' => $request->course_id,
			'user_id' => $request->user_id,
			'title' => $request->question_title,
			'created_at' => $current_time,
			'question' => $request->question_ask,
			'answer_count' => 0
		]);
		$getInsertedId = DB::getPdo()->lastInsertId();

		$current_comment = "
			<div class='question-list-question--wrapper--1zMqr question-overview--question--244jE'>
			    <div class='question-list-question--question-link--iEDXQ'>
			       <div>
			          <div>
			            <img alt='".$request->user_name."' src='".$UserImage."' class='user-avatar user-avatar--image img-circle'>
			          </div>
			       </div>
			       <div class='question-list-question--content--SEjFC question-overview--question-content--2M-k-'>
			          <div class='question-list-question--title--4K-V_'>".$request->user_name."</div>
			          <div class='question-list-question--body--2v0oT'><a href='/answer/".$request->course_id."/".$getInsertedId."'>".$request->question_title."</a></div>
			       </div>
			       <div>
			          <div class='question-list-question--num-answers--2vE_g'>0</div>
			          <div class='responses'>Responses</div>
			       </div>
			    </div>
			</div>";
      return $current_comment;
	}

	public function write_answer(Request $request){	

        $Question = DB::table('faq_questions')->WHERE('id', $request->question_id)->first();
        $newCount = (int)$Question->answer_count + 1;
		$current_time = Carbon::now()->toDateTimeString();
		DB::table('faq_answers')->insert([
			'user_id' => $request->user_id,
			'question_id' => $request->question_id,
			'course_id' => $request->course_id,
			'answer' => $request->answer_text,
			'created_at' => $current_time
		]);
		$UpdateCount = ['answer_count' => $newCount];
        $updates = DB::table('faq_questions')->where('id', $request->question_id)->update($UpdateCount);
	}

	public function certificate($course_id){
	    $title = 'Certificate';
		return view('frontend.certificate', ['courseID' => $course_id], compact('title')); 

	}

	public function load_questions(Request $request){	
	    $allQuestions = DB::table('faq_questions')->WHERE('course_id', $request->course_id)->orderBy('id', 'DESC')->offset($request->offset)->limit(10)->get();
	    $newQuestions = "";
	    if (!empty($allQuestions)) {
		    foreach ($allQuestions as $key => $allQuestion) {
		    	$User = DB::table('employees')->WHERE('id', $allQuestion->user_id)->first();
		    	if ($User->image != 0) {
                  $Image = DB::table('uploads')->WHERE('id', $User->image)->first();
                    if ($Image) {
                      $UserImage = "/files/$Image->hash/$Image->name";
                    } else {
                     $UserImage = "/frontend/images/defaultImage.jpg";
                    }
                } else {
                     $UserImage = "/frontend/images/defaultImage.jpg";
	            }
	            $newQuestions .= "<div class='question-list-question--wrapper--1zMqr question-overview--question--244jE'><div class='question-list-question--question-link--iEDXQ'><div><div><img alt='".$User->name."' src='".$UserImage."' class='user-avatar user-avatar--image img-circle'></div></div><div class='question-list-question--content--SEjFC question-overview--question-content--2M-k-'><div class='question-list-question--title--4K-V_'>".$User->name."</div><div class='question-list-question--body--2v0oT'><a href='/answer/".$request->course_id."/".$allQuestion->id."'>".$allQuestion->title."</a></div></div><div><div class='question-list-question--num-answers--2vE_g'>".$allQuestion->answer_count."</div><div class='responses'>Responses</div></div></div></div>";
		    }
	    }
	    return $newQuestions;
	}
	
	// Payment

	public function createRequest(request $request){
    
        if($request->amount > 0){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        // curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER,
// 		            array("X-Api-Key:test_fa70c006a6d49ec49f17abc46c6",
// 		                  "X-Auth-Token:test_fce832d9fbca79e05c12e36551b"));
		curl_setopt($ch, CURLOPT_HTTPHEADER,
		            array("X-Api-Key:f020818fc4949ccf9b8e816cd37e281e",
		                  "X-Auth-Token:4839231580e63cd542b29ae45d3c682e"));
		$payload = Array(
		    'purpose' => $request->purpose,
		    'amount' => $request->amount,
		    'phone' => null,
		    'buyer_name' => $request->name,
		    'redirect_url' => 'http://frankeey.com/frontend/buyNow/'.$request->course_id.'/'.$request->user_id,
		    'send_email' => false,
		    'webhook' => 'http://instamojo.dev/webhook/',
		    'send_sms' => false,
		    'email' => $request->email,
		    'allow_repeated_payments' => false
		);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
		$response = curl_exec($ch);
		curl_close($ch); 

		 $data = json_decode($response, true);

		return redirect($data['payment_request']['longurl']);
        }else{
				return redirect('http://frankeey.com/frontend/buyNow/'.$request->course_id.'/'.$request->user_id.'?payment_status=success');
		}

	}

}
