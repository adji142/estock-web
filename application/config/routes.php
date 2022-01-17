<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// API TEST
$route['APITestNumber'] = 'API/API_Test/testNumber';
$route['APITest'] = 'API/API_Test/testGlobal';
// API TEST

// API TOKEN
$route['APISetToken'] = 'API/API_Token/SetToken';
$route['APIGetToken'] = 'API/API_Token/GetTokenAuth';
$route['APIAUTHToken'] = 'API/API_auth/UpdateToken';
// API TOKEN

// API DEMOGRAFI
$route['APIProvinsi'] = 'API/API_Demografi/ReadProfinsi';
$route['APIKota'] = 'API/API_Demografi/ReadKota';
$route['APIKec'] = 'API/API_Demografi/ReadKecamatan';
$route['APIKel'] = 'API/API_Demografi/ReadKelurahan';
$route['APIAddVer'] = 'API/API_Demografi/VerificationAddress';
// API DEMOGRAFI

// API CUSTOMER
$route['APINewCust'] = 'API/API_Customer/NewCustomerFromApps';
$route['APIReadCust'] = 'API/API_Customer/ReadCustomer';
// API CUSTOMER

// API AUTH
$route['APIAUTHEmail'] = 'API/API_auth/FindEmail';
$route['APIAUTHPhone'] = 'API/API_auth/FindPhone';
// API AUTH

// API Promo
$route['APIPromoGet'] = 'API/API_Promo/getPromo';
// API Promo

// API Kategori
$route['APIGetKategori'] = 'API/API_Kategori/GetKategori';
// API Kategori

// API Item
$route['APIGetItemData'] = 'API/API_ItemMasterData/getItem';
// API Item

// API transaksi
$route['APITrxChart'] = 'API/API_Chart/AddChart';
$route['APIEditChart'] = 'API/API_Chart/EditCart';
$route['APIEditUserChart'] = 'API/API_Chart/EditUserChart';
$route['APITrxGetChart'] = 'API/API_Chart/getChart';
$route['APITrxGetSumChart'] = 'API/API_Chart/getUserSumChart';
// API transaksi

$route['permissionread'] = 'Auth/C_Permission/permission';

$route['permission'] = 'Home/permission';
$route['role'] = 'Home/role';
$route['permissionrole/(:num)'] = 'Home/permissionrole/$1';
$route['user'] = 'Home/user';

// Master Data
$route['kategori'] = 'Home/mstr_kategori';
$route['satuan'] = 'Home/mstr_satuan';
$route['item'] = 'Home/mstr_itemdata';
$route['termin'] = 'Home/mstr_termin';
$route['banner'] = 'Home/mstr_promo';
$route['customer'] = 'Home/mstr_customerdata';
// Master Data