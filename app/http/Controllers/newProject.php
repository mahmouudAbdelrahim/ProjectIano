<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
use App\project;
use Illuminate\Routing\Redirector;


class newProject extends Controller
{
    public function make(Request $request)
    {
        $project = new project();
        //dd($request);
        //dd('khara');
        $project->projectName = $request['name'];
        $project->auther = $request['auther'];
        $project->about = $request['about'];
        $project->importance = $request['category'];
        $project->save();
        return  redirect('home');
    }

    public function view()
    {
        $allprojects = project::all()->toArray();
        return view ('viewProjects', compact('allprojects'));
    }
    
    public function edit()
    {
        $allprojects = project::all()->toArray();
        return view ('editProject', compact('allprojects'));
    }
    public function update(Request $request)
    {
        $project = project::find($request['category']);
        return view ('updateProject', compact('project'));
    }
    public function finish(Request $request)
    {
       $updateProject = project::where('id', $request['_id'])->update
       ([
           'projectName'=> $request['name'],
           'about' => $request['about'], 
           'auther' => $request['auther'], 
           'importance' => $request['category']
       ]);

       return redirect()->route('viewProjects');

    }
}
