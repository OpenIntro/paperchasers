<?php
/*
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=autocomplet', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM country WHERE country_name LIKE (:keyword) ORDER BY country_id ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['country_name']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['country_name']).'\')">'.$country_name.'</li>';
}

*/
 include "config.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 $qstring   = "SELECT *  FROM addserver";
//$result = mysql_query($qstring);//query the database for entries containing the term
$result = $conn->query($qstring);
//while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
 while ($row = $result->fetch_assoc())
{
		$row['serverid']=htmlentities(stripslashes($row['serverid']));
		$row['sname']=htmlentities(stripslashes($row['sname']));
		$row['cname']=htmlentities(stripslashes($row['cname']));
		$row['email']=htmlentities(stripslashes($row['email']));
		$row['pnumber']=htmlentities(stripslashes($row['pnumber']));
		//$row['customerid']=(int)$row['customerid'];
		$row_set[] = $row;//build an array
		//$country_name = str_replace($_POST['keyword'], '<b>'.$row['ID'].'</b>', $row['post_title']);
		 //echo '<li onclick="set_item(\''.str_replace("'", "\'", $row['post_title']).'\')">'.$country_name.'</li>';
}
//echo $row_set;
echo json_encode($row_set);

?>