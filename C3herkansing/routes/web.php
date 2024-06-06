<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToernooiCreateController;
use App\Http\Controllers\historyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InschrijfController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CreateTeams;
use App\Http\Controllers\AdminController;
use App\Models\Toernooi;
use App\Http\Controllers\GoalsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [InschrijfController::class, 'index'])->name('home');


//? toernooi


//? login
Route::get('/login', [LoginController::class, 'index'])->name('loginPage');


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);


Route::get('/registerPage', [RegisterController::class, 'index'])->middleware(['guest'])->name("registerPage");
Route::get('register', [RegisterController::class, 'create'])->name('register');           
Route::post('register', [RegisterController::class, 'store']);


Route::get('/oudetournoi', [historyController::class, 'index'])->name('oudetournoi');

Route::get('/onGoing', [ToernooiCreateController::class, 'onGoing'])->name("onGoing");


//? teams
Route::get('/allteams', [CreateTeams::class, 'allteams'])->name("allteams");

Route::get('/teamPlayers/{id}', [CreateTeams::class, 'teamPlayers'])->name("teamPlayers");


//? admin


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name("AdminPage");
    Route::get('/ToernooiAdmin', [AdminController::class, 'index2'])->name("ToernooiAdmin");
    Route::get('/toernooi', [ToernooiCreateController::class, 'index'])->name("Toernooi");
    Route::get('/create', [ToernooiCreateController::class, 'ToernooiCreate'])->name("create");
    Route::post('/submit', [ToernooiCreateController::class, 'ToernooiCreate'])->name("submit");
    Route::get('/change/{id}', [ToernooiCreateController::class, 'indexChange'])->name("change");
    Route::get('/start/{id}', [ToernooiCreateController::class, 'start'])->name("start");
    Route::get('/stop/{id}', [ToernooiCreateController::class, 'stop'])->name("stop");
    Route::get('/endMatch/{id}', [ToernooiCreateController::class, 'endMatch'])->name("endMatch");
    Route::get('/startMatch/{id}', [ToernooiCreateController::class, 'startMatch'])->name("startMatch");

    Route::put('/toernooi/update/{id}', [ToernooiCreateController::class, 'updateToernooi'])->name('update.toernooi');
    Route::patch('/users/{id}', [AdminController::class, 'updateUser'])->name('updateUser');


    Route::patch('/changeScore_B/{id}', [GoalsController::class, 'changeScore_B'])->name('changeScore_B');
    Route::patch('/changeScore_A/{id}', [GoalsController::class, 'changeScore_A'])->name('changeScore_A');

    Route::get('/teams', [CreateTeams::class, 'indexTeams'])->name('teams');
    Route::get('/teams/{team}/edit', [CreateTeams::class, 'edit'])->name('teams.edit');
    Route::delete('/teams/{team}', [CreateTeams::class, 'destroy'])->name('teams.destroy');
    Route::get('/onGoingAdmin', [AdminController::class, 'onGoingAdmin'])->name("onGoingAdmin");
});

Route::group(['middleware' => 'isTeamOwner'], function () {

    Route::get('/Register/{id}', [InschrijfController::class, 'Register'])->name("Register");
    Route::post('/submit/{id}', [InschrijfController::class, 'submit'])->name('submit');
});



Route::middleware(['web', 'auth'])
    ->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
        Route::get('/createTeam', [CreateTeams::class, 'index'])->name("createTeam");
        Route::get('/joinTeams', [CreateTeams::class, 'joinTeams'])->name("joinTeams");
        Route::post('/update.team/{id}',[CreateTeams::class, 'createTeam'] )->name('update.team');
        Route::get('/checkTeam', [CreateTeams::class, 'checkTeam'])->name('checkTeam');
        Route::post('/joinTeam/{id}', [CreateTeams::class, 'joinTeam'])->name('joinTeam');
        
    });


    //? finsit turneys 
    
    // Route::get('/oudetournoi', function () {
    //     return view('Oudetournoi');
    // })->name('oudetournoi');