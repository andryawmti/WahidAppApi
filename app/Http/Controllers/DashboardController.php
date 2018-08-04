<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("partials.page_dashboard");
    }

    public function profileSettings()
    {
        return view('partials.page_profile_settings');
    }

    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->email = $request->input('email');
        $admin->address = $request->input('address');
        $admin->birth_date = $request->input('birth_date');

        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $file_url = Storage::url($path);
            $admin->photo = $file_url;
            $admin->photo_mime = $request->file('image')->getClientMimeType();
        }
        $save = $admin->save();

        if ($save) {
            $error = false;
            $result = ['success' => "Profile successfully updated"];
        }else{
            $error = true;
            $result = ['error' => "Profile failed to update"];
        }

        return redirect()->route('profile')->with($result);
    }

    public function updatePassword(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->password = Hash::make($request->input('password'));
        $save = $admin->save();

        if ($save) {
            $error = false;
            $result= ['success' => "Password successfully updated"];
        }else{
            $error = true;
            $result = ['error' => "Password failed to update"];
        }

        return redirect()->route('profile')->with($result);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
