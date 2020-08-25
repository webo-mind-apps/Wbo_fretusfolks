<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

$route['adms-offer-letter-import']   			=  'offer_letter/adms_offer_letter_import';
$route['adms-increment-letter-import']   		=  'increment_letter/adms_increment_letter_import';
$route['adms-termination-letter-import']   		=  'termination_letter/adms_termination_letter_import';

$route['adms-doc-import']   					=   'Backend_team/adms_doc_import';
$route['download-ffi-payslips']   				=   'ffi_payslips/download_ffi_payslips';
$route['fhrms-doc-import']  					=   'fhrms/fhrms_doc_import';
$route['fhrms-doc-format']  					=   'fhrms/doc_formate';
$route['fhrms']  								=   'fhrms/index';
$route['adms-inactive-import']   				=   'Bulk_update/adms_inactive_import';
$route['doc-formate']   						=   'Backend_team/doc_formate';
$route['doc-formate-inactive']   				=   'Bulk_update/doc_formate';

$route['pdf_offer_letter/(:any)'] 				= 'Offer_letter/pdf_offer_letter/$1';


$route['resend-otp'] 							= 'home/resend_otp';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;



