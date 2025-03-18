<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view("department");
        }
        $whereClauser = function ($query) {
            if (request('name')) {
                $query->where("name", "LIKE", "%" .  request('name') . "%");
            }
        };
        $params = [];
        $params['sort_type'] = request("sort_type") ? request("sort_type") : "asc";
        $params['sort_column'] = request("sort_column") ? request("sort_column") : "name";
        $departmentData = Department::where($whereClauser)
            ->orderBy($params['sort_column'], $params['sort_type'])
            ->get();
        $htmlView = View::make("department_list", compact(["departmentData", "params"]))->render();
        return response()->json([
            "type" => "success",
            "view" => $htmlView
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            Department::create([
                'name' => $request->name,
            ]);
        } catch (Exception $e) {
            Log::error($e->getTraceAsString());
            // Return a failure response in JSON format
            return response()->json([
                "type" => "error",
                "message" => $e->getMessage()
            ]);
        }

        // Return a success response in JSON format
        return response()->json([
            "type" => "success",
            'message' => 'Department created successfully!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return response()->json([
            "type" => "success",
            "department" => $department->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $department->name = $request->name;
            $department->save();
        } catch (Exception $e) {
            Log::error($e->getTraceAsString());
            // Return a failure response in JSON format
            return response()->json([
                "type" => "error",
                "message" => $e->getMessage()
            ]);
        }

        // Return a success response in JSON format
        return response()->json([
            "type" => "success",
            'message' => 'Department updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department->delete()) {
            // Return a success response in JSON format
            return response()->json([
                "type" => "success",
                'message' => 'Department deleted successfully!'
            ]);
        } else {
            return response()->json([
                "type" => "error",
                'message' => 'Something went wrong! During deleting department.'
            ]);
        }
    }
}
