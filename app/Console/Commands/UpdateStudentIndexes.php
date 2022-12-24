<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateStudentIndexes extends Command
{
    protected $signature = 'student:update-indexes {studentNumber=4}';
    protected $description = 'Updates student indexes';


    public function handle()
    {
        $studentNumber = intval($this->argument('studentNumber'));
        $this->renewStudentIndexes($studentNumber);
    }

    private function renewStudentIndexes(int $studentNumber)
    {
        $previousIndexes = $this->getPreviousIndexes();
        $newIndexes = $this->selectRandomIndexes($studentNumber, $previousIndexes);
        $this->saveSelectedIndexes($newIndexes);
    }

    private function getPreviousIndexes()
    {
        $previousIndexes = [];
        if (Storage::disk('local')->exists('indexes.txt')) {
            $previousIndexes = json_decode(Storage::get('indexes.txt'));
        }

        return $previousIndexes;
    }

    private function selectRandomIndexes(int $studentNumber, array $previousIndexes): array
    {
        $students = json_decode(Storage::get('students.txt'));

        $indexes = collect(range(0, count($students) - 1))->except($previousIndexes);

        if ($indexes->count() < $studentNumber) {
            $studentNumber = $indexes->count();
        }

        return $indexes->shuffle()->slice(0, $studentNumber)->toArray();
    }

    private function saveSelectedIndexes(array $indexes)
    {
        Storage::disk('local')->put('indexes.txt', json_encode($indexes));
    }
}
