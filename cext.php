 <?php
require_once 'includes/config.php';
$extno=$_GET['opt'];
 $Ext_err="";
 
 
 
 
 
 if(empty(trim($extno)))
            {
            $Ext_err = "Please Enter valid Extension number";
            } 
           
            else
            {
             //$extno = trim($_POST["ext"]);
            
							//$a= strlen($extno);
							
						 
						 if(($extno[0]!=='A') and ($extno[0]!=='2')  and ($extno[0]!=='3') and ($extno[0]!=='4'))
              {
								$Ext_err="Extension Number Must start with 2,3,4 or A";
							
						
							}
							elseif(strlen($extno) != 4)
							{
								$Ext_err="Extension Number must be of length 4.";
							}
							else{}




             /* if(($extno[0] !== '2' or $extno[0] !== '3' or $extno[0] !== 'A') and strlen($extno) > 4) 
              {
								
								
							$Ext_err="Invalid Extension number. Use starting value 2,3 or A only.";
								
              } 
              else{
                //echo"Success";
              }*/
              
              
            
              $ext_check_query = "SELECT * FROM teledata WHERE Ext_No='$extno' LIMIT 1";
              $result = mysqli_query($conn, $ext_check_query);
              $user = mysqli_fetch_assoc($result);
              if ($user) { // if user exists
                if ($user['Ext_No'] === $extno) {
                  $Ext_err = "Extension Already Exist";
                  $un=$user['Uname'];
                }
            
                } 
                        }
                        

                         
                        ?>
                        

                            
<span class="help-block" style="color:red;font:6px" id="exte" name="exte"><label value="<?php echo $Ext_err;?>" onfocus="hide(this.value);"><?php echo $Ext_err; ?><label></span>
<?php 
 if($Ext_err=="Extension Already Exist")
 {?>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <label value="label" value="Click Here To Find More Information" id="label" onclick="hide1('<?php echo $Ext_err ?>');hide3(this.value); update14('<?php echo $un?>'); return false;">Click Here To Find More Information</label>
    
 <?php } ?>