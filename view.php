<?php
session_start();
require_once 'includes/config.php';
if(isset($_REQUEST["r"]) and isset($_REQUEST["ex"]))
{
	
	$ex=mysqli_escape_string($conn,$_POST['ex']);	
$reason=mysqli_escape_string($conn,$_POST['r']);
//echo $reason;
//echo $ex;
    
    //$ex=mysqli_escape_string($conn,$_POST['ex1']);	

											 //$ex=$_POST['data1'];
											 $qd="select * from hops where Ext_No='$ex'";
											 $result = mysqli_query($conn,$qd);
											 $count=mysqli_num_rows($result);
											 $qd1="select * from teledata where Ext_No='$ex'";
											 $result1 = mysqli_query($conn,$qd1);
											 while($row1 = mysqli_fetch_array($result1)){
												 $lno=$row1['LNode'];
												 $clr=$row1['ECC'];
												 $cno1=$row1['ECN'];
												 $scc=$row1['SCC'];
												 $scn=$row1['SCN'];
												 
											 }

											 $data=array();
											 $i=1;
											 if($count>0)
											 {
											 while($row = mysqli_fetch_array($result)){
												 $ext=$row['Ext_No'];
												 $bn=$row['BlockName'];
												 $cb=$row['Cableno'];
												 $ln=$row['LNode'];
												 $cl=$row['ColorCode'];
												 $hn=$row['hopno'];
												 $c=$row['TCount'];
												 //$data=$row;
												// echo "<fieldset style= 'border :TRUE'><legend>Hop</legend><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Location Node:</label><input type='text' name='location[]' id='lc' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''><br><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Cable No:</label><input type='text' name='cable[]' id='cadsaadsble' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''><br><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Color Code:</label><input type='text' name='color[]' id='cor' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''></fieldset>";
												 $data[$i]="
												 <label > Hop: </label><label>$hn </label> 
												 <table border='0'>
												 <tr><td>
												 <label style='margin-right: 170px;'> Location Node:</label></td> <td align='center'><label> $ln </label></td></tr>
												 <tr><td>
												 <label style='margin-right: 170px;'>Cable Number: </label> </td> <td align='center'><label>$cb</label></td></tr>
												 <tr><td>
												 <label style='margin-right: 170px;'> Color Code:</label></td> <td align='center'><label> $cl</label></td></tr> </table>";
												 $i=$i+1;
												//$data=implode(',',$row);
												
										//$data="Hi";
											 }
											 $reason1=implode(' ',$data);
											 $reason="


											 <fieldset style='border :solid'>
											<table border='0'>
											<label align='center'>Extension</label>
											<tr><td>
											 <label style='margin-right: 100px;'>Location Node:</label></td> <td align='center'><label>$lno</label></td></tr>
											 <tr><td> 
											  <label style='margin-right: 100px;'>Cable No: </label></td> <td align='center'> <label>$cno1</label></td></tr> 
											  <tr><td>
											  <label style='margin-right: 100px;'>Color Code: </label> </td> <td align='center'><label>$clr</label>  </td></tr>
											</table>
											</fieldset>
											</br>

											  <fieldset style='border :solid'><label align='center'>Ad Hoc</label></br><label>$reason1</label> </fieldset>
											  
											  </br>
											  </br>
											  
											  


											  <fieldset style='border :solid'>
											  <table border='0'>
											  <label align='center'>Subscriber</label>
											  <tr><td>
											  <label style='margin-right: 100px;'>Cable No: </label> </td> <td align='center'><label>$scn</label> </td></tr>
											  <tr><td>
											  <label style='margin-right: 100px;'>Color Code:</label></td> <td align='center'> <label>$scc</label> </td></tr>
											  </fieldset>  
											  
											 
											 
											 
											 
											 
											 
											 
											 
											 
											 
											  </br>";
                                             echo json_encode($reason);
											}
											else{
                                                $reason="No Hops!";
                                                echo json_encode($reason);
											}
											
                //echo "<script> disp1('$reason');</script>";
                                        }
                                        else{
                                            echo $reason;
                                        }
			
?>