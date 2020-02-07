<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

$route['adms-offer-letter-import']   =  'offer_letter/adms_offer_letter_import';
$route['adms-increment-letter-import']   =  'increment_letter/adms_increment_letter_import';
$route['adms-termination-letter-import']   =  'termination_letter/adms_termination_letter_import';

$route['adms-doc-import']   =   'Backend_team/adms_doc_import';
$route['doc-formate']   =   'Backend_team/doc_formate';

$route['pdf_offer_letter/(:any)'] = 'Offer_letter/pdf_offer_letter/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
