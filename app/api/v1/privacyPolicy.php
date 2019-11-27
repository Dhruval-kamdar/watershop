<?php
 require_once("include/config.php"); 
 $conn = mysql_connect(DBSERVER,DBUSERNAME,DBPASSWORD);
 mysql_select_db(DBNAME,$conn);
 //mysql_query("SET NAMES 'utf8'"); 
 $sql = mysql_query("SELECT * from `tbl_content` where `field_key` = 'terms' AND is_active='1' AND is_deleted ='0'")or die('opppsss');
 $row = mysql_fetch_assoc($sql);
?>
<html>
<body> <?php echo stripcslashes($row['field_value']);?> </body>
</html>