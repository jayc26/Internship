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
$query = "SELECT * FROM log WHERE Ext_No like '$q%' OR BlockName like '$q%' OR Uname like '$q%' OR  Colorcode like '$q%' OR Cableno like '$q%' OR Type like '$q%' OR Action like '$q%' OR Reason like '$q%' OR Aname like '$q%' OR Timestamp like '$q%'";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
//var_dump($count);

    echo " <div>
    
    <table class='table table=striped' width='100%' id='example'>
    <thead style='background-color:#E8E8E8'>

      <tr>
        <th>Extention no</th>
        
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
            <th>Actions</th>
            <th>Reason</th>
            <th>Admin Name</th>
            <th>Time</th>
      </tr> </thead>
      <tbody>";
while($row=mysqli_fetch_assoc($result)){
   
                  echo "<tr>";
                  echo "<td>" . $row['Ext_No'] . "</td>";
                 // echo "<td>" . $row['C_code'] . "</td>";
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
                  echo "<td>" . $row['Action'] . "</td>";
                  echo "<td>" . $row['Reason'] . "</td>";
                  echo "<td>" . $row['Aname'] . "</td>";
                  echo "<td>" . $row['Timestamp'] . "</td>";
                 
                  echo "</tr>";
}
         echo"
         </tbody></table>
          
        </div>";
        mysqli_close($conn);
        ?>