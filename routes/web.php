<?php

use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\FirmController;
use App\Http\Controllers\Admin\DeveloperController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Contacts\ContactsController;
use App\Http\Controllers\Contacts\ContactsDashboardController;


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


Route::get('/contact/login', [ContactsController::class, 'showLoginForm'])->name('contact.login.form');
Route::post('/contact/login', [ContactsController::class, 'login'])->name('contact.login');

// Example admin dashboard route
Route::middleware(['web', 'auth:contacts'])->group(function () {
    Route::get('/contact/dashboard', [ContactsDashboardController::class, 'index'])->name('contact.dashboard');

    Route::get('/contact/settings', [ContactsDashboardController::class, 'edit'])->name('contact.settings');
    Route::any('/contact/save_settings', [ContactsDashboardController::class, 'save_settings'])->name('contact.save_settings');


    Route::get('/contact/logout', [ContactsDashboardController::class, 'logout'])->name('contact.logout');
});




Route::get('/link', function () {        
// $target = '/home/u496696594/domains/happystarhomes.com/hsh/storage/app/public';
// $shortcut = '/home/u496696594/domains/happystarhomes.com/public_html/storage';
  $target = '/home/tnscapsv/public_html/tns/storage/app/public';
  $shortcut = '/home/tnscapsv/public_html/tns/storage';
   symlink($target, $shortcut);
});

Route::get('/linkstorage', function () {
    $targetFolder = base_path().'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    echo $targetFolder;
 });



Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    return 'Cache cleared';
});



Route::group(['namespace' => 'Admin'], function () {
    Route::get('/',  'LoginController@adminLogin')->name('login');
    Route::get('login', 'LoginController@adminLogin')->name('login');
    Route::post('get-login', 'LoginController@adminGetLogin')->name('postLogin');
});

Route::group(['namespace' => "Admin"], function () {

    Route::group(['middleware' => 'auth'], function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard', 'index')->name('dashboard');
        });

        Route::controller(LoginController::class)->group(function () {
            
            
            Route::get('password/change', 'showChangeForm')->name('password.change');
            Route::post('password/change', 'change')->name('password.update');
            Route::get('logout', 'logout')->name('logout');
        });

        Route::controller(ProfileController::class)->group(function () {
            Route::get('profile', 'index')->name('profile.index');
        });

        Route::controller(CompanyController::class)->group(function () {
            Route::get('company-list', 'index')->name('company.list');
            Route::get('view-company/{id}', 'view')->name('company.view');
        });

        // Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        //     Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        //     Route::get('/contacts/getContacts', [ContactController::class, 'getContacts'])->name('admin.contacts.getContacts'); // This is the missing route
        //     Route::get('/contacts/create', [ContactController::class, 'create'])->name('admin.contacts.create');
        //     Route::post('/contacts', [ContactController::class, 'store'])->name('admin.contacts.store');
        //     Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('admin.contacts.show');
        //     Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('admin.contacts.edit');
        //     Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('admin.contacts.update');
        //     Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
        // });


        Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
            Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
            Route::get('/contacts/getContacts', [ContactController::class, 'getContacts'])->name('admin.contacts.getContacts'); // This is the missing route
            Route::get('/contacts/create', [ContactController::class, 'create'])->name('admin.contacts.create');
            Route::post('/contacts', [ContactController::class, 'store'])->name('admin.contacts.store');
            Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('admin.contacts.show');
            Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('admin.contacts.edit');
            Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('admin.contacts.update');
            Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');
            Route::put('/contacts/{contact}/toggle-status', [ContactController::class, 'toggleStatus'])->name('admin.contacts.toggleStatus');
        });
        
    });
});