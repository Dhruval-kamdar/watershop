<?php
	include("../include/config.inc.php");
	$generalfunction = new generalfunction();
	unset($_SESSION[SESSION_NAME."userid"]);
	unset($_SESSION[SESSION_NAME."displayname"]);
	unset($_SESSION[SESSION_NAME."username"]);
	
	if(isset($_COOKIE["remember"]))
	{
		setcookie("remember", "", time()-3600);
		$dbfunction = new dbfunctions();
		$dbfunction->UpdateQuery("tbl_admin",array("CookieId"=>""),$dbfunction->db_safe("AdminId='%1'",$objsel["id"]));
	}
	$generalfunction->redirect("index.php");
?>