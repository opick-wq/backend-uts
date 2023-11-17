<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;


class ControllerEmployess extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();
        if($employees->isEmpty()){
            $data = [
                'message' => 'Data is empty'
            ];
            return response()->json($data, 200);
        }

        $data =[
        'message' => 'Get All Resource',
        'data'=> $employees ];

        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //membuat validasi
        $request->validate([
            "name" => "required",
            "gender" => "required",
            "phone" => "required",
            "address" => "required",
            "email" => "required|email",
            "status" => "required",
            "hired_on" => "required"
        ]);


        $input = [
        'name'=>$request->name,
        'gender' =>$request->gender,
        'phone' =>$request->phone,
        'address' =>$request->address,
        'email' =>$request->email,
        'status' =>$request->status,
        'hired_on' =>$request->hired_on
        ];

        $employees = Employees::create($input);

        $data =[
        'message' => 'Resource is added successfully',
        'data'=> $employees 
        ];

        return response()->json($data,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employees = Employees::find($id);
        
        if ($employees){
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $employees,
            ];
                return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Resource not found'
            ];
                return response()->json($data, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employees = Employees::find($id);
        if ($employees) {
            $input = [
                'name'=>$request->name ?? $employees->name,
                'gender' =>$request->gender ?? $employees->gender,
                'phone' =>$request->phone ?? $employees->phone,
                'address' =>$request->address ?? $employees->address,
                'email' =>$request->email ?? $employees->email,
                'status' =>$request->status ?? $employees->status,
                'hired_on' =>$request->hired_on ?? $employees->hired_on   
            ];
        
        $employees->update($input);
            
        $data = [
            'message' => 'Resource is updated successfully',
            'data' => $employees,
        ];
            return response()->json($data, 200);
        }else{
        $data = [
            'message' => 'Resource not found'
        ];
            return response()->json($data, 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employees = Employees::find($id);

        if ($employees) {
            
        $employees->delete();

        $data = [
            'message' => 'Resource is delete successfuly'
        ];
        return response()->json($data, 200);
    
        }else{
        $data = [
            'message' => 'Resource not found'
        ];
        return response()->json($data, 404);
        }
    }

    public function search($name)
    {
    $employees = Employees::where('name', 'like', '%' . $name . '%')->get();

    if ($employees->isEmpty()) {
        return response()->json(['message' => 'Resource not Found'], 404);
    }

    $data = [
        'message' => 'Get Searched Resource',
        'data' => $employees,
    ];

    return response()->json($data, 200);
    }

    public function active($status){
    if (!$status) {
        return response()->json(['message' => 'Status parameter is required'], 400);
    }

    $resources = Employees::where('status', $status)->get();

    if ($resources->isEmpty()) {
        return response()->json(['message' => 'No resources found with the specified status'], 404);
    }

    $data = [
        'message' => 'Resources by Status',
        'data' => $resources,
        'total' => $resources->count(),
    ];

    return response()->json($data, 200);
    }
    
}
