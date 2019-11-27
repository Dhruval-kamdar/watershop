<?php
	include("js-css-head.php");
	include("../include/config.inc.php");
	$converter 		 = new encryption();
	$generalfunction = new generalfunction();
	if (isset($_POST["submit1"]) && $_POST["submit1"] != "")
    {
		if ($_POST["emailaddress"] != "" && $_POST["password"] != "")
        {
			$username = $_POST["emailaddress"];
			$password = $converter->encode($_POST["password"]);
			$dbfunction = new dbfunctions();
			$dbfunction->SelectQuery("tbl_admin", "*", $dbfunction->db_safe("AdminEmail='%1' and isActive='1' and isDeleted='0'", $username));
			$total = $dbfunction->getNumRows();
			if ($total > 0)
            {
				$objsel = $dbfunction->getFetchArray();
				 $AdminPassword = $objsel['AdminPassword'];
				if($password==$AdminPassword)
				{
					$_SESSION[SESSION_NAME . "userid"] = $objsel["AdminId"];
					$_SESSION[SESSION_NAME . "displayname"] = stripslashes($objsel["AdminName"]);
					$_SESSION[SESSION_NAME . "username"] = stripslashes($objsel["AdminEmail"]);
					$_SESSION[SESSION_NAME . "role"] = stripslashes($objsel["AdminRole"]);
					//$_SESSION[SESSION_NAME . "privilege"] = (json_decode($objsel["AdminPrivilege"]));
					if ($_POST["rememberme"] != "")
					{
						$expire = time() + (60 * 60 * 24 * 3000);
						$cookieid = md5(session_id() . time());
						setcookie("remember", $converter->encode($cookieid), $expire);
						$dbfunction->UpdateQuery("tbl_admin", array("CookieId" => $cookieid), $dbfunction->db_safe("AdminId='%1'", $objsel["AdminId"]));
					}
					$_SESSION['login_suc'] = "1";
					$generalfunction->redirect("dashboard.php");
				}
				else
				{
					$generalfunction->redirect("index.php?err=" . $converter->encode("2"));
				}
			}
			else
            {
				$generalfunction->redirect("index.php?err=" . $converter->encode("1"));
			}
		}
		else
        {
			$generalfunction->redirect("index.php?err=" . $converter->encode("1"));
		}
	}
	else
    {
		$generalfunction->redirect("index.php?err=" . $converter->encode("1"));
	}
?>