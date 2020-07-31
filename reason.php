<?php
session_start();
require_once 'includes/config.php';



if(isset($_REQUEST["reason"]) and isset($_REQUEST["ex"]))
{
	
	$ex=mysqli_escape_string($conn,$_POST['ex']);	
$reason=mysqli_escape_string($conn,$_POST['reason']);
echo $reason;
echo $ex;

//$ex=$_SESSION['Ext'];



$query5="select * from teledata where Ext_No='$ex'";
											 $res=mysqli_query($conn,$query5);
											 echo"successful" . mysqli_error($conn);
											 $row = mysqli_fetch_array($res);
											 $bname=$cc=$cn=$type=$cmt="";
											 $een=$row['Ext_No'];
											 //echo $een;
											 $name=$row['Uname'];
											 //echo $name;
											 $bname=$row['BlockName'];
											 $ln=$row['LNode'];
											 $ecc=$row['ECC'];
											 $ecn=$row['ECN'];
											 $scc=$row['SCC'];
											 $scn=$row['SCN'];
											 $sa=$row['SAdd'];
											 $ba=$row['BAdd'];
											 $ea=$row['EAdd'];

											 $type=$row['Type'];
											 $cmt=$row['Comments'];
											 $d=date("Y-m-d h:i:sa");
											 $aname=$_SESSION['username'];
											 //echo $type;
											 //echo $cc;
//var_dump($reason);
$query1="insert into logdata(Ext_No,BlockName,Uname,LNode,SAdd,BAdd,EAdd,ECC,ECN,SCC,SCN,Type,Action,Reason,Aname,Timestamp) values('$een','$bname','$name','$ln','$sa','$ba','$ea','$ecc','$ecn','$scc','$scn','$type','Deleted','$cmt','$aname','$d')";
			mysqli_query($conn, $query1);
	echo"successful" . mysqli_error($conn);
	//echo"<script> delData( ".$een.") return false;</script>";
	$query21="Delete from teledata where Ext_No='$een'";
	mysqli_query($conn,$query21);
	$q77="delete from hops where Ext_No='$een'";
	mysqli_query($conn,$q77);

	//$qu="update colorcode set CCount='0' where ColorCode='$cc'";
	//mysqli_query($conn,$qu);
	echo"<script> alert('Record Deleted Successfully'); </script>";
	//header("location: form11.php");
	



	
}
else
{
	echo"<script> alert('Hello'); </script>";
	echo "error";
}
?>