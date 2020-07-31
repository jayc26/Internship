<?php
session_start();
require_once 'includes/config.php';
$ql1=$_GET['opt'];	
		
		

       
//echo"<script>alert('$ql');</script>";

if (isset($_GET['pageno'])) { 
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = $ql1;
$offset = ($pageno-1) * $no_of_records_per_page;

//$conn=mysqli_connect("localhost","my_user","my_password","my_db");
// Check connection
/*if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}*/



                //here goes the data
                $total_pages_sql = "SELECT COUNT(*) FROM teledata";
                $result = mysqli_query($conn,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
        
                $sql = "SELECT * FROM teledata LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res_data);



?>



<?php//var_dump($count); ?>

                                <?php
                                if($count>0)
                                {?>

                         
                          <?php
								if($count<$ql1)
								{?>
								<label>Displaying <?php echo $count?> of <?php echo $total_rows?> Records</label>
								<?php } else {?>

								 
                            <label>Displaying <?php echo $offset+$ql1?> of <?php echo $total_rows?> Records</label>
                                <?php } ?>
                        <table class="table table=striped" width="100%" id="example">
                            <thead style="background-color:#E8E8E8">
                                <tr>
                                    <th title="Field #1"style="width:60px;font-weight:700px">
                                        Extension Number
                                    </th>
                                    <th title="Field #2"style="width:50px">
                                        C-Code	
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
                                    <th title="Field #5"style="width:50px">
                                        Exchange Cable No
                                    </th>
                                    <th title="Field #4"style="width:120px">
                                        Exchange Color Code
                                    </th>
                                    <th title="Field #5"style="width:50px">
                                        Subscriber Cable No
                                    </th>
                                    <th title="Field #4"style="width:120px">
                                        Subscriber Color Code
                                    </th>
                                    
                                    <th title="Field #6" style="width:100px">
                                        Block Name
                                    </th>
                                    <th title="Field #7" style="width:100px">
                                        Type
                                    </th>
                                    <th title="Field #8" style="width:100px">
                                        Comments
                                    </th>
                                    <th title="Field #6" style="width:100px">
                                        Hop Information
                                    </th>
                                    <th title="Field #9" style="width:100px">
                                        Actions
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                             
                             while($row = mysqli_fetch_array($res_data)){
                     
                                 $delex=$row['Ext_No'];
                                 //$een=$row['Ext_No'];
                                 $name=$row['Uname'];
                                 $ecc=$row['ECC'];
                                 $ecn=$row['ECN'];
                                 $scc=$row['SCC'];
                                 $scn=$row['SCN'];
                                 $type=$row['Type'];
                                 $cmt=$row['Comments'];
                                 $bname=$row['BlockName'];
                                 $ln=$row['LNode'];
                                 $sa=$row['SAdd'];
                                 $ba=$row['BAdd'];
                                 $ea=$row['EAdd'];
                                 //$st=$row['SType'];
                                 //$en=$row['Eno'];
                                 //$sf=$row['SFun'];
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
                                    <?php echo $row['C_code'] ?>
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
                                    <?php echo $row['ECN'] ?>
                                    </td>
                                    <td>
                                    <?php echo $row['ECC'] ?>
                                    </td>
                                    <td>
                                    <?php echo $row['SCN'] ?>
                                    </td>
                                    <td>
                                    <?php echo $row['SCC'];?>
                                    </td>
                            
                                    <td>
                                    <?php echo $row['BlockName'] ?>
                                    
                                    
                                    </td>

                                    <td>
                                    <?php echo $row['Type'] ?>
                                    </td>
                                    <td>
                                    <?php echo $row['Comments'] ?>
                                    
                                    </td>
                                    <td>
                                <form method="post"> 
                                <input type="hidden" name='data1' value="<?php echo $row['Ext_No']?>"  />
                                <button type="submit" class="btn btn-info btn-sm" name="data" id="data" style="color:black; background-color:white;border-color:gray" onclick="delv('<?php echo $row['Ext_No']?>'); return false;">View</button>
                             </form>
                                    </td>

                                    <td style="width:150px">

                                    <form method="post">
                                    <input type="hidden" name='Edit' value="<?php echo $row['Ext_No']?>"  />
                                         <button type="submit" class="btn btn-info btn-sm" name="edit" id="edit" style="color:black; background-color:white;border-color:gray">
                                             <span class="glyphicon glyphicon-edit"></span>
                                        </button>
                                        &nbsp;
                             </form>
                                        <!--<input type="button" name="Edit" id="Edit" value="Edit"/>-->
                                
                                        

                                        
                                        
                                        <form method="post" style="float:right; margin-left:40px;margin-top:-78px" action="" >
                                        &nbsp;
                                        
                                        <input type="hidden" name='Ext'  value="<?php echo $row['Ext_No']?>" id='Ext' />

                                        
                                        <!--<button type="image" class="btn btn-info btn-sm" name="del" id="del" style="color:black; background-color:white;border-color:gray" onclick="delData(<?php //$row['Ext_No'] ?>)" >-->
                                        <button value="" class="btn btn-info btn-sm" style="color:black; background-color:white;border-color:gray; margin-top:29px" id="myBtn" Onclick="dis('<?php echo $row['Ext_No']?>'); return false;">
                                        <!--<button type="button" height="20px" width="20px" name="Ext" id="#btn_<?php// $row['Ext_No']?>" onclick=delData1(<?php// $row['Ext_No'] ?>)>
                                        </button>-->
                                        <span class="glyphicon glyphicon-trash"> </span>
                                         </button>
                                         
                                        <!--<input type="image" src="icons/delete.jpg" height="20px" width="20px" name="delete" id="delete">-->
                                        <label type="text" id="Print" value="Accepted"> </label>
                                        
                                 </form>
                              <?php
                              /*if(isset($_POST['Ext']))
                              {
                                if($row['Ext_No']==$delex)
                                { ?>
                                
                                    
                                 Deleted
                                 <?php
                                 echo '<script type="text/javascript">myb()</script>'; ?>
                                 
                                 
                                 <?php
                                }
                              }*/
                             
                              ?>
                                    </td>
                                    
                                </tr>
                            <?php }
                            
                            ?>
                                
                                
                                                                        
                                
                            </tbody>
                        </table>
                    <?php	mysqli_close($conn);
                                                                }
                                                                else
                                                                { ?>
                                                                <center>
                            <legend> No records Found</legend>
                            </center>
                                                                <?php } ?>
                            </form>                                
                                

								
								
										
										

									</tbody>
								</table>
									</form>
									
								
		