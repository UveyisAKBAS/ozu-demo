<?php

namespace App\Console\Commands;

use Faker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SeedStudents extends Command
{
    protected $signature = 'student:seed {population=30: Number of students to generate}';
    protected $description = 'Generates random students';

    public function handle()
    {
        $population = intval($this->argument('population'));
        $this->seedStudents($population);
    }

    public function seedStudents(int $population)
    {
        $faker = Faker\Factory::create();

        $students = [];

        foreach (range(1, $population) as $number) {

            $student = [
                "firstname" => $faker->firstName(),
                "lastname" => $faker->lastName(),
                "imageURL" => $faker->imageUrl(270, 200, 'student'),
                "paragraphs" => $faker->paragraphs(2)
            ];

            $students[] = $student;
        }

        Storage::disk('local')->put('students.txt', json_encode($students));

        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/naz.png
        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/taha_0.png
        // https://www.ozyegin.edu.tr/sites/default/files/upload/MuhendislikFakultesi/deniz.png
    }
}
