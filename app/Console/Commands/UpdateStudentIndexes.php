<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateStudentIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'student:update-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates student indexes';

    
    public function handle()
    {
        $this->renewStudentIndexes();
    }

    private function renewStudentIndexes() {

        $previousIndexes = [];
        if (Storage::disk('local')->exists('indexes.txt')) {
            $previousIndexes = json_decode(Storage::get('indexes.txt'));
        }


        $newIndexes = $this->selectRandomIndexes(4, $previousIndexes);
        $this->saveSelectedIndexes($newIndexes);
    }

    private function selectRandomIndexes(int $num, array $previousIndexes): array
    {
        $students = json_decode(Storage::get('students.txt'));

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
}
