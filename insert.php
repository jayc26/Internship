



<?php
// Include config file
require_once 'includes/config.php';
// Define variables and initialize with empty values
$blockname=$cable=$colorcode=$extno=$uname=$type="";
$blockname_err=$uname_err=$type_err=$Ext_err=$colorcode_err=$cable_err=$Oth_err="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['uname'])))
      {
        $uname_err = "Please Enter valid Username/Room";
      } 
      else
      {
        $uname = trim($_POST["uname"]);
      }
        
            if(empty(trim($_POST['ext'])))
            {
            $Ext_err = "Please Enter valid Extension number";
            } 
           
            else
            {
             $extno = trim($_POST["ext"]);
            
              
             
              if(($extno[0]!='2' or $extno[0]!='3' or $extno[0]!='A') and strlen($extno) > 4) 
              {
              $Ext_err="Invalid Extension number. Use starting value 2,3 or A only.";
              } 
              else{
                //echo"Success";
              }
              
              
            
              $ext_check_query = "SELECT * FROM teledata WHERE Ext_No='$extno' LIMIT 1";
              $result = mysqli_query($conn, $ext_check_query);
              $user = mysqli_fetch_assoc($result);
              if ($user) { // if user exists
                if ($user['Ext_No'] === $extno) {
                  $Ext_err = "Extension Already Exist";
                }
            
                } 
              }
           
           
            $blockname=$_POST['block'];
            if($blockname=="Select Block Name")
            {
              $blockname_err="Select Valid Block Name";
            }
            $colorcode=$_POST['color'];
            if($colorcode=="Select Color Code")
            {
              $colorcode_err="Select Valid Color Code";
            }
            
            $cable=$_POST['cable'];
            if($cable=="Select Cable Number")
            {
              $cable_err="Select Valid Cable Number";
			}
			$type=$_POST['type']; 
            if(empty($uname_err) && empty($type_err) && empty($blockname_err) && empty($colorcode_err) && empty($type_err) && empty($Ext_err) && empty($cable_err))
            {
			
              
              $query="Insert into teledata (Ext_No,BlockName,Uname,Cableno,Colorcode,Type) values('$extno','$blockname','$uname','$cable','$colorcode','$type')";
              mysqli_query($conn, $query);
              //echo"successful";
			}
			else{
				echo"error";
			}
           
            
           
            

}  
   // mysqli_close();
    ?>











<?php
/*
  $Extno=$_POST['Extno'];
  $Roomno=$_POST['Roomno'];
  $Cableno=$_POST['Cableno'];
  $Blockname=$_POST['Blockname'];
  $Colorcode=$_POST['Colorcode'];
  $Radio=$_POST['Radio'];
  $cmt=$_POST['cmt'];


if ((!empty($Extno)) || (!empty($Roomno)) || (!empty($Cableno)) || (!empty($Blockname)) || (!empty($Colorcode)))
{


	/*$host ="localhost";
	$dbUsername= "root";
	$dbPassword="";
	$dbname="tifr";


	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

	if (mysqli_connect_error()) 
	{
		die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());	
	}
	else
	{*/
		$query="Insert into teledata (Ext_No,BlockName,Uname,Cableno,Colorcode,Type) values('$extno','$blockname','$uname','$cable','$colorcode','$type')";
		mysqli_query($conn, $query);
		/*if ($conn->query($sql)) 
		{*/
			echo "<script> alert('new record is inserted');

			</script>";
			
		/*}
		else
		{
			echo "error". $sql."<br>".$conn->error;
		}
		
		$conn->close(); */
		header("location: form11.php");
//	}
	/*$host ="localhost";
	$dbUsername= "root";
	$dbPassword="";
	$dbname="tifr";

	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

	if (mysqli_connect_error()) 
	{
		die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());	
	}else 
	{
		$SELECT = " SELECT Ext_no from telephone where Ext_no =? Limit 1";
		$INSERT = "INSERT Into telephone (Extno, Roomno, Cableno, Blockname, Colorcode, Radio, cmt) values(?, ?, ?, ?, ?, ?, ?)"

		$stmt = $conn->prepare($SELECT);
		$stmt -> bind_param("s",$Ext_no);
		$stmt ->execute();
		$stmt ->bind_result($Ext_no);
		$stmt ->store_result();
		$rnum = $stmt->num_rows;

		if ($rnum==0) {
			$stmt-> close();

			$stmt = $conn -> prepare($INSERT);
			$stmt->bind_param("ssssii", $Extno, $Roomno, $Cableno, $Blockname, $Colorcode, $Radio, $cmt);
			$stmt->execute();
			echo "new record inserted succefully";
		}
		else 
		{
			echo "someone alrady resister using this email";
		}
		$stmt->close();
		$conn->conn();
	}*/
/*}
else 
{
	echo "All fields are required";
	die();
}*/

?>