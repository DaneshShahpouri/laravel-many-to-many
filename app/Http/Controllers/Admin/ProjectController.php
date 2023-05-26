<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
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
        $project = new Project();

        if ($request->hasFile('cover_image')) {
            $path = Storage::put('projects_images', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $project->fill($formData);
        $project->slug = Str::slug($project->title, '-');
        $project->save();

        // dd($formData);
        if (array_key_exists('technology', $formData)) {
            $project->technologies()->attach($formData['technology']);
        }

        return redirect()->route('admin.projects.show', $project);
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

        return view('admin.projects.show', compact('project'));
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
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
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

        $formData = $request->all();

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $path = Storage::put('projects_images', $request->cover_image);
            $formData['cover_image'] = $path;
        }

        $formData['slug'] = Str::slug($project->title, '-');
        $project->update($formData);


        $project->save();

        if (array_key_exists('technology', $formData)) {
            $project->technologies()->sync($formData['technology']);
        } else {
            $project->technologies->detach();
        }

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

        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }

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
            'type_id' => 'nullable|exists:projects,id',
            'cover_image' => 'nullable|image|max:2096'
        ], [
            'title.required' => "Titolo necessario per continuare",
            'title.max' => "Titolo troppo lungo, non deve superare i :max caratteri",
            'title.unique' => "Titolo già presente nel database",
            'description.required' => "Descrizione necessaria per continuare",
            'type_id.exists' => 'Tipo già presente.',
            'cover_image.image' => 'Devi necessariamente importare una immagine.',
            'cover_image.max' => 'Immagine troppo grande'
        ])->validate();
        return $validator;
    }

    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the projects table
        $projects = Project::query()
            ->where('title', 'LIKE', "%{$search}%")->get();
        // ->orWhere('body', 'LIKE', "%{$search}%")



        // Return the search view with the resluts compacted
        return view('admin.projects.index', compact('projects'));
    }
}
