<?php

use App\Models\{
    User,
    Preference,
    Course
};
use Illuminate\Support\Facades\Route;




Route::get('/one-to-many', function () {

    // $course = Course::create(['name'=> 'Curso Elo']);
    //    $course = Course::first();
    //    $data = [
    //     'name' => 'RELACIONAMENTO ONE-TO-MANY'
    //    ];
    //    $course->modules()->create($data);

    //     $modules = $course->modules;
    //     dd($modules);

    $course = Course::with('modules.lessons')->first();
    echo $course->name;
    echo "<br>";
    foreach ($course->modules as $module) {
        echo "Modulo {$module->name} <br>";

        foreach ($module->lessons as $lesson) {
            echo "Aula {$lesson->name} <br>";
        }
    }

    // $data = [
    //     'name' => 'RELACIONAMENTO ONE-TO-ONE'
    // ];
    $course->modules()->first();
    $modules = $course->modules;
    echo $module;
    dd($modules);
});





Route::get('/one-to-one', function () {
    // $user = User::first();
    $user = User::with('preference')->find(2);

    $data = [
        'background_color' => '#ccc',

    ];

    if ($user->preference) {
        $user->preference->update($data);
    } else {
        // $user->preference()->create($data);
        $preference = new Preference($data);
        $user->preference()->save($preference);
    }

    $user->refresh();
    var_dump($user->preference);

    $user->preference->delete();
    $user->refresh();
    dd($user->preference);
});


Route::get('/', function () {
    return view('welcome');
});
