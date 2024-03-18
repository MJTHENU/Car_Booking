<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    public function index()
    {
        $users = Users::all();

        

        return response()->json(['users' => $users]);
    }

    public function show($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }

    public function store(Request $request)
    {
    
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|max:20',
            'mobile_no' => 'required|string|max:20',
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'type' => 'required|integer|between:1,3', // Add validation for 'type'
        ];
    
        $type = $request->input('type');
        $validatedData = array(); // Declare the array before using it
    
        if ($type == 1) {
            $rules = array_merge($rules, [
                'status' => 'required',
            ]);
        } elseif ($type == 2) {
            $rules = array_merge($rules, [
                'address' => 'required|string|max:200',
                'city' => 'required|string|max:250',
                'pincode' => 'required|integer',
                'license_no' => 'required|string|max:25',
                'alternate_no' => 'required|string|max:20',
                'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            ]);
        } else {
            // Type 3
            $rules = array_merge($rules, [
                'date_of_birth' => 'required|date',
                'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            ]);
        }
    
        $validator = validator($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    
        // Include the 'address' field in the data if type is 2
        if ($type == 2) {
            $validatedData['address'] = $request->input('address');
            $validatedData['city'] = $request->input('city');
            $validatedData['pincode'] = $request->input('pincode');
            $validatedData['license_no'] = $request->input('license_no');
            $validatedData['alternate_no'] = $request->input('alternate_no');
            $validatedData['gender'] = $request->input('gender');
        } elseif ($type == 3) {
            $validatedData['date_of_birth'] = $request->input('date_of_birth');
            $validatedData['gender'] = $request->input('gender');
        }
    
            // Populate the $validatedData array with common inputs
            $validatedData['first_name'] = $request->input('first_name');
            $validatedData['last_name'] = $request->input('last_name');
            $validatedData['email'] = $request->input('email');
            $validatedData['password'] = $request->input('password');
            $validatedData['mobile_no'] = $request->input('mobile_no');
            $validatedData['type'] = $type;
            $validatedData['status'] = $request->input('status');
    
        $user = Users::create($validatedData);
    
        return response()->json(['user' => $user], 201);
    }
    
    
    public function update(Request $request, $id)
{
    $user = Users::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $rules = [
        'first_name' => 'string|max:50',
        'last_name' => 'string|max:50',
        'email' => 'email|unique:users,email,' . $user->id, // Ignore current user's email for uniqueness check
        'password' => 'string|max:20',
        'mobile_no' => 'string|max:20',
        'status' => Rule::in(['active', 'inactive']),
        'type' => 'integer|between:1,3',
    ];

    $type = $request->input('type');

    if ($type == 2) {
        $rules = array_merge($rules, [
            'address' => 'string|max:200',
            'city' => 'string|max:250',
            'pincode' => 'integer',
            'license_no' => 'string|max:25',
            'alternate_no' => 'string|max:20',
            'gender' => Rule::in(['male', 'female', 'other']),
        ]);
    } elseif ($type == 3) {
        $rules = array_merge($rules, [
            'date_of_birth' => 'date',
            'gender' => Rule::in(['male', 'female', 'other']),
        ]);
    }

    $validator = validator($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 400);
    }

    // Update user fields based on input data
    $user->update($request->all());

    return response()->json(['user' => $user]);
}

    public function destroy($id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
