<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // GET /api/patients
    public function index()
    {
        return "hello world";
        // response()->json(Patient::all(), 200);
    }

    // POST /api/patients
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|string|max:100|email',
            'adress'=> 'nullable|string',
        ]);

        $patient = Patient::create($validatedData);

        if(!$patient){
            return response()->json(['error'=>'Patient creation failed!'], 400);
        }

        return response()->json($patient, 201);
    }

    // GET /api/patients/{id}
    public function show($id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json(['error'=>'Patient not found!'], 404);
        }
        return response()->json($patient, 200);
    }

    // PUT/PATCH /api/patients/{id}
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json(['error'=>'Patient not found!'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email'=> 'sometimes|required|string|max:100|email',
            'adress'=> 'nullable|string',
        ]);

        $patient->update($validatedData);

        return response()->json($patient, 200);
    }

    // DELETE /api/patients/{id}
    public function destroy($id)
    {
        $patient = Patient::find($id);
        if(!$patient){
            return response()->json(['error'=>'Patient not found!'], 404);
        }

        $patient->delete();
        return response()->json(null, 204);
    }
}