<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Http\Requests\Request;
use App\Inschijving;
use App\User;
use App\Workshop;
use Carbon\Carbon;

Route::get('/', function () {
    if(!User::where('name', '=' , 'admin')->exists()){
        User::create(['name' => 'admin', 'email' => 'bestuur@uvis.nl', 'password' => Hash::make(env('ADMIN_PASS'))]);
    }
    if(!Workshop::where('name', '=' , 'Pitchen en netwerken')->exists()){
        Workshop::create(['name' => 'Pitchen en netwerken', 'max' => 20]);
    }
    if(!Workshop::where('name', '=' , 'Solliciteren naar een stageplaats')->exists()){
        Workshop::create(['name' => 'Solliciteren naar een stageplaats', 'max' => 20]);
    }
    $all =  Workshop::all();

    $workshops = $all->filter(function ($item){
       return $item->max > count(Inschijving::where('name', '=', $item->name));
    })->pluck('name', 'id');
    return view('index', compact('workshops'));
});

Route::post('/inschrijven', 'PagesController@inschrijven')->name('inschrijven');

Route::get('/download', ['middleware' => 'auth.basic', function(){
    $inschrijvingen = Inschijving::all();
    Excel::create('Inschrijvingen'. Carbon::now(), function($excel) use($inschrijvingen){
        $excel->sheet('Sheet 1', function($sheet) use($inschrijvingen) {
            $sheet->fromArray($inschrijvingen);
        });
    })->download('xls');
}]);
