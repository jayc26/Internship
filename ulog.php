<?php
session_start();
require_once 'includes/config.php';
$ql=$_GET['opt'];	
		
		

       

        if (isset($_GET['pageno'])) { 
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = $ql;
        $offset = ($pageno-1) * $no_of_records_per_page;

        //$conn=mysqli_connect("localhost","my_user","my_password","my_db");
        // Check connection
        /*if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }*/
		
       
        
            //here goes the data
            $total_pages_sql = "SELECT COUNT(*) FROM log";
            $result = mysqli_query($conn,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
           
            if(isset($_POST['dd']))
            {
                $d=$_POST['bday'];
                echo"<script>alert('$d');</script>";
            }


            $sql = "SELECT * FROM log LIMIT $offset, $no_of_records_per_page";
			$res_data = mysqli_query($conn,$sql);
			$count=mysqli_num_rows($res_data);
        
        
    
		?>
		
		

<?php//var_dump($count); ?>

								<?php
								if($count<$ql)
								{?>
								<label>Displaying <?php echo $count?> of <?php echo $total_rows?> Records</label>
								<?php }?>

								 
                            <label>Displaying <?php echo $offset+$ql?> of <?php echo $total_rows?> Records</label>
								<table class="table table=striped" width="800px" id="example" >
									<thead style="background-color:#E8E8E8; width:300px;">
										<tr>
											<th title="Field #1"style="width:60px;font-weight:700px">
												Extension Number
											</th>
										
											<th title="Field #3"style="width:150px">
												Name Of The User/Room Name
											</th>




											<th title="Field #7" style="width:100px">
												Location Node
											</th>
											<th title="Field #7" style="width:100px">
												Shelf Address
											</th>
											<th title="Field #7" style="width:100px">
												Board Address
											</th>
											<th title="Field #7" style="width:100px">
												Equipment Address
											</th>
											<th title="Field #7" style="width:100px">
												Set Type
											</th>
											<th title="Field #7" style="width:100px">
												Entity Number
											</th>
											<th title="Field #7" style="width:100px">
												Set Function
											</th>






											<th title="Field #4"style="width:120px">
												Colour Code
											</th>
											<th title="Field #5"style="width:50px">
												Cable No
											</th>
											<th title="Field #6" style="width:100px">
												Block Name
											</th>
											<th title="Field #7" style="width:100px">
												Type
											</th>
											
											<th title="Field #9" style="width:100px">
												Actions
											</th>
											<th title="Field #10" style="width:100px">
												Reason
                                            </th>
                                            <th title="Field #11" style="width:200px">
												Admin Name
                                            </th>
                                            <th title="Field #9" style="width:200px">
												Time
											</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									
									 
									 while($row = mysqli_fetch_array($res_data)){
							 
										 $delex=$row['Ext_No'];
										 //$een=$row['Ext_No'];
										 $name=$row['Uname'];
										 $cc=$row['Colorcode'];
										 $cn=$row['Cableno'];
										 $type=$row['Type'];
										// $cmt=$row['Comments'];
										 $bname=$row['BlockName'];
										 $ln=$row['LNode'];
										 $sa=$row['SAdd'];
										 $ba=$row['BAdd'];
										 $ea=$row['EAdd'];
										 $st=$row['SType'];
										 $en=$row['Eno'];
										 $sf=$row['SFun'];
										 	?>
											
										 <?php 
										//var_dump($delex);
							 
										
										 ?>
										 <form method="post">
										<tr>
											
											<td>
											
											<?php echo $row['Ext_No']?>
											</td>
										
											<td>
											<?php echo $row['Uname'] ?>
											
											
											
											</td>



											<td>
											<?php echo $row['LNode'] ?>
											</td>
											<td>
											<?php echo $row['SAdd'] ?>
											</td>
											<td>
											<?php echo $row['BAdd'] ?>
											</td>
											<td>
											<?php echo $row['EAdd'] ?>
											</td>
											<td>
											<?php echo $row['SType'] ?>
											</td>
											<td>
											<?php echo $row['Eno'] ?>
											</td>
											<td>
											<?php echo $row['SFun'] ?>
											</td>






											<td>
											<?php echo $row['Colorcode'] ?>
											</td>
											<td>
											<?php echo $row['Cableno'] ?>
											</td>
											<td>
											<?php echo $row['BlockName'] ?>
											
											</td>
											<td>
											<?php echo $row['Type'] ?>
											</td>
											<td>
											<?php echo $row['Action'] ?>
                                            </td>
                                            <td>
											<?php echo $row['Reason'] ?>
                                            </td>
                                            <td>
											<?php echo $row['Aname'] ?>
                                            </td>
                                            <td>
											<?php echo $row['Timestamp'] ?>
                                            </td>
											
											
										</tr>
									<?php }
									mysqli_close($conn);
									?>
										
										

									</tbody>
								</table>
									</form>
									
								
		