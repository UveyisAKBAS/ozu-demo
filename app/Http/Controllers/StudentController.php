<?php

namespace App\Http\Controllers;

use Faker;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(): array
    {
        $students = $this->students();

        $previousIndexes = [];
        if (Storage::disk('local')->exists('indexes.txt')) {
            $previousIndexes = $this->getPreviousIndexes();
        }

        $selectedIndexes = $this->selectRandomIndexes($students, $previousIndexes);

        $this->saveSelectedIndexes($selectedIndexes);


        return [
            "totalStudent" => count($students),
            "students" => collect($students)->only($selectedIndexes)->values()
        ];
    }


    private function selectRandomIndexes(array $students, array $previousIndexes): array
    {
        $num = 4;

        $indexes = collect(range(0, count($students) - 1))->except($previousIndexes);

        if ($indexes->count() < $num) {
            $num = $indexes->count();
        }

        return $indexes->shuffle()->slice(0, $num)->toArray();
    }

    private function saveSelectedIndexes(array $indexes)
    {
        Storage::disk('local')->put('indexes.txt', json_encode($indexes));
    }

    private function getPreviousIndexes()
    {
        return json_decode(Storage::get('indexes.txt'));
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
