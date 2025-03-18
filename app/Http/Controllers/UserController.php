<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whereClauser = function ($query) {
            if (request('first_name')) {
                $query->where("first_name", "LIKE", "%" . request('first_name') . "%");
            }

            if (request('department_id')) {
                $query->where("department_id", "LIKE", "%" . request('department_id') . "%");
            }

            if (request('last_name')) {
                $query->where("last_name", request('last_name'));
            }

            if (request('status')) {
                $query->where("status", request('status'));
            }
        };
        $params = [];
        $params['sort_type'] = request("sort_type") ? request("sort_type") : "asc";
        $params['sort_column'] = request("sort_column") ? request("sort_column") : "first_name";
        $userData = User::with("department")
            ->where($whereClauser)
            ->orderBy($params['sort_column'], $params['sort_type'])
            ->get();
        $htmlView = View::make("user_list", compact(["userData", "params"]))->render();
        return response()->json([
            "type" => "success",
            "view" => $htmlView
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department_id' => $request->department_id,
                'status' => $request->status,
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
            'message' => 'User created successfully!'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json([
            "type" => "success",
            "user" => $user->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->department_id = $request->department_id;
            $user->status = $request->status;
            $user->save();
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
            'message' => 'User updated successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            // Return a success response in JSON format
            return response()->json([
                "type" => "success",
                'message' => 'User deleted successfully!'
            ]);
        } else {
            return response()->json([
                "type" => "error",
                'message' => 'Something went wrong! During deleting user.'
            ]);
        }
    }
}
