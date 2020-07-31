<?php
$un=$_GET['opt'];
?>






<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="uname2">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														 Name and room number:
													</label>
													<input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $un ?>" disabled>
													
                                                </div>