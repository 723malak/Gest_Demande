<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DmdConsultationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\ChefProjetMiddleware;
use App\Http\Controllers\articlesController;


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

$controller_path = 'App\Http\Controllers';

// Main Page Route
// Route::get('', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
Route::middleware([ChefProjetMiddleware::class])->group(function () {
    $controller_path = 'App\Http\Controllers';

    Route::get('/demandes/ajout', $controller_path . '\ArDGController@index')->name('demande-ajout');
    Route::get('/demandes/Acceuil', $controller_path . '\ArDGController@acceuil')->name('demandes-Acceuil');
    Route::get('/demandes/list', $controller_path . '\ArDGController@list')->name('demande-list');
    Route::get('/demandes/Archives', $controller_path . '\ArDGController@listArchive')->name('archive-demandes');
    Route::get('/demandes/plus/{id}', $controller_path . '\ArDGController@plus')->name('demande-plus');
    Route::get('/demandes/edit/{id}', $controller_path . '\DmdConsultationController@dataFormEdit')->name('demande-edit');
    Route::post('/Dupdate/{id}', [DmdConsultationController::class, 'updateDemande'])->name('demande-update');
    Route::get('/demandes/Articles/{parametre}', $controller_path . '\articlesController@index')->name('demande-articles');
    Route::resource('demande', DmdConsultationController::class) ;
    Route::resource('article', articlesController::class) ;
    Route::post('/demandeUpdate/update/{id}', '\App\Http\Controllers\ArDGController@updateDemande')->name('updateDemande');

});

// Route::get('/', [AnalyticsController::class, 'index'])->name('dashboard-analytics');
// Route::get('/demandes/ajout', [ArDGController::class, 'index'])->name('demande-ajout');
// Route::get('/demandes/list', [ArDGController::class, 'list'])->name('demande-list');
// Route::get('/demandes/plus/{id}', [ArDGController::class, 'plus'])->name('demande-plus');
// Route::get('/demandes/edit/{id}', [DmdConsultationController::class, 'dataFormEdit'])->name('demande-edit');
// Route::post('/Dupdate/{id}', [DmdConsultationController::class, 'updateDemande'])->name('demande-update');





// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('/login', 'Auth\LoginController@login');

// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', $controller_path . '\auth\LoginController@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

Route::get('/Connecter', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/Connecter/verification', [LoginController::class, 'credentials'])->name('auth-login-verify');


// cards
Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');


//conroller d'ajout





//controller de selection a partir de la base de donnéé

Route::get('/select', function () {
    $options = DB::table('projetbudgetaire')->pluck('Nom_Projet', 'id');
    return view('select', ['options' => $options]);
});


Route::get('/', function () {
    return redirect('/Connecter');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
