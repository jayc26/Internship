<?php

if(isset($_POST['Edit']))
										 {
												
											$ed=$_POST['Edit'];
											//echo"$ed";
											$query21="select * from teledata where Ext_No='$ed'";
											 $res=mysqli_query($conn,$query21);
											 $row = mysqli_fetch_array($res);
											 $bname=$cc=$cn=$type=$cmt="";
											 $een=$row['Ext_No'];
											 $name=$row['Uname'];
											 $bname=$row['BlockName'];
											 $cc=$row['Colorcode'];
											 $cn=$row['Cableno'];
											 $type=$row['Type'];
											 $cmt=$row['Comments'];
											 //var_dump($een);
											 //var_dump($name);
											
											$_SESSION['extno'] = $een;
											$_SESSION['name'] = $name;
											$_SESSION['blockname'] = $bname;
											$_SESSION['Colorcode'] = $cc;
											$_SESSION['Cableno'] = $cn;
											$_SESSION['Type'] = $type;
											$_SESSION['Comments'] = $cmt;
											
										/*	echo '<script type="text/javascript">',
													'f1();',
													'</script';*/
													header("Location: form12.php");
										 	}
?>



<html>
  <head>
  <meta name="description" content="Datatable HTML table">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

      <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/favicon.ico" />
	</head>





<?php
require_once 'includes/config.php';
$q =$_GET['q'];
//var_dump($q);
//$query = "select * from teledata";
$query = "SELECT * FROM teledata WHERE Ext_No like '$q%' OR BlockName like '$q%' OR Uname like '$q%' OR C_code like '$q%' OR Colorcode like '$q%' OR Cableno like '$q%' OR Type like '$q%'";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
//var_dump($count);

    echo " <div>
    
    <table class='table table=striped' width='100%' id='example'>
    <thead style='background-color:#E8E8E8'>

      <tr>
        <th>Extention no</th>
         <th>C-Code</th>
          <th>Name/Room no.</th>



          <th  style='width:100px'>
												Location Node
											</th>
											<th  style='width:100px'>
												Shelf Address
											</th>
											<th  style='width:100px'>
												Board Address
											</th>
											<th  style='width:100px'>
												Equipment Address
											</th>
											<th  style='width:100px'>
												Set Type
											</th>
											<th  style='width:100px'>
												Entity Number
											</th>
											<th  style='width:100px'>
												Set Function
											</th>


           <th>Color code</th>
           <th>Cable Number</th>
            <th>Block name.</th>
            <th>Type</th>
            <th>Comments</th>
            <th>Actions</th>
      </tr> </thead>
      <tbody>";
while($row=mysqli_fetch_assoc($result)){
                  $ex = $row['Ext_No'];
                  echo "<tr id='td_$ex'>";
                  echo "<td>" . $row['Ext_No'] . "</td>";
                  echo "<td>" . $row['C_code'] . "</td>";
                  echo "<td>" . $row['Uname'] . "</td>";
                  echo "<td>" . $row['LNode'] . "</td>";
                  echo "<td>" . $row['SAdd'] . "</td>";
                  echo "<td>" . $row['BAdd'] . "</td>";
                  echo "<td>" . $row['EAdd'] . "</td>";
                  echo "<td>" . $row['SType'] . "</td>";
                  echo "<td>" . $row['Eno'] . "</td>";
                  echo "<td>" . $row['SFun'] . "</td>";
                  echo "<td>" . $row['Colorcode'] . "</td>";
                  echo "<td>" . $row['Cableno'] . "</td>";
                  echo "<td>" . $row['BlockName'] . "</td>";
                  echo "<td>" . $row['Type'] . "</td>";
                  echo "<td>" . $row['Comments'] . "</td>";
                  echo "<td>";
                 


                  echo                     "              	<form method='post'>
                  <input type='hidden' name='Edit' value=".$row['Ext_No']."  />
                     <button type='submit' class='btn btn-info btn-sm' name='edit' id='edit' style='color:black; background-color:white;border-color:gray'>
                       <span class='glyphicon glyphicon-edit'></span>
                    </button>
                    &nbsp;
               </form>
                   
                    

                    
                    
                    <form method='post' style='float:right; margin-left:30px;margin-top:-49px'>
                    &nbsp;
                    <input type='hidden' name='Ext' value=".$row['Ext_No']."  />
                    
                    <button type='submit' value='' name='delete' id='btn_".$row['Ext_No']."' class='btn btn-info btn-sm' style='color:black; background-color:white;border-color:gray; margin-left:19px'  onclick='dis2( " .$row['Ext_No']."); return false;'>
                    
                    <span class='glyphicon glyphicon-trash'> </span>
                     </button>
                    
                 </form>    
                 </td>"
                                                     ;
                                                    
                                                     echo "</tr>";
                                                                      




}
         echo"
         </tbody></table>
          
        </div>";
        mysqli_close($conn);
        ?>