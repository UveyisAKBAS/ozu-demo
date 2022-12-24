<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(): array
    {
        $students = $this->students();

        $indexes = [];
        if (Storage::disk('local')->exists('indexes.txt')) {
            $indexes = json_decode(Storage::get('indexes.txt'));
        }

        if (count($indexes) === 0) {
            $selectedStudents = collect($students)->random(4);
        } else {
            $selectedStudents = collect($students)->only($indexes)->values();
        }

        return [
            "totalStudent" => count($students),
            "students" => $selectedStudents
        ];
    }

    public function students()
    {
        return json_decode(Storage::get('students.txt'));
    }
}
