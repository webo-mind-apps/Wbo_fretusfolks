<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'home';

$route['adms-doc-import']   =   'Backend_team/adms_doc_import';
$route['adms-offer-letter-import']   =  'offer_letter/adms_offer_letter_import';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
