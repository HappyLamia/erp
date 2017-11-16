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
$route['default_controller'] = 'main/view';

$route['admin-page'] = 'main/view';

// Login - Logout
$route['admin-page/login'] = 'landing/login';
$route['admin-page/logout'] = 'landing/logout';

// Customer
$route['admin-page/customer/add'] = 'customer/add';
$route['admin-page/customer/update'] = 'customer/update';
$route['admin-page/customer/delete/(:any)'] = 'customer/delete/$1';
$route['admin-page/master/customer'] = 'main/view/customer';

// Sales
$route['admin-page/sales/add'] = 'salesman/add';
$route['admin-page/sales/update'] = 'salesman/update';
$route['admin-page/sales/delete/(:any)'] = 'salesman/delete/$1';
$route['admin-page/master/salesman'] = 'main/view/salesman';
	// Add Tracker
	$route['admin-page/master/salesman/add-tracker/(:any)'] = 'main/view/tracker/$1';
	$route['admin-page/master/tracker/add'] = 'tracker/add';

// Supplier
$route['admin-page/supplier/add'] = 'supplier/add';
$route['admin-page/supplier/update'] = 'supplier/update';
$route['admin-page/supplier/delete/(:any)'] = 'supplier/delete/$1';
$route['admin-page/master/supplier'] = 'main/view/supplier';

// Gudang
$route['admin-page/gudang/add'] = 'gudang/add';
$route['admin-page/gudang/update'] = 'gudang/update';
$route['admin-page/gudang/delete/(:any)'] = 'gudang/delete/$1';
$route['admin-page/master/gudang'] = 'main/view/gudang';
	// Penerimaan Barang
	$route['admin-page/gudang/penerimaan-barang'] = 'main/view/penerimaan';
	$route['admin-page/gudang/save-penerimaan'] = 'penerimaan/save';
	$route['admin-page/gudang/set-list'] = 'penerimaan/set_list';
	$route['admin-page/gudang/add-list'] = 'penerimaan/add_cart';
	$route['admin-page/gudang/remove-list/(:any)'] = 'penerimaan/remove_cart/$1';

// Satuan 
$route['admin-page/satuan/add'] = 'satuan/add';
$route['admin-page/satuan/update'] = 'satuan/update';
$route['admin-page/satuan/delete/(:any)'] = 'satuan/delete/$1';
$route['admin-page/master/satuan'] = 'main/view/satuan';

// Penjualan
	// Order
$route['admin-page/penjualan/order-barang'] = 'main/view/order_barang';
$route['admin-page/penjualan/add-order'] = 'main/view/add_order';
$route['admin-page/penjualan/add-to-cart'] = 'penjualan/add_cart';
$route['admin-page/penjualan/remove-cart'] = 'order/cancel_order';
$route['admin-page/penjualan/set-order'] = 'order/set_order';

	// Barang
$route['admin-page/penjualan/load-barang/(:any)'] = 'barang/dt_barang/$1';

	// Retur
$route['admin-page/penjualan/retur'] = 'main/view/retur';

	// Surat Jalan
$route['admin-page/penjualan/surat-jalan'] = 'main/view/surat_jalan';

// Pembelian
$route['admin-page/pembelian/permintaan'] = 'main/view/permintaan';
$route['admin-page/pembelian/add'] = 'main/view/pembelian';
$route['admin-page/pembelian/input-detail'] = 'main/view/pembelian/detail';

// Api
$route['admin-page/api/user'] = 'api/get_api_user';
$route['admin-page/api/salesman'] = 'api/get_api_salesman';
$route['admin-page/api/customer'] = 'api/get_api_customer';
$route['admin-page/api/barang'] = 'api/get_api_barang';
$route['admin-page/api/piutang'] = 'api/get_api_piutang';


$route['404_override'] = 'error/get_error';

$route['translate_uri_dashes'] = FALSE;
