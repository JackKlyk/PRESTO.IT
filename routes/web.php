<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AdminController;
use Laravel\Socialite\Facades\Socialite;

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


//Rotte generali
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/macrocategoria/{macro}', [PublicController::class, 'macro'])->name('macro');
Route::post('/annunci/cerca', [PublicController::class, 'search'])->name('search');


//Rotte annunci
Route::get('/lista-annunci', [AnnouncementController::class, 'index'])->name('announcements.index');
Route::get('/annunci/crea', [AnnouncementController::class, 'create'])->middleware('auth')->name('announcements.create');
Route::get('/annunci/{announcement}/modifica', [AnnouncementController::class, 'edit'])->middleware('auth')->name('announcements.edit');
Route::get('/annunci/{announcement}/dettagli', [AnnouncementController::class, 'show'])->name('announcements.show');
Route::delete('annunci/{announcement}', [AnnouncementController::class, 'destroy'])->middleware('auth')->name('announcements.destroy');

Route::patch('/like/annuncio/{announcement}', [AnnouncementController::class, 'likeAnnouncement'])->middleware('auth')->name('announcements.like');
Route::patch('/dislike/annuncio/{announcement}', [AnnouncementController::class, 'dislikeAnnouncement'])->middleware('auth')->name('announcements.dislike');

// Rotte categorie
Route::get('/categorie/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('/elimina-categoria/{category}', [CategoryController::class, 'destroy'])->middleware('isAdmin')->name('categories.destroy');
Route::get('/aggiungi/categoria', [CategoryController::class, 'add'])->middleware('isAdmin')->name('categories.add');
Route::get('/modifica/{category}/categoria', [CategoryController::class, 'edit'])->middleware('isAdmin')->name('categories.edit');

//Rotte profilo
Route::get('/profilo/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/profilo/{user}/modifica', [UserController::class, 'edit'])->name('users.edit');
Route::put('/profilo/{user}/update', [UserController::class, 'update'])->name('users.update');

//Rotte profilo revisore
Route::get('/revisore/annunci', [RevisorController::class, 'index'])->middleware('auth', 'isRevisor')->name('revisor.index');
Route::patch('/accetta/annuncio/{announcement}', [RevisorController::class, 'acceptAnnouncement'])->middleware('isRevisor')->name('revisor.accept_announcement');
Route::patch('/rifiuta/annuncio/{announcement}', [RevisorController::class, 'rejectAnnouncement'])->middleware('isRevisor')->name('revisor.reject_announcement');
Route::post('/revisore/anunncio-undo/{announcement}', [RevisorController::class, 'undoAnnouncement'])->middleware('isRevisor')->name('revisor.undo_announcement');

//Rotte richiesta diventare revisore
Route::patch('/richiesta/revisore', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('/richiesta/revisore/{user}', [RevisorController::class, 'makeRevisor'])->middleware('auth', 'isAdmin')->name('make.revisor');
Route::get('/licenzia/revisore/{user}', [RevisorController::class, 'dismissRevisor'])->middleware('auth', 'isAdmin')->name('dismiss.revisor');

// Rotta admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth', 'isAdmin')->name('admin.dashboard');
Route::patch('/admin/dashboard/visibile/{announcement}', [AdminController::class, 'beVisible'])->middleware('auth', 'isAdmin')->name('admin.visible');
Route::patch('/admin/dashboard/nascondi/{announcement}', [AdminController::class, 'beHidden'])->middleware('auth', 'isAdmin')->name('admin.hidden');

//Rotta per ricerca annunci
Route::get('/ricerca/annuncio', [PublicController::class, 'searchAnnouncements'])->name('announcements.search');


//Rotte accedi con Google, GitHub e Facebook
// GOOGLE
Route::get('/auth/{social}/redirect', [PublicController::class, 'socialLoginRedirect'])->name('socialite.login.google');
 
Route::get('/login/google/callback', [PublicController::class, 'socialCallbackGoogle']);


// GITHUB
Route::get('/auth/{social}/redirect2', [PublicController::class, 'socialLoginRedirect'])->name('socialite.login.github');
 
Route::get('/login/github/callback', [PublicController::class, 'socialCallbackGithub']);

// FACEBOOK - WORK IN PROGRESS
// Route::get('/auth/facebook/redirect', function () {return Socialite::driver('facebook')->redirect();})->name('socialite.login.facebook');
 
// Route::get('/login/facebook/callback', function () {
//     $facebookUser = Socialite::driver('facebook')->user();
 
//       $user = User::updateOrCreate(
//         [
//         'name' => $facebookUser->name,
//         'email' => $facebookUser->email,
//         'gender' => 'Non binario',
//         'phone' => ' ' ,
//         'password' => bcrypt(''),
//         ]
// );
 
//     Auth::login($user);
 
//     return redirect('/');
// });


//Rotta cambio lingua
Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('set_language_locale');

