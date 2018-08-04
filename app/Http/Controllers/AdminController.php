<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * show admin dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $admins = Admin::all();
        return view('partials.page_admin_index')->with(['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.page_admin_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = new Admin();
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->email = $request->input('email');
        $admin->password = Hash::make($request->input('password'));
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
            $result = ['success' =>"New admin successfully added"];
        }else{
            $error = true;
            $result = ['error' =>"New admin failed to save"];
        }

        return redirect()->route('admin.create')->with($result);
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
        $admin = Admin::find($id);
        return view('partials.page_admin_edit')->with(['admin' => $admin]);
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
            $result = ['success' => "Admin successfully updated"];
        }else{
            $error = true;
            $result = ['error' => "Admin failed to update"];
        }

        return redirect()->route('admin.edit', ['admin' => $admin->id])->with($result);
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

        return redirect()->route('admin.edit', ['admin' => $admin->id])->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        $result = ['success' => 'Admin '.$admin->first_name.' '.$admin->last_name.' successfully deleted'];
        return redirect()->route('admin.index')->with($result);
    }
}
