<?php
$un=$_GET['q'];
session_start();
if (!isset($_SESSION['username'])){

	header("location: login.php");


}





require_once 'includes/config.php';
$q="select * from teledata where Ext_No='$un'";
if($r=mysqli_query($conn,$q))
{

$count=mysqli_num_rows($r);
if($count>0)
{
    while($row = mysqli_fetch_assoc($r)){

        $blockname=$row['BlockName'];
        $ln=$row['LNode'];
        $sa=$row['SAdd'];
        $ba=$row['BAdd'];
        $ea=$row['EAdd'];
        $uname=$row['Uname'];
        $ecc=$row['ECC'];
        $ecn=$row['ECN'];
        $scc=$row['SCC'];
        $scn=$row['SCN'];
        $type=$row['Type'];
        $cmt=$row['Comments'];
    }



?>
    
    
    <div class="form-group m-form__group" >
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Name and room number:
														   </label>
														   <input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $uname?>"   disabled> 
														   
												</div>


												<div class="form-group m-form__group" style="margin-top: 2px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Location Node :
														   </label>
														   <input type="text" name="location" id="location" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $ln?>"   disabled>
												</div>
												<div class="form-group m-form__group" style="margin-top: 4px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Shelf Address :
														   </label>
														   <input type="text" name="saddress" id="saddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $sa?>"   disabled>
												</div>
												<div class="form-group m-form__group" style="margin-top: 4px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Board Address :
														   </label>
														   <input type="text" name="baddress" id="baddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $ba?>"   disabled>
												</div>
												<div class="form-group m-form__group" style="margin-top: 6px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Equipment Address :
														   </label>
														   <input type="text" name="eaddress" id="eaddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $ea?>"   disabled>
												</div>
												<div class="form-group m-form__group"style="margin-top: 6px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Block Name  :
														   </label>
														   <input type="text" name="block" id="block" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $blockname?>"  disabled>
												</div>

												<div class="form-group m-form__group" style="margin-top: 6px;">
														<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica;">Exchange</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable1" id="cable1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $ecn?>" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color1" id="color1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $ecc?>" disabled>

															</fieldset>
					
												</div>

												<div class="form-group m-form__group" style="margin-top: 10px;">


                                                <?php 
																													$eq="select * from hops where Ext_No='$un'";
																													$result=mysqli_query($conn,$eq);
																													
																													while($r=mysqli_fetch_assoc($result))
																													{
																														//$tc=$r['TCount'];
																													?>


														<!--<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica;">Ad Hoc</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																		Location:
																	</label>
														
																	<input type="text" name="location1" id="location1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $r['LNode']?>" disabled>
														<br>		
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable2" id="cable2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $r['Cableno']?>" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color2" id="color2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $r['ColorCode']?>" disabled>

                                                            </fieldset>-->
															<?php } ?>
															<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Hop Information
														   </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														   <input type="hidden" name='data1' value="<?php echo $un?>"  />
										<button type="submit" class="btn btn-info btn-sm" name="data" id="data" style="color:black; background-color:white;border-color:gray" onclick="delv('<?php echo $un?>'); return false;">View</button>
									 
					
												</div>
												<div class="form-group m-form__group" style="margin-top: 2px;">
														<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica;">Subscriber</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable3" id="cable3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $scn?>" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color3" id="color3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $scc?>" disabled>

															</fieldset>
					
												</div>
												<div class="form-group m-form__group" style="margin-top: 2px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Telephone Type :
														   </label>
														   <input type="text" name="type" id="type" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $type?>"  disabled>
												</div>

												<div class="form-group m-form__group"  style="margin-top: 2px;">
														<label for="example_input_full_name" style="margin-left: 1px; margin-top:-250px; font-family: helvetica; font-weight: bold;">
															 Comments:
														</label>
													
													</div>
														<div>
															<textarea  placeholder="" style="size: 100%; margin-left:180px; height: 80px; width: 210px; margin-top: -38px"  name="cmt" type="text" class="txt_3" disabled><?php echo $cmt?></textarea>
																														
														</div>

												
											</div>
                                        </div>
                                                                                                                    <?php }  
                                                                                                                else{ ?>
                                                                                                                    <p>Wrong Extension Number</p>

                                      <?php  } ?>    
                                                                                                              
                                                                                                                  <?php  } ?>
                                                                                                                    
                                                                                                                    