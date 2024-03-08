<?php

// use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ActiviteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FactiviteController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\RactiviteController;
use App\Http\Controllers\RecuperationController;
use App\Http\Controllers\RetardrapportController;
use App\Http\Controllers\RmissionController;
use App\Http\Controllers\StatistiquelisteController;
use App\Http\Controllers\ValidController;
use App\Http\Controllers\ContactController;
use App\Models\RetardRapport;
use Illuminate\Support\Facades\Auth;


// racine du projet qui m'affiche le login
Route::get('/', function () {
    return view('auth.login');
});
//email configuration
Route::view('/contact','contactForm')->name('contactForm');

Route::get('/test', function () {
    return view('ractivites.test');
});
// fin racine du projet qui m'affiche le login

Route::get('/menu', function () {
    return view('menu');
});

//debut route pour la modification du mot de passe
Route::get('/change-mdp',[UserController::class, 'formulaireMdp'])->name('modifierMdp');
Route::post('/changepassword',[UserController::class, 'updatePassword']);
//fin route pour la modification du mot de passe


Auth::routes();

// route pour le tableau de bord
Route::get('/home', [HomeController::class, 'index'])->name('dashboards.accueil');


// fin route pour le tableau de bord

Route::group(['middleware' => ['auth']], function () {

    Route::get('/validation1', [ValidController::class, 'valid1'])->name('validations.validation1');
    Route::post('/validation1/{id}', [ValidController::class, 'valider1'])->name('validations.validation1');
    Route::post('/rejet1/{id}', [ValidController::class, 'rejeter1'])->name('validations.validation1');

    Route::get('/validation2', [ValidController::class, 'valid2'])->name('validations.validation2');
    Route::post('/validation2/{id}', [ValidController::class, 'valider2'])->name('validations.validation2');
    Route::post('/rejet2/{id}', [ValidController::class, 'rejeter2'])->name('validations.validation2');

    Route::get('/validation3', [ValidController::class, 'valid3'])->name('validations.validation3');
    Route::post('/validation3/{id}', [ValidController::class, 'valider3'])->name('validations.validation3');
    Route::post('/rejet3/{id}', [ValidController::class, 'rejeter3'])->name('validations.validation3');

    Route::get('/validationmission1', [ValidController::class, 'validmission1'])->name('validations.validationmission1');
    Route::post('/validationmission1/{id}', [ValidController::class, 'validermission1'])->name('validations.validationmission1');
    Route::post('/rejetmission1/{id}', [ValidController::class, 'rejetermission1'])->name('validations.validationmission1');


    Route::get('/validationmission2', [ValidController::class, 'validmission2'])->name('validations.validationmission2');
    Route::post('/validationmission2/{id}', [ValidController::class, 'validermission2'])->name('validations.validationmission2');
    Route::post('/rejetmission2/{id}', [ValidController::class, 'rejetermission2'])->name('validations.validationmission2');

    Route::get('/validationmission3', [ValidController::class, 'validmission3'])->name('validations.validationmission3');
    Route::post('/validationmission3/{id}', [ValidController::class, 'validermission3'])->name('validations.validationmission3');
    Route::post('/rejetmission3/{id}', [ValidController::class, 'rejetermission3'])->name('validations.validationmission3');


    Route::get('/validationractivite1', [ValidController::class, 'validractivite1'])->name('validations.validationractivite1');
    Route::post('/validationractivite1/{id}', [ValidController::class, 'validerractivite1'])->name('validations.validationractivite1');
    Route::post('/rejetractivite1/{id}', [ValidController::class, 'rejeterractivite1'])->name('validations.validationractivite1');


    Route::get('/validationractivite2', [ValidController::class, 'validractivite2'])->name('validations.validationractivite2');
    Route::post('/validationractivite2/{id}', [ValidController::class, 'validerractivite2'])->name('validations.validationractivite2');
    Route::post('/rejetractivite2/{id}', [ValidController::class, 'rejeterractivite2'])->name('validations.validationractivite2');

    Route::get('/validationractivite3', [ValidController::class, 'validractivite3'])->name('validations.validationractivite3');
    Route::post('/validationractivite3/{id}', [ValidController::class, 'validerractivite3'])->name('validations.validationractivite3');
    Route::post('/rejetractivite3/{id}', [ValidController::class, 'rejeterractivite3'])->name('validations.validationractivite3');


    Route::get('/validationrmission1', [ValidController::class, 'validrmission1'])->name('validations.validationrmission1');
    Route::post('/validationrmission1/{id}', [ValidController::class, 'validerrmission1'])->name('validations.validationrmission1');
    Route::post('/rejetrmission1/{id}', [ValidController::class, 'rejeterrmission1'])->name('validations.validationrmission1');

    Route::get('/validationrmission2', [ValidController::class, 'validrmission2'])->name('validations.validationrmission2');
    Route::post('/validationrmission2/{id}', [ValidController::class, 'validerrmission2'])->name('validations.validationrmission2');
    Route::post('/rejetrmission2/{id}', [ValidController::class, 'rejeterrmission2'])->name('validations.validationrmission2');

    Route::get('/validationrmission3', [ValidController::class, 'validrmission3'])->name('validations.validationrmission3');
    Route::post('/validationrmission3/{id}', [ValidController::class, 'validerrmission3'])->name('validations.validationrmission3');
    Route::post('/rejetrmission3/{id}', [ValidController::class, 'rejeterrmission3'])->name('validations.validationrmission3');

    //filtrage dees activites par projet
    Route::get('/filtreactivite/{codeprojet}', [FactiviteController::class, 'filtreactivite'])->name('filtre.filtreactivite');
    //filtrage des missions par projet
    Route::get('/filtremission/{codeprojet}', [FactiviteController::class, 'filtremission'])->name('filtre.filtremission');

// liste des activite en retard
    Route::get('/retard_rapport_actvite', [RetardrapportController::class, 'index'])->name('Listeretard.retardactivite');
    Route::get('/retard_rapport_mission', [RetardrapportController::class, 'index2'])->name('Listeretard.retardmission');
    //liste des statistiques
    Route::get('/activiteliste', [StatistiquelisteController ::class, 'activiteliste'])->name('statistiqueliste.activiteliste');
    Route::get('/missionlistecours', [StatistiquelisteController ::class, 'missionlistecours'])->name('statistiqueliste.missionlistecours');
     Route::get('/activiteexecuterliste', [StatistiquelisteController ::class, 'activiteexecuterliste'])->name('statistiqueliste.activiteexecuterliste');
     Route::get('/missionexecuterliste', [StatistiquelisteController ::class, 'missionexecuterliste'])->name('statistiqueliste.missionexecuterliste');







//filtre des information à partir du code d'activite

    Route::get('/getNomEmploye/{codeActivite}', [RecuperationController::class, 'getNomEmploye'])->name('getNomEmploye');
    //filtre des information à partir du code d'activite
    Route::get('/getNomEmployes/{codeMission}', [RecuperationController::class, 'getNomEmployes'])->name('getNomEmployes');


//                /la vue/  et le controler
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('dashboards', dashboardController::class);
    Route::resource('employes', EmployeController::class);
    Route::resource('projets', ProjetController::class);
    Route::resource('materiels', MaterielController::class);
    Route::resource('activites', ActiviteController::class);
    Route::resource('missions', MissionController::class);
    Route::resource('ractivites', RactiviteController::class);
    Route::resource('rmissions', RmissionController::class);

    
   
});
