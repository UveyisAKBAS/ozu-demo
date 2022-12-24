<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect("/", "/demo/tr");
Route::redirect("/demo", "demo/tr");

Route::get('/demo/{lang?}', function ($lang = "tr") {

    if ($lang !== "tr") {
        $lang = "en";
    }

    $students = json_decode(Storage::get('students.txt'));

    $indexes = [];
    if (Storage::disk('local')->exists('indexes.txt')) {
        $indexes = json_decode(Storage::get('indexes.txt'));
    }

    if (count($indexes) === 0) {
        $selectedStudents = collect($students)->random(4);
    } else {
        $selectedStudents = collect($students)->only($indexes)->values();
    }


    return view('app',
        [
            "lang" => $lang,
            "students" => $selectedStudents,
            "totalStudentNumber" => count($students),
        ]);
});
