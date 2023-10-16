<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpsertRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        $technologies = Technology::all();
        
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectUpsertRequest $request)
    {
        $data = $request->validated();
        
        $data['image'] = Storage::put('projects', $data['image']);
        
        $project = Project::create($data);

        if (key_exists("technologies", $data)) {
            
            $project->technologies()->attach($data["technologies"]);
            
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $project = Project::findOrFail($id);
        
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $project = Project::findOrFail($id);

        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectUpsertRequest $request, int $id)
    {
        $project = Project::findOrFail($id);

        $data = $request->validated();

        if($project->image) {
            Storage::delete($project->image);
        }

        $img_path = Storage::put('projects', $data['image']);

        $data['image'] = $img_path;

        $project->update($data);
        
        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        if($project->image) {
            Storage::delete($project->image);
        }

        $project->technologies()->detach();

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
