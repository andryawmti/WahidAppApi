<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('partials.page_menu_index')->with(['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.page_menu_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->title = $request->input('title');
        $menu->calorie = $request->input('calorie');
        $menu->ingredients = $request->input('ingredients');
        $menu->cooking_instruction = $request->input('cooking_instruction');
        $menu->description = $request->input('description');

        if ($request->hasFile('picture')) {
            $path = Storage::putFile('public/images', $request->file('picture'));
            $fileUrl = Storage::url($path);
            $menu->picture = $fileUrl;
            $menu->picture_mime = $request->file('picture')->getClientMimeType();
        }
        try {
            $menu->save();
            $result = ['success' => 'New menu successfully created'];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            error_log($error);
            $result = ['error' => $error];
        }

        return redirect()->route('menu.create')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);
        return view('partials.page_menu_edit')->with(['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->title = $request->input('title');
        $menu->calorie = $request->input('calorie');
        $menu->ingredients = $request->input('ingredients');
        $menu->cooking_instruction = $request->input('cooking_instruction');
        $menu->description = $request->input('description');

        if ($request->hasFile('picture')) {
            $path = Storage::putFile('public/images', $request->file('picture'));
            $fileUrl = Storage::url($path);
            $menu->picture = $fileUrl;
            $menu->picture_mime = $request->file('picture')->getClientMimeType();
        }

        try {
            $menu->save();
            $result = ['success' => 'Menu successfully updated'];
        } catch (\Exception $e) {
            $error = $e->getMessage();
            error_log($error);
            $result = ['error' => $error];
        }
        return redirect()->route('menu.edit', ['menu' => $menu->id])->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Menu::destroy($id);
            $result = ['success' => 'Menu successfully deleted'];
        }catch (\Exception $e) {
            $error = $e->getMessage();
            error_log($error);
            $result = ['error' => $error];
        }
        return redirect()->route('menu.index')->with($result);
    }
}
