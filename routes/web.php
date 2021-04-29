<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsnafController;
use App\Http\Controllers\Kategori_ProgramController;
use App\Http\Controllers\ProposalController;
use App\Models\Proposal;
// use App\Models\Kategori_Pogram;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('home')->name('home');
// });

Route::get('/program', function () {
    return view('welcome');
});

// user 

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');


Route::get('/home',[HomeController::class,'index'])->name('home');
Auth::routes();

// proposal 
Route::get('/proposal', [ProposalController::class, 'index'])->name('proposal');
Route::get('/proposal/show', [ProposalController::class, 'show'])->name('proposal.show');
Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
Route::post('/proposal/store', [ProposalController::class, 'store'])->name('proposal.store');


// kategori program 
Route::get('/kategoriprogram', [Kategori_ProgramController::class, 'index'])->name('kategori_program');
Route::post('/kategoriprogram/store', [Kategori_ProgramController::class, 'store'])->name('kategori_program.store');
Route::get('/kategoriprogram/create', [Kategori_ProgramController::class, 'create'])->name('kategori_program.create');
Route::get('/kategoriprogram/destroy/{id}', [Kategori_ProgramController::class, 'destroy'])->name('kategori_program.destroy');
Route::get('/kategoriprogram/edit/{id}', [Kategori_ProgramController::class, 'edit'])->name('kategori_program.edit');
Route::post('/kategoriprogram/update/{id}', [Kategori_ProgramController::class, 'update'])->name('kategori_program.update');

//asnaf
Route::get('/asnaf', [AsnafController::class, 'index'])->name('asnaf');
Route::post('/asnaf/store', [AsnafController::class, 'store'])->name('asnaf.store');
Route::get('/asnaf/create', [AsnafController::class, 'create'])->name('asnaf.create');
Route::get('/asnaf/edit/{id}', [AsnafController::class, 'edit'])->name('asnaf.edit');
Route::post('/asnaf/update/{id}', [AsnafController::class, 'update'])->name('asnaf.update');
Route::get('/asnaf/destroy/{id}', [AsnafController::class, 'destroy'])->name('asnaf.destroy');



// Route::get('/user', [UserController::class, 'index'])->name('user');
// Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
// Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
// Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
// Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
// Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
// Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');


