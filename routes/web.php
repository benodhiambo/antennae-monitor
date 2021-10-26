<?php

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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dash', 'DashboardController@showMainDashboard')->name('dash');

    Route::get('/', 'DashboardController@showMainDashboard')->name('dash');

    /*
    |--------------------------------------------------------------------------
    | SITES AND CELLS ROUTES
    |--------------------------------------------------------------------------
    */
    Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');
    Route::get('/upload_sitelist', 'SiteController@showUploadSitelist');
    Route::get('/sites', 'SiteController@showSitelist')->name('sitelist');
    Route::get('/site/{site_id}', 'SiteController@showSite')->name('site');
    Route::get('/cells', 'SiteController@showCellsList')->name('celllist');
    Route::get('/cell/{cell_id}', 'SiteController@showCellDetails')->name('cell');
    Route::get('/site_reports', 'SiteController@showSiteReports')->name('site_reports');
    Route::get('/{report_id}/edit_report_status', 'SiteController@editReportStatus')->name('reports_status');
    Route::post('/{report_id}/update_report_status', 'SiteController@updateInstallationReportStatus');
    Route::get('/summary', 'SummaryController@showSummaryPage');
    Route::get('/detailed', 'SiteController@showDetailedPage');
    Route::get('/site_reports/{installation_report_id}/upload_acceptance_form/', 'SiteController@showUploadAcceptanceFormPage')->name('show-acceptance-form');
    Route::post('/upload_acceptance_form/', 'AcceptanceReportController@saveAcceptanceReport')->name('upload-acceptance-form');
    Route::post('/{acceptance_form_id}/update_acceptance_details', 'AcceptanceReportController@updateAcceptanceDetails');

    /*
    |--------------------------------------------------------------------------
    | ALERTS ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/alerts', 'AlertController@showFullAlertslist')->name('alertlist');
    Route::get('/alerts/types', 'AlertController@showAlertsByTypes')->name('alerts_types');
    Route::get('/alerts/status', 'AlertController@showAlertsByStatus')->name('alerts_status');
    Route::post('/alerts/updateStatus', 'AlertController@updateAlertStatus')->name('alerts_status');
    Route::get('/alerts/{cell_id}/alerts', 'AlertController@showCellAlertslist')->name('cell_alerts');
    Route::get('/alerts/{alert_id}/update_status', 'AlertController@showAlertStatusUpdate')->name('update_alert_status');
    Route::post('/alerts/{alert_id}/update_status', 'AlertController@updateStatus');
    Route::get('/monitors', 'AlertController@showMonitorInstallations');

    /*
    |--------------------------------------------------------------------------
    | AUTHENTICATION ROUTES
    |--------------------------------------------------------------------------
    */
//USERS
    Route::get('/users', 'Auth\RegisterController@showUserlist')->name('userlist');
    Route::get('/users/add', 'Auth\RegisterController@showAddUserForm');
    Route::get('/{user_id}/user_profile', 'UpdateUserController@showUserProfile');
    Route::get('/{user_id}/profile', 'UpdateUserController@showUserProfile');
    Route::post('users/{user_id}/update', 'UpdateUserController@updateUserDetails');
    Route::get('users/{user_id}/changePassword', 'UpdateUserController@showChangePasswordPage');
    Route::post('users/{user_id}/changePassword', 'UpdateUserController@processPasswordChange');

//ROLES
    Route::get('/roles', 'RoleController@showRolesList');
    Route::get('/add_role', 'RoleController@showAddRoleForm');
    Route::get('/{role_id}/edit_role', 'RoleController@showRoleUpdateForm');
    Route::post('/{role_id}/edit_role', 'RoleController@updateRole');
    Route::post('/addRole', 'RoleController@addRole');

//CONTRACTORS
    Route::get('/contractors', 'ContractorController@showContractorsList');
    Route::get('/contractors/add', 'ContractorController@showAddContractorForm')->name('add_contractor');
    Route::post('/contractors/add', 'ContractorController@addContractor');
    Route::get('contractors/{con_id}/edit', 'ContractorController@showConUpdateForm');
    Route::post('contractors/{con_id}/edit', 'ContractorController@updateContractor');


//TEAMS
    Route::get('/teams', 'TeamController@showTeamList');
    Route::get('teams/add', 'TeamController@showAddTeamForm');
    Route::post('teams/add', 'TeamController@addTeam');
    Route::get('teams/{team_id}', 'TeamController@showTeamUpdateForm');
    Route::post('teams/{team_id}/edit', 'TeamController@updateTeam');

    Route::get('/pdf', 'API\TestApp\TestReportController@generatePdf')->name('pdf');

//logs
    Route::get('/logs/access', 'LogsController@accessLogs');
    Route::get('/logs/create', 'LogsController@createLogs');
    Route::get('/logs/update', 'LogsController@updateLogs');
});