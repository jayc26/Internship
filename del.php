<?php
require_once 'includes/config.php';
if(isset($_REQUEST["sid"]) and isset($_REQUEST["ex"]))
{

	$ex=$_POST['sid'];
	$reason=$_POST['reason'];
	//var_dump($ex);

	$query5="select * from teledata where Ext_No='$ex'";
											 $res=mysqli_query($conn,$query5);
											 echo"successful" . mysqli_error($conn);
											 $row = mysqli_fetch_array($res);
											 $bname=$cc=$cn=$type=$cmt="";
											 $een=$row['Ext_No'];
											 echo $een;
											 $name=$row['Uname'];
											 echo $name;
											 $bname=$row['BlockName'];
											 $cc=$row['Colorcode'];
											 $cn=$row['Cableno'];
											 $type=$row['Type'];
											 $cmt=$row['Comments'];
											 $d=date("Y-m-d h:i:sa");
											 $aname=$_SESSION['username'];
											 echo $type;
											 echo $cc;
//var_dump($reason);
$qu="update colorcode set CCount='0' where ColorCode='$cc'";
	mysqli_query($conn,$qu);
$query6="Insert into log (Ext_No,BlockName,Uname,Cableno,Colorcode,Type,Action,Reason,Aname,Timestamp) values('$een','$bname','$name','$cn','$cc','$type','Deleted','$reason','$aname','$d')";
	mysqli_query($conn, $query6);
	echo"successful" . mysqli_error($conn);
	//$qe="update colorcode set CCount=0 where ColorCode='$cc'";
	//mysqli_query($conn,$qe);
	//$qu="update colorcode set CCount='0' where ColorCode='$cc'";
	//mysqli_query($conn,$qu);
	$query="delete FROM teledata where Ext_No=$ex";
	mysqli_query($conn,$query);
}else echo 'Not Deleted Error Occured';
?>