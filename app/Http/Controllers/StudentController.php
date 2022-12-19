<?php

namespace App\Http\Controllers;

use Faker;
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


    public function seedStudents(int $studentNumber = 30)
    {
        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/naz.png
        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/taha_0.png
        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/deniz.png

        $faker = Faker\Factory::create();

        $students = [];

        foreach (range(1, $studentNumber) as $number) {

            $student = [
                "firstname" => $faker->firstName(),
                "lastname" => $faker->lastName(),
                "imageURL" => $faker->imageUrl(270, 200, 'student'),
                "paragraphs" => $faker->paragraphs(2)
            ];

            $students[] = $student;
        }

        Storage::disk('local')->put('students.txt', json_encode($students));
    }
}
