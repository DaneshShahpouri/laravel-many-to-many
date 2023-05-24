<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('Admin/Projects/index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tecnologies = Technology::all();
        return view('Admin/Projects/create', compact('types', 'technologies'));
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
        $formProject = $request->all();
        $newProject = new Project();
        $newProject->fill($formProject);
        $newProject->slug = Str::slug($newProject->title, '-');
        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // $project = Project::findOrFail($project);

        return view('Admin/Projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validation($request);

        $form_data = $request->all();

        $project->update($form_data);
        $project->slug = Str::slug($project->title, '-');


        $project->save();

        return redirect()->route('admin.projects.show', $project->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index');
    }

    private function validation(Request $request)
    {
        $formData = $request->all();
        $validator = Validator::make($formData, [
            'title' => 'required|unique:projects,id|max:150',
            'description' => 'required',
            'year' => 'nullable|max:4',
            'type_id' => 'nullable|exists:projects,id'
        ], [
            'title.required' => "Titolo necessario per continuare",
            'title.max' => "Titolo troppo lungo, non deve superare i :max caratteri",
            'title.unique' => "Titolo già presente nel database",
            'description.required' => "Descrizione necessaria per continuare",
            'type_id.exists' => 'Tipo già presente.'
        ])->validate();
        return $validator;
    }
}
