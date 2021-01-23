<?php

// Room Owner's role id = 1
// Room seeker's role id = 2


/* Route::get('/', function () {
    return view('welcome');
})->name('/'); */

Auth::routes(['verify' => true]);

Route::view('/read_more', 'read_more')->name('read_more');

Route::get('request_report/report/{reported_user_id}', 'RequestReportController@show_report_form')->name('report.user_form');
Route::resource('request_report', 'RequestReportController');

Route::get('/', 'FrontEndController@index')->name('/');
Route::get('/category_room/{category_id}', 'FrontEndController@category_room')->name('category_room');
Route::get('/category_room/room/{room}', 'FrontEndController@category_room_show')->name('category_room_show');
Route::get('/search_room', 'FrontEndController@search_room')->name('search_room');
#------------------------------------------------------------------------------------------------------------------------------#

Route::group(['middleware' => ['auth', 'verified']], function () {

    //----------------------------------------------------------------------------------------------------
    // ((Default Routes))
    //----------------------------------------------------------------------------------------------------
    Route::get('/home', 'HomeController@index')->name('home');
    #------------------------------------------------------------------------------------------((Chat system))
    Route::get('/friends', 'FriendController@index')->name('all_friends');
    Route::get('/message/{id}', 'FriendController@getMessage')->name('message');
    Route::post('message', 'FriendController@sendMessage');
    #-----------------------------------------------------------------------------------------((Room Comments))
    Route::post('comment/create/{room}', 'CommentController@addRoomComment')->name('room.comment');
    Route::post('comment/update/{comment}', 'CommentController@updateRoomComment')->name('room.comment_update');
    Route::delete('comment/delete/{comment}', 'CommentController@deleteRoomComment')->name('room.comment_delete');
    Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('room.reply');

    #------------------------------------------------------------------------------------------------((Notice))
    Route::get('notices/see/{id}', 'NoticeController@show')->name('notice.show');
    Route::resource('notice', 'NoticeController')->except(['show']);

    #--------------------------------------------------------------------------------------------------((Rating))
    Route::post('/add_rating', 'RoomController@addRating')->name('add_rating');
    Route::get('/recommendation', 'RoomController@recommendationMatrix')->name('recommendationMatrix');

    #---------------------------------------------------------------------------------------------((Testimonial))
    Route::get('testimonial/approve/{testimonial}', 'TestimonialController@approve')->name('testimonial.approve');
    Route::get('testimonial/disapprove/{testimonial}', 'TestimonialController@disapprove')->name('testimonial.disapprove');
    Route::resource('testimonial', 'TestimonialController')->except('show');

    //-----------------------------------------------------------------------------------------------------------------------
    // ((Room Seeker))
    //-----------------------------------------------------------------------------------------------------------------------

    #---------------------------------------------------------------------------------------(Room seeker Profile))
    Route::get('seeker/dashboard', 'SeekerController@dashboard')->name('seeker.dashboard');
    Route::get('seeker/profile/{name}', 'SeekerController@profile')->name('seeker_profile');
    Route::get('seeker/show/{id}', 'SeekerController@show')->name('seeker.show');
    Route::resource('seeker', 'SeekerController')->except(['show', 'edit', 'create']);

    Route::post('/education_ajax', 'EducationController@Ajax')->name('ajax.post');
    Route::resource('education', 'EducationController')->only(['store', 'update', 'destroy']);

    Route::post('/work_ajax', 'WorkController@Ajax')->name('ajax.work');
    Route::resource('work', 'WorkController')->only(['store', 'update', 'destroy']);

    #-------------------------------------------------------------------------------------((Seeker's Room functions))
    Route::post('seeker_room_ajax', 'SeekerRoomController@allRoomAjax')->name('ajax.all_room');
    Route::get('seeker_room/search', 'SeekerRoomController@allRoomSearch');
    Route::get('seeker/my_rooms', 'SeekerRoomController@seekerRoom')->name('my_rooms');
    Route::get('seeker_room', 'SeekerRoomController@index')->name('seeker_room');

    #-----------------------------------------------------------------------------------------------((Room Bookmarks))
    Route::get('seeker/add_bookmark/{id}', 'BookmarkController@addBookmark')->name('add_bookmark');
    Route::get('seeker/remove_bookmark/{id}', 'BookmarkController@removeBookmark')->name('remove_bookmark');
    Route::get('seeker/my_bookmarks', 'BookmarkController@myBookmarks')->name('my_bookmarks');

    #----------------------------------------------------------------------------------------((Applicant/Application))

    Route::get('applicant/create/{id}', 'ApplicantController@create')->name('applicant.create');
    Route::post('applicant/store/{room_id}', 'ApplicantController@store')->name('applicant.store');
    Route::get('applicant/user/{user_id}/room/{room_id}', 'ApplicantController@viewApplicants')->name('applicants.view');
    Route::get('applicant/{user_id}/{room_id}/hire', 'ApplicantController@hire')->name('applicant.hire');
    Route::get('applicant/{user_id}/{room_id}/reject', 'ApplicantController@reject')->name('applicant.reject');


    //------------------------------------------------------------------------------------------------------------------------
    // ((Room Owner))
    //------------------------------------------------------------------------------------------------------------------------

    #----------------------------------------------------------------------------------------------((Room Owner Profile))
    Route::get('owner/dashboard', 'OwnerController@dashboard')->name('owner.dashboard');
    Route::get('owner/profile/{name}', 'OwnerController@profile')->name('owner_profile');
    Route::get('owner/show/{id}', 'OwnerController@show')->name('owner.show');
    Route::resource('owner', 'OwnerController')->except(['show', 'edit', 'create']);

    #-------------------------------------------------------------------------------------------------------((Room Main))

    Route::get('room/show/{id}', 'RoomController@show')->name('room.show');
    Route::resource('room', 'RoomController')->except(['show']);

    //--------------------------------------------------------------------------------------------------------------------------
    // ((Site Admin))
    //--------------------------------------------------------------------------------------------------------------------------

    #---------------------------------------------------------------------------------------------------------(( Admin ))

    Route::get('admin/all_users', 'AdminController@index')->name('admin.all_users');
    Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('admin/banOwner/{id}', 'AdminController@banOwner')->name('admin.ban_owner');
    Route::get('admin/unbanOwner/{id}', 'AdminController@unbanOwner')->name('admin.unban_owner');
    Route::get('admin/unbanSeeker/{id}', 'AdminController@unbanSeeker')->name('admin.unban_seeker');
    Route::get('admin/banSeeker/{id}', 'AdminController@banSeeker')->name('admin.ban_seeker');

    #----------------------------------------------------------------------------------------------------((Room Category))

    Route::put('/tasks/{task}/toggle', 'TaskController@toggle')->name('tasks.toggle');
    Route::resource('/tasks', 'TaskController')->except('show');

    #----------------------------------------------------------------------------------------------------((Room Category))
    Route::resource('room_category', 'CategoryController')->except(['show', 'edit', 'create']);

    #-----------------------------------------------------------------------------------------=--------((Room Facilities))

    Route::resource('room_facility', 'FacilityController')->except(['show', 'edit', 'create']);
});
