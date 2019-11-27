<?php 
include("../include/config.inc.php");
include("session.php");
$conn = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME) ;
$generalFunction = new generalfunction();
$converter  = new encryption();
$dbfunction = new dbfunctions();
$requestData= $_REQUEST;
$columns = array( 
	0=>'queId' ,
	1 =>'que',
);
$sql = "SELECT c.queId FROM tbl_rating_questions c ";
$query=mysqli_query($conn, $sql) or die("rating_question_grid.php: get employees1");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 


$sql = "SELECT c.* FROM tbl_rating_questions c ";
if( !empty($requestData['search']['value']) ) {   
	$sql.=" AND ( queId LIKE '".$requestData['search']['value']."%' ";	
	$sql.=" OR que LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("rating_question_grid.php: get employees2");
$totalFiltered = mysqli_num_rows($query); 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$query=mysqli_query($conn, $sql) or die("rating_question_grid.php: get employees3");

$data = array();
$i=1+$requestData['start'];
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	
	if($row["keyVal"]=='que1')
	$row1=mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(que1Rating) AS avgRating FROM tbl_rate_services"));
	elseif($row["keyVal"]=='que2')
	$row1=mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(que2Rating) AS avgRating FROM tbl_rate_services"));
	elseif($row["keyVal"]=='que3')
	$row1=mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(que3Rating) AS avgRating FROM tbl_rate_services"));
	elseif($row["keyVal"]=='que4')
	$row1=mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(que4Rating) AS avgRating FROM tbl_rate_services"));
	elseif($row["keyVal"]=='que5')
	$row1=mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(que5Rating) AS avgRating FROM tbl_rate_services"));
	$encodedId = $converter->encode($row["queId"]);
	$editurl = "edit_rating_question.php" . $urltoadd . ($urltoadd != "" ? "&queId=" . $encodedId : "?queId=" . $encodedId);
	$currStatus = ($row['isActive']=="1")?"نشط":"غير نشط";
	$nestedData=array(); 
	$nestedData[] = '<span style="margin-left:10px">'.$row["queId"].'</span>';
	$nestedData[] = '<span style="margin-left:00px">'.$row["que"].'</span>';
	$nestedData[] = '<span style="margin-left:20px">'.round($row1["avgRating"],2).'</span>';
	$nestedData[] = '<span style="margin-left:10px"><a href="'.$editurl.'" title="تصحيح" ><button class="btn btn-xs btn-success">تعديل</button></a><span>';	
	$data[] = $nestedData;
	$i++;
}
$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ),
			"data"            => $data  
			);

echo json_encode($json_data);  // send data as json format

?>
