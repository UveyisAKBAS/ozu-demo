<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker;

class SeedStudents extends Command
{
    protected $signature = 'student:seed {studentNumber=30: Number of students to generate}';
    protected $description = 'Generates random students';

    public function handle()
    {
        $studentNumber = intval($this->argument('studentNumber'));
        $this->seedStudents($studentNumber);
    }

    public function seedStudents(int $studentNumber)
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
