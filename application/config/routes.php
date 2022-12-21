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

/*-----------------------------------------------------------------------------+
 *|                                 Surveyer                                     |
 *-----------------------------------------------------------------------------+
 */
$route['tampil_survey']='surveyer/tampil_survey';
$route['survey']='surveyer/tambah_survey';
//-------------------------------- CRU------------------------------------------+
$route['logout']='surveyer/logout_survey';


/*------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------+
 *|                                 Operator                                   |
 *-----------------------------------------------------------------------------+
 */
$route['data_survey']='operator/tampil_survey';
$route['tampil_petugas']='operator/tampil_petugas';
$route['tambah']='operator/tambah_survey';
$route['prediksi_operator']='operator/tampil_hasil_prediksi';
$route['layak_operator']='operator/tampil_layak';
$route['cadangan_operator']='operator/tampil_tidak';
/*------------------------------------------------------------------------------*/



/*-----------------------------------------------------------------------------+
 *|                                 Administrator                              |
 *-----------------------------------------------------------------------------+
 */
//++++++++++++++++++++++++++++++++ Function Manajemen ++++++++++++++++++++++++++
$route['manajemen_akun']='admin/tampil_akun';
$route['tambah_akun']='admin/tambah_akun';
//------------------------------------------------------Akun
$route['manajemen_master']='admin/tampil_survey';
$route['tambah_master']='admin/tambah_survey';
//------------------------------------------------------Survey
$route['akses']='admin/tampil_akses';
//------------------------------------------------------Akses
$route['atribut']='admin/tampil_atribut';
//------------------------------------------------------Atribut


//++++++++++++++++++++++++++++++++ Function Mining +++++++++++++++++++++++++++++
$route['dtlatih']='admin/tampil_dtlatih';
$route['keputusan']='admin/tampil_keputusan';
$route['tree']='admin/detail_keputusan';
$route['dtuji']='admin/tampil_dtuji';
$route['akurasi']='admin/uji_akurasi';


//++++++++++++++++++++++++++++++++ Function MPrediksi ++++++++++++++++++++++++++
$route['proses_prediksi']='prediksi/klasifikasi';
$route['central']='admin/tampil_central';
$route['prediksi']='admin/tampil_prediksi';
$route['hasil_prediksi']='admin/tampil_hasil_prediksi';
$route['layak']='admin/tampil_layak';
$route['cadangan']='admin/tampil_cadangan';
//-------------------------------- cetak========================================
$route['print(:any)']='admin/cetak_prediksi/$1';
$route['print_layak_ok(:any)']='admin/cetak_layak/$1';
/*------------------------------------------------------------------------------*/


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
