<?php
require_once(__DIR__ . "/Misc/document_access.php");
require_once(__DIR__ . "/Misc/security_header.php");
require_once(__DIR__ . "/Misc/security_cookie.php");
require_once(__DIR__ . "/Misc/autoload.php");

session_start();

###################################################
###################DO NOT EDIT BELOW###############
###################################################
/*#*/ define("SYSTEM", __DIR__ . "/");	   		  #
/*#*/ define("MISC", __DIR__ . "/Misc/");	   	  #
/*#*/ define("CORE", __DIR__ . "/Core/");	   	  #
/*#*/ define("APPS", SYSTEM . "Apps/");	   		  #
/*#*/ define("DEF_NAME", "Developed with HPF");	  #
###################################################

define("ROUTE", Input::get("route"));

require_once(__DIR__ . "/setup.php");

#Web Application
require_once(__DIR__ . "/Apps/Apps.php");


