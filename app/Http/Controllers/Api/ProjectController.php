<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        //$projects = Project::all();
        $projects = Project::paginate(6);

        return response()->json([
            'success' => true,
            'results' => $projects

        ]);
    }

    public function show(string $slug)
    {
        //costruisco la query
        $project = Project::where('slug', $slug)->with('technologies')->first();

        if ($project) {
            return response()->json([
                'status' => true,
                'results' => $project
            ]);
        } else {
            return response()->json([
                'status' => false,
                'results' => null
            ], 404);
        }
    }
}
