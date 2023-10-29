<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // mendapatkan semua data students
        $students = Student::all();

        $data = [
            "message" => "Get all resources",
            "data" => $students
        ];

        // kirim data(json) dan response code
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $input = [
            "nama" => $request->nama,
            "nim" => $request->nim,
            "email" => $request->email,
            "jurusan" => $request->jurusan
        ];

        // Insert data ke database
        Student::create($input);

        // mengirim data json dan response codee 201
        return response()->json([
            "message" => "Add resource successful",
        ], 201);
    }
}
