<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
// ************ Requests ************
use Modules\Staff\Http\Requests\EditProfileRequest;
use Modules\Staff\Http\Requests\ChangePasswordRequest;
// ************ Mails ************
// ************ Models ************
use App\User;

class MyprofileController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_myprofile() {
        $data['active_tab'] = (isset($_GET['tab']) && $_GET['tab'] !== NULL) ? $_GET['tab'] : 'tab_1';
        $model = Auth::guard('staff')->user();
        $data['model'] = $model;
        return view('staff::myprofile.index', $data);
    }

    public function post_myprofile(EditProfileRequest $request) {
        $data = [];
        $model = Auth::guard('staff')->user();
        $data['tab'] = 'tab_1';
        $image_pre = $model->image;
        $input = $request->all();
        if ($request->file('image')) {
            $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/staff/profile_picture/original/'), $img_name);
            Image::make(public_path('uploads/staff/profile_picture/original/') . $img_name)->resize(500, 500)->save(public_path('uploads/staff/profile_picture/preview/') . $img_name);
            Image::make(public_path('uploads/staff/profile_picture/original/') . $img_name)->resize(200, 200)->save(public_path('uploads/staff/profile_picture/thumb/') . $img_name);
            $input['image'] = $img_name;
        }
        $model->update($input);
        $request->session()->flash('success', 'Profile updated successfully.');
        return redirect()->route('staff-myprofile', $data)->withInput();
    }

    public function post_changepassword(ChangePasswordRequest $request) {
        $data = [];
        $model = Auth::guard('staff')->user();
        $data['tab'] = 'tab_2';
        $input = $request->all();
        $input['password'] = Hash::make($request->input('new_password'));
        $model->update($input);
        $request->session()->flash('success', 'Password changed successfully.');
        return redirect()->route('staff-myprofile', $data)->withInput($request->except('old_password', 'new_password', 'retype_password'));
    }

}
