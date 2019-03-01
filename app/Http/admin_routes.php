<?php
/* ================== Frontend ================== */
Route::get('/', 'Frontend\IndexController@index');
Route::get('/frontend', 'Frontend\IndexController@index');
Route::get('/frontend/profile', 'Frontend\IndexController@profile');
Route::get('/frontend/login', 'Frontend\IndexController@student_login');
Route::post('/frontend/login_check', 'Frontend\IndexController@login_check');
Route::get('/frontend/register', 'Frontend\IndexController@student_register');
Route::post('/frontend/register_check', 'Frontend\IndexController@register_check');
Route::get('/frontend/logout', 'Frontend\IndexController@logout');
Route::get('/search/{query}', 'Frontend\IndexController@search');
Route::get('/single_course/{id}', 'Frontend\IndexController@single_course');
Route::get('/frontend/user_verify/{hash}', 'Frontend\IndexController@studentverify');
Route::get('/profile/make_fav/{course_id}/{user_id}', 'Frontend\IndexController@make_fav');
Route::get('/frontend/buyNow/{course_id}/{user_id}', 'Frontend\IndexController@buyNow');
Route::get('/course_videos/{id}', 'Frontend\IndexController@course_videos');
Route::get('/questions/{id}', 'Frontend\IndexController@course_questions');
Route::get('/answer/{course_id}/{id}', 'Frontend\IndexController@questions_answer');
Route::get('/frontend/thumb', 'Frontend\IndexController@thumb');

// Comment
Route::post('/comment', 'Frontend\IndexController@submit_comment');
Route::post('/ask_question', 'Frontend\IndexController@ask_question');
Route::get('/certificate/{id}', 'Frontend\IndexController@certificate');
// Payment
Route::post('/createRequest', 'Frontend\IndexController@createRequest');


/* ================== Homepage ================== */
// Route::get('/', 'LA\DashboardController@index');
// Route::get('/', 'LA\EmployeesController@index');
Route::get('/admin', 'HomeController@index');

Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_description', 'LA\UploadsController@update_description');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== Admission_forms ================== */


	/* ================== Categories ================== */
	Route::resource(config('laraadmin.adminRoute') . '/categories', 'LA\CategoriesController');
	Route::get(config('laraadmin.adminRoute') . '/category_dt_ajax', 'LA\CategoriesController@dtajax');


	/* ================== All_Courses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/all_courses', 'LA\All_CoursesController');
	Route::get(config('laraadmin.adminRoute') . '/all_course_dt_ajax', 'LA\All_CoursesController@dtajax');

	/* ================== User_Listing ================== */
	Route::resource(config('laraadmin.adminRoute') . '/user_listing', 'LA\User_listingController');
	Route::get(config('laraadmin.adminRoute') . '/user_listing/status/{id}', 'LA\User_listingController@status');
	




	/* ================== Comments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/comments', 'LA\CommentsController');
	Route::get(config('laraadmin.adminRoute') . '/comment_dt_ajax', 'LA\CommentsController@dtajax');


	/* ================== Videos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/videos', 'LA\VideosController');
	Route::get(config('laraadmin.adminRoute') . '/video_dt_ajax', 'LA\VideosController@dtajax');




	/* ================== Payments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/payments', 'LA\PaymentsController');
	Route::get(config('laraadmin.adminRoute') . '/payment_dt_ajax', 'LA\PaymentsController@dtajax');

	/* ================== Sidebar_Settings ================== */
// 	Route::resource(config('laraadmin.adminRoute') . '/sidebar_settings/1/edit', 'LA\Sidebar_SettingsController@edit');
	Route::resource(config('laraadmin.adminRoute') . '/sidebar_settings', 'LA\Sidebar_SettingsController');
	Route::get(config('laraadmin.adminRoute') . '/sidebar_setting_dt_ajax', 'LA\Sidebar_SettingsController@dtajax');
});
