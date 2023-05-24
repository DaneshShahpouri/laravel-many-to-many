<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);
        $formData = $request->all();
        $newTechnology = new Technology();
        $newTechnology->fill($formData);
        $newTechnology->slug = Str::slug($newTechnology->name, '-');
        $newTechnology->save();

        return redirect()->route('admin.technologies.show', $newTechnology);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $this->validation($request);

        $form_data = $request->all();

        $technology->update($form_data);
        $technology->slug = Str::slug($technology->name, '-');


        $technology->save();

        return redirect()->route('admin.technologies.show', $technology->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index');
    }

    private function validation(Request $request)
    {
        $formData = $request->all();
        $validator = Validator::make($formData, [
            'name' => 'required|unique:types,id|max:150',
            'description' => 'required',
        ], [
            'name.required' => "Nome necessario per continuare",
            'name.max' => "Nome troppo lungo, non deve superare i :max caratteri",
            'name.unique' => "Nome già presente nel database",
            'description.required' => "Descrizione necessaria per continuare",

        ])->validate();
        return $validator;
    }
}
