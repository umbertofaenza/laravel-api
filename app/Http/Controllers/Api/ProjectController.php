<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select("id", "name", "type_id", "slug", "description")
            ->with("technologies", "type")->get();

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     ** @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::select("id", "name", "type_id", "slug", "description")->where('id', $id)->with("technologies", "type")->first();

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     ** @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function projectsByType($type_id)
    {
        $type = Type::find($type_id);

        if (!$type) {
            abort(404);
        }

        $projects = Project::select("id", "name", "type_id", "slug", "description")
            ->where('type_id', $type_id)
            ->with("technologies", "type")
            ->get();

        return response()->json(
            [
                'type' => $type,
                'projects' => $projects,
            ]
        );
    }
}
