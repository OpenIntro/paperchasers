

<?php
include "config.php";
//$conn=mysqli_connect("localhost","root",'',"jquellco_paper");
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql="INSERT INTO joblog "."(luserid,lcomment,ltime,ljid,chkimg)".
						"VALUES "."(".$_POST['tmpuid'].",'".$_POST['jlname']."',now(),".$_POST['jid'].",2)"; 
						
						if (mysqli_query($conn, $sql)) {
						//	echo "New record created successfully";
						} else {
							//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}		
						
$lastid = $conn->insert_id;

$result = mysqli_query($conn,"SELECT *  FROM joblog where logid = ".$lastid."");
  //echo $result->fetch_assoc();
 // print_r($result->fetch_assoc());
 while ($row = $result->fetch_assoc())
{
		$row['logid']=htmlentities(stripslashes($row['logid']));
		$row['luserid']=htmlentities(stripslashes($row['luserid']));
		$row['lcomment']=htmlentities(stripslashes($row['lcomment']));
		$tmpu = htmlentities(stripslashes($row['luserid']));
		
			include "jobloguser.php";
			
		$tmpupic = "upload/profile-pic/".$luroww["upic"];
		$tmpuname = $luroww["firstname"];
		
		//$mysqltime = date("Y-m-d",$row['ltime']);
		//$mysqltime = date ("Y-m-d H:i:s",$row['ltime']);
		$date = new DateTime($row['ltime']);
        $res = $date->format('m-d-Y');
		$ress = $date->format('h:i:s A');
		$row['ltime']=htmlentities(stripslashes($res));
		$row['stime']=htmlentities(stripslashes($ress));
		$row['tmpupicc']= $tmpupic;
		$row['tmpunamee']=htmlentities(stripslashes($tmpuname));
		//$row['pnumber']=htmlentities(stripslashes($row['pnumber']));
		
		//$row['customerid']=(int)$row['customerid'];
		$row_set[] = $row;//build an array
		//$country_name = str_replace($_POST['keyword'], '<b>'.$row['ID'].'</b>', $row['post_title']);
		 //echo '<li onclick="set_item(\''.str_replace("'", "\'", $row['post_title']).'\')">'.$country_name.'</li>';
}

  echo json_encode($row_set);
?>
