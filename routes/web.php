<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsnafController;
use App\Http\Controllers\Kategori_ProgramController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Pengajuan_danaController;
use App\Http\Controllers\Rincian_pengajuanController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\EditProfile;


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
    return view('auth.login');
});

Route::get('/admin', function () {
    return view('proposal.detail.edit_ajuan');
});


// Route::get('/dashboard', function () {
//     return view('home')->name('home');
// });

Route::get('/program', function () {
    return view('welcome');
});

// user 
Route::group(['middleware'=>'auth'], function(){

Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');

// user 
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/show', [UserController::class, 'show'])->name('user.show');
Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/user/setting', [EditProfile::class, 'view'])->name('user.setting');
Route::get('/user/setting/edit', [EditProfile::class, 'edit'])->name('user.setting.edit');
Route::post('/user/setting/edit/update', [EditProfile::class, 'update'])->name('user.setting.update');
Route::get('/user/setting/changepassword', [ChangePassword::class, 'edit'])->name('user.password.edit');
Route::post('/user/setting/changepassword/update', [ChangePassword::class, 'update'])->name('user.password.update');


// proposal 
Route::get('/proposal', [ProposalController::class, 'index'])->name('proposal');
// Route::get('/proposal/show', [ProposalController::class, 'show'])->name('proposal.show');
Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposal.create');
Route::post('/proposal/store', [ProposalController::class, 'store'])->name('proposal.store');
Route::get('/proposal/edit/{id}', [ProposalController::class, 'edit'])->name('proposal.edit');
Route::post('/proposal/update/{id}', [ProposalController::class, 'update'])->name('proposal.update');
Route::get('/proposal/destroy/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
Route::get('/proposal/detail/{id}', [ProposalController::class, 'detail'])->name('proposal.detail');
Route::post('/proposal/changeStatus/{id}', [ProposalController::class, 'changeStatus'])->name('proposal.changeStatus');
Route::get('/proposal/report/{id}', [ProposalController::class, 'report'])->name('proposal.report');
Route::get('/proposal/read/{id}', [ProposalController::class, 'read'])->name('proposal.read');
Route::get('/dashboard', [ProposalController::class, 'dashboard'])->name('dashboard');


//pengajuan dana
Route::get('/proposal/pengajuandana/{id}', [Pengajuan_danaController::class, 'index'])->name('pengajuan_dana');
Route::get('/proposal/pengajuandana/create/{id}', [Pengajuan_danaController::class, 'create'])->name('pengajuan.create');
Route::post('/proposal/pengajuandan a/store', [Pengajuan_danaController::class, 'store'])->name('pengajuan.store');
Route::get('/proposal/pengajuan/edit/{id}', [Pengajuan_danaController::class, 'edit'])->name('pengajuan.edit');
Route::post('/proposal/pengajuan/update/{id}', [Pengajuan_danaController::class, 'update'])->name('pengajuan.update');


// Rincian pengajuan 
Route::get('/proposal/rincianAjuan/{id}', [Rincian_pengajuanController::class, 'index'])->name('rincian_pengajuan');
Route::get('/proposal/rincianAjuan/edit/{id}', [Rincian_pengajuanController::class, 'edit'])->name('rincian.edit');
Route::post('/proposal/rincianAjuan/update/{id}', [Rincian_pengajuanController::class, 'update'])->name('rincian.update');
Route::get('/proposal/rincianAjuan/create/{id}', [Rincian_pengajuanController::class, 'create'])->name('rincian.create');
Route::post('/proposal/rincianAjuan/store', [Rincian_pengajuanController::class, 'store'])->name('rincian.store');
Route::get('/proposal/rincianAjuan/destroy/{id}', [Rincian_pengajuanController::class, 'destroy'])->name('rincian.destroy');

// history 
Route::get('/proposal/history/{id}', [HistoryController::class, 'index'])->name('history');


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
});
Auth::routes();



