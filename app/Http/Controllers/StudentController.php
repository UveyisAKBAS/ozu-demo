<?php

namespace App\Http\Controllers;

use Faker;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        return $this->students();
    }


    public function students()
    {
        return json_decode(Storage::get('students.txt'));
    }


    public function seedStudents(int $studentNumber = 30)
    {
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
