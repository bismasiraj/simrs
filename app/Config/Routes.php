<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Admin\Admin::index');
$routes->get('lang/{locale}', 'Language::index');

$routes->group("api/satusehat", ['filter' => 'satuSehatFilter'], function ($routes) {
    $routes->post("login", "SatuSehat::login");
    $routes->get("getToken", "SatuSehat::getToken");
    $routes->get("getPasienID", "SatuSehat::getPasienID");
    $routes->post("postEncounter", "SatuSehat::postEncounter");
    $routes->post("postBundleEncounter", "SatuSehat::postBundleEncounter");
    $routes->get("postingBatch", "SatuSehat::postingBatch");
});
$routes->group("api/antrianbpjs", ['filter' => 'login'], function ($routes) {
    $routes->post("tambahAntrean", "AntrianBpjs::tambahAntrean");
    $routes->post("updateWaktu", "AntrianBpjs::updateWaktu");
    $routes->post("updateStatusAntraenPV", "AntrianBpjs::updateStatusAntraenPV");
});
$routes->post("satusehat/loginInternal", "SatuSehat::loginInternal", ['filter' => 'login']);
$routes->post("satusehat/postOrganization", "SatuSehat::postOrganization", ['filter' => 'login']);
$routes->post("satusehat/postLocation", "SatuSehat::postLocation", ['filter' => 'login']);
$routes->post("api/satusehat/getPasienID", "SatuSehat::getPasienID", ['filter' => 'satuSehatFilter']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
