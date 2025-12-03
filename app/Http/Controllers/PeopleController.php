<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Http\Resources\PeopleCollection;
use App\Http\Resources\PeopleResource;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 3);
        $page = $request->input('page', 1);
        
        $people = People::paginate($perPage, $page);
        
        return new PeopleCollection($people);
    }

    public function show($id)
    {
        $person = People::find($id);
        
        if (!$person) {
            return response()->json([
                'errors' => [
                    [
                        'status' => '404',
                        'title' => 'Not Found',
                        'detail' => 'The requested person does not exist.'
                    ]
                ]
            ], 404);
        }
        
        return new PeopleResource($person);
    }

    public function store(Request $request)
    {
        return response()->json([
            'error' => 'Method not supported with mock data'
        ], 405);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'error' => 'Method not supported with mock data'
        ], 405);
    }

    public function destroy($id)
    {
        return response()->json([
            'error' => 'Method not supported with mock data'
        ], 405);
    }
}