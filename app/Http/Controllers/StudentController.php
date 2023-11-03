<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    public function index()
    {
        // mendapatkan semua data students
        $students = Student::all();

        // jika data kosong maka kirim status code 204
        if ($students->isEmpty()) {
            $data = [
                "message" => "Resource is empty"
            ];

            return response()->json($data, 204);
        }

        $data = [
            "message" => "Get all resources",
            "data" => $students
        ];

        // kirim data(json) dan response code
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $student = Student::find($id);

        // jika data yang dicari tidak ada, kirim kode 404
        if (!$student) {
            $data = [
                "message" => "Data not found"
            ];

            return response()->json($data, 404);
        }

        $data = [
            "message" => "Show detail resource",
            "data" => $student
        ];

        // mengembalikan data dan status code 200
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        // validasi data request
        $request->validate([
            "nama" => "required",
            "nim" => "required",
            "email" => "required|email",
            "jurusan" => "required"
        ]);

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

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        // jika data yang dicari tidak ada, kirim kode 404
        if (!$student) {
            $data = [
                "message" => "Data not found"
            ];

            return response()->json($data, 404);
        }

        $student->update([
            'nama' => $request->nama ?? $student->nama,
            'nim' => $request->nim ?? $student->nim,
            'email' => $request->email ?? $student->email,
            'jurusan' => $request->jurusan ?? $student->jurusan
        ]);
        $data = [
            'message' => 'Data is updated',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function destory($id)
    {
        $student = Student::find($id);

        // jika data yang dicari tidak ada, kirim kode 404
        if (!$student) {
            $data = [
                "message" => "Data not found"
            ];

            return response()->json($data, 404);
        }

        $student->delete();
        $hasil = [
            "message" => "Student id $id has been deleted",
            "data" => $this->index()
        ];
        return $hasil;
    }
}
