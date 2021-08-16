<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

if(!isset($_SESSION["IR"])){
	@$_SESSION["IR"] = F::Encrypt(F::UniqKey("IR"));
}
?>