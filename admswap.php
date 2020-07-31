<?php

session_start();
		if (!isset($_SESSION['username']))
		{
		
			header("location: login.php");
		
		
		}
		$role=$_SESSION['Role'];

		if($role=="User")
		{
			echo"<script>window.location.assign('swap.php');</script>";
		}
		require_once 'includes/config.php';
		$e1=$e2="";
		if($_SERVER["REQUEST_METHOD"] == "POST")
{



	if(empty(trim($_POST['ext1'])))
	{
		$Ext_err = "Please Enter valid Extension number";
      } 
         
			$e1=$_POST['ext1'];
			if(empty(trim($_POST['ext2'])))
			{
				$Ext_err = "Please Enter valid Extension number";
			  } 
				 
					$e2=$_POST['ext2'];
					//echo"<script>alert('$e1 $e2');</script>";
					if($e1==$e2)
					{
					

						if($role=="User")
						{
							echo"<script>alert('Extension Numbers Must Be Different');window.location.assign('swap.php');</script>";
						}
						else{
						echo"<script>alert('Extension Numbers Must Be Different');window.location.assign('admswap.php');</script>";
						}
						//header("Location: swap.php");
						exit();	
					}

					$ext_check_query1 = "SELECT * FROM teledata WHERE Ext_No='$e2' LIMIT 1";
					$result1 = mysqli_query($conn, $ext_check_query1);
					$user1 = mysqli_fetch_assoc($result1);
				



					$ext_check_query = "SELECT * FROM teledata WHERE Ext_No='$e1' LIMIT 1";
					$result = mysqli_query($conn, $ext_check_query);
					$user = mysqli_fetch_assoc($result);
					if ($user && $user1)  { // if user exists
						if (($user['Ext_No'] === $e1) &&($user1['Ext_No'] === $e2)) {
							$q="update teledata set Ext_No='1000' where Ext_No='$e1'";
							mysqli_query($conn,$q);
							$q1="update teledata set Ext_No='$e1' where Ext_No='$e2'";
							mysqli_query($conn,$q1);
							
							$q2="update teledata set Ext_No='$e2' where Ext_No='1000'";
							mysqli_query($conn,$q2);


							$hop_check_query1 = "SELECT * FROM hops WHERE Ext_No='$e2' LIMIT 1";
					$hr1 = mysqli_query($conn, $hop_check_query1);
					$huser1 = mysqli_fetch_assoc($hr1);
					$hop_check_query = "SELECT * FROM hops WHERE Ext_No='$e1'";
					$hr = mysqli_query($conn, $hop_check_query);
					$huser = mysqli_fetch_assoc($hr);
					if($huser && $huser1)  { 
						// if user exists
						if (($huser['Ext_No'] === $e1) &&($huser1['Ext_No'] === $e2)) {
							//echo"<script>alert('In12');</script>";
							$h="update hops set Ext_No='1000' where Ext_No='$e1'";
							mysqli_query($conn,$h);
							//echo"<script>alert('$e1 $e2');</script>";
							$h1="update hops set Ext_No='$e1' where Ext_No='$e2'";
							mysqli_query($conn,$h1);
							//echo"<script>alert('$e1 $e2');</script>";
							$h1="update hops set Ext_No='$e2' where Ext_No='1000'";
							mysqli_query($conn,$h1);
							//echo"<script>alert('$e1 $e2');</script>";
							//echo"<script>alert('Out12');</script>";
						}
					}

							$_SESSION['ex1'] = $e1;
							$_SESSION['ex2'] = $e2;
							echo"<script>alert('Swap Successful');</script>";
							

							if($role=="User")
							{
								echo"<script>window.location.assign('swap1.php');</script>";
							}
							else{
							header("Location: admswap1.php");
							}
						}
						else
						{
							echo "<script>alert('Wrong Extension Numbers');</script>";
							//header("Location: swap1.php");
						}
						
						} 
						else{
							echo "<script>alert('Wrong Extension Numbers');</script>";
						}







}





?>
<!DOCTYPE html>

<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			TIFR
		</title>
		<meta name="description" content="Default form examples">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo//logo.png" />
		<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
	
  display: none; /* Hidden by default */
  position: absolute; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
	padding-left:200px;
	padding-right:100px;
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 50px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {

  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
		
		<script>

function lol()
{
// Get the modal
//var modal = document.getElementById('myModal');
var modal1 = document.getElementById('myModal1');
//$('#mymodal1').draggable();
$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal1.style.display = "none";
		}
	});
// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
// When the user clicks the button, open the modal 


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  //modal.style.display = "none";
	modal1.style.display = "none";
}
//span1.onclick = function() {
  //modal.style.display = "none";
//	modal1.style.display = "none";
//}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  //if (event.target == modal) {
    //modal.style.display = "none";
  //}
	if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
}
</script>



		  <script>

function delv(ex) {
	alert(ex);
	var r="1";
	var res1;
	var data = {
												r: r,
												ex: ex
											};
				
											
											
											$.post("view.php",data,function(response){
												//var r1=response.length;
											//res1=JSON.stringify(response);
											//res1=jQuery.parseJSON(response.responseText);
											//res1=parseHTML(response);
											res1=JSON.parse(response);
												disp1(res1);
											});
										
		
}


function disp1(x)
{
	var modal = document.getElementById('myModal1');
	//$('#mymodal1').draggable();
	var l=	document.getElementById('ld');
	modal.style.display = "block";
	l.innerHTML=x;
}









function update(str) {
    if (str.length == 0) { 
		//document.getElementById("txtHint").style.margin-left="300px";
		var a=document.getElementById("e1").innerHTML = "<span style='margin-left:150px;font-size:16px'>No results found. </span>";
		//a.style.margin-left="300px";
		
		
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("e1").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "ex1.php?q=" + str, true);
        xmlhttp.send();
    }
}



function update1(str) {
    if (str.length == 0) { 
		//document.getElementById("txtHint").style.margin-left="300px";
		var a=document.getElementById("e2").innerHTML = "<span style='margin-left:150px;font-size:16px'>No results found. </span>";
		//a.style.margin-left="300px";
		
		
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("e2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "ex2.php?q=" + str, true);
        xmlhttp.send();
    }
}











			  </script>












	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" onload="lol(); return false;" >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
				<div class="m-container m-container--fluid m-container--full-height">
					<div class="m-stack m-stack--ver m-stack--desktop">
						<!-- BEGIN: Brand -->
						<div class="m-stack__item m-brand  m-brand--skin-dark ">
							<div class="m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-stack__item--middle m-brand__logo">
										<label  style="color:White; font-size:55px; font-style: italic; font-variant:small-caps; font-weight:bold; font-family:helvetica ">TIFR</label>
									<a href="../../../index.html" class="m-brand__logo-wrapper">
										
									</a>
								</div>
								<div class="m-stack__item m-stack__item--middle m-brand__tools">
									<!-- BEGIN: Left Aside Minimize Toggle -->
									<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block 
					 ">
										<span></span>
									</a>
									<!-- END -->
							<!-- BEGIN: Responsive Aside Left Menu Toggler -->
									<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
							<!-- BEGIN: Responsive Header Menu Toggler -->
									<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
										<span></span>
									</a>
									<!-- END -->
			<!-- BEGIN: Topbar Toggler -->
									<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
										<i class="flaticon-more"></i>
									</a>
									<!-- BEGIN: Topbar Toggler -->
								</div>
							</div>
						</div>
						<!-- END: Brand -->
						<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
							<!-- BEGIN: Horizontal Menu -->
							<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
								<i class="la la-close"></i>
							</button>
							
							<!-- END: Horizontal Menu -->								<!-- BEGIN: Topbar -->
							<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
								<div class="m-stack__item m-topbar__nav-wrapper">
									<ul class="m-topbar__nav m-nav m-nav--inline">
										
										<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
											<a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
														<img src="icons/images11.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
												<span class="m-topbar__username m--hide">
													Nick
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
													<div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																	<img src="icons/images11.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
																</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																<?php echo $_SESSION['username']; ?>
																</span>
																
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																<li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
																</li>
																
																


																<?php
									if (isset($_SESSION['username'])){
									?>
																	
																<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																<form role="form" action="Logout.php">
																	<a href="Logout.php" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
																		Logout
																	</a>
																	</form>
																	<?php } ?>





															
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!-- END: Topbar -->
						</div>
					</div>
				</div>
			</header>
			<!-- END: Header -->		
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
					<!-- BEGIN: Aside Menu -->
	<div 
		id="m_ver_menu" 
		class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
		m-menu-vertical="1"
		 m-menu-scrollable="0" m-menu-dropdown-timeout="500"  
		>
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							
							<li class="m-menu__section">
									<h5 class="m-menu__section-text" style="font-family:helvetica;font-weight:bold;">
											Components
										</h5>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>

							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"  m-menu-submenu-toggle="hover">
					
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true" >
												<a  href="admtable.php" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text" style="font-weight: bold; font-family: helvetica;">
													 <h5> Connection Table </h5>
													</span>
												</a>
                                            </li>
                                            <li class="m-menu__item " aria-haspopup="true" >
											<a  href="admdata.php" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text" style="font-weight: bold; font-family: helvetica;">
												<h5> Create New Connection	
													
											
											
											
											
											
											
											
											</h5>
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
												<a  href="logs6.php" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text" style="font-weight: bold; font-family: helvetica;">
													 <h5> Log Table </h5>
													</span>
												</a>
                                            </li>
                    
										</ul>								
							</li>
								
							
							
							
							
							
							 
						</ul>
					</div>
					<!-- END: Aside Menu -->
				</div>
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title m-subheader__title--separator">



								



									Replace Connection
								</h3>
							</div>
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
					<div id="myModal1" class="modal"  draggable="true" scrolling="yes" style="overflow:auto">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header" style="    background-color: #212529;">
	<span class="close" style="margin-left:975px;">&times;</span>
	<h2></h2>
  </div>
  <div class="modal-body">
		  <p align="center">Hop Route </p>
		  <center>
			  <p id="ld"></p>
		   </div>
  <!--<div class="modal-footer">
	<h3>Modal Footer</h3>
  </div>-->
</div>

</div>
						<div class="row">
							<div class="col-lg-6">
								<!--begin::Portlet-->
								<div class="m-portlet__foot m-portlet__foot--fit">
										<div class="m-form__actions m-form__actions">
											<form method="post">
																							
</form>
										</div>
								</div>
								<section>
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
												
													USER 1
												</h3>
											</div>
										</div>
									</div>
									<!--begin::Form-->
									
									<form class="m-form" method="post">
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<div class="form-group m-form__group <?php echo (!empty($Ext_err)) ? 'has-error' : ''; ?>">
														<label for="example_input_full_name" style="font-weight: bold; font-family: helvetica;">
																Extension Number:
															</label>
															<input type="text" name="ext1" id="ext1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -35px;" placeholder="" onchange="update(this.value); return false;" >
                                                            <span class="help-block" style="color:red;font:6px">
												</div>




												<div id="e1" name="e1">
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Name and room number:
														   </label>
														   <input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""   disabled> 
														   
												</div>
				

												<div class="form-group m-form__group" style=" margin-top: 2px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica; ">
																Location Node :
														   </label>
														   <input type="text" name="location" id="location" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""   disabled>
												</div>
												<div class="form-group m-form__group"  style=" margin-top: 4px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Shelf Address :
														   </label>
														   <input type="text" name="saddress" id="saddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""   disabled>
												</div>
												<div class="form-group m-form__group" style=" margin-top: 4px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Board Address :
														   </label>
														   <input type="text" name="baddress" id="baddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""   disabled>
												</div>
												<div class="form-group m-form__group" style=" margin-top: 6px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Equipment Address :
														   </label>
														   <input type="text" name="eaddress" id="eaddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""   disabled>
												</div>
												<div class="form-group m-form__group" style=" margin-top: 6px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Block Name  :
														   </label>
														   <input type="text" name="block" id="block" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>

												<div class="form-group m-form__group" style=" margin-top: 6px;">
														<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica;">Exchange</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable1" id="cable1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color1" id="color1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset>
					
												</div>

												<div class="form-group m-form__group"  style=" margin-top: -16px;">
														<!--<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica;">Ad Hoc</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																		Location:
																	</label>
														
																	<input type="text" name="location1" id="location1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
														<br>		
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable2" id="cable2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color2" id="color2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset>-->
														<!--	<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Hop Information
														   </label>
														   <input type="hidden" name='data1' value="<?php echo $row['Ext_No']?>"  />
										<button type="submit" class="btn btn-info btn-sm" name="data" id="data" style="color:black; background-color:white;border-color:gray" onclick="delv('<?php echo $row['Ext_No']?>'); return false;">View</button>
-->

					
												</div>
												<div class="form-group m-form__group"  style=" margin-top: 2px;">
														<fieldset style= "border :TRUE">
																<legend  style="font-weight: bold; font-family: helvetica; ">Subscriber</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable3" id="cable3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color3" id="color3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset>
					
												</div>
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Telephone Type :
														   </label>
														   <input type="text" name="type" id="type" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>

												<div class="form-group m-form__group" >
														<label for="example_input_full_name" style="margin-left: 1px; margin-top:-250px; font-family: helvetica; font-weight: bold;">
															 Comments:
														</label>
													
													</div>
														<div>
															<textarea  placeholder="" style="size: 100%; margin-left:180px; height: 80px; width: 210px; margin-top: -38px"  name="cmt" type="text" class="txt_3" disabled></textarea>
																														
														</div>

												
											</div>
										</div>
										
									
		</div>
									<!--end::Form-->
								</div>
								
								
								<!--end::Portlet-->
		<!--begin::Portlet-->
								
								<!--end::Portlet-->
							</div>
							<div class="col-lg-6">
								<!--begin::Portlet-->
								
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text">
													USER 2
												</h3>
											</div>
										</div>
									</div>
									<!--begin::Form-->
								
									
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												
												<div class="form-group m-form__group <?php echo (!empty($Ext_err)) ? 'has-error' : ''; ?>">
														<label for="example_input_full_name" style="font-weight: bold; font-family: helvetica;">
																Extension Number:
															</label>
															<input type="text" name="ext2" id="ext" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -35px;" placeholder="" onchange="update1(this.value); return false" required >
                                                            <span class="help-block" style="color:red;font:6px">

												</div>
												<div id="e2" name="e2">
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Name and room number :
														   </label>
														   <input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>
												</br>
												<div class="form-group m-form__group" >
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica; ">
																Location Node :
														   </label>
														   <input type="text" name="location" id="location" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top:-33px" placeholder="" value=""  disabled>
												</div>
</br>
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Shelf Address :
														   </label>
														   <input type="text" name="saddress" id="saddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>
</br>
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Board Address :
														   </label>
														   <input type="text" name="baddress" id="baddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>
												</br>
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Equipment Address :
														   </label>
														   <input type="text" name="eaddress" id="eaddress" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>
												</br>
												<div class="form-group m-form__group">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Block Name  :
														   </label>
														   <input type="text" name="block" id="block" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>
												</br>
												<div class="form-group m-form__group">
														<fieldset style= "border :TRUE">
																<legend style="font-weight: bold; font-family: helvetica;">Exchange</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable1" id="cable1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>
															
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color1" id="color1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset>
					
												</div>
												</br>
												<div class="form-group m-form__group">
														<!--<fieldset style= "border :TRUE">
																<legend style="font-weight: bold; font-family: helvetica;">Ad Hoc</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																		Location:
																	</label>
														
																	<input type="text" name="location1" id="location1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
														<br>		
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable2" id="cable2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color2" id="color2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset> -->
					
												</div>
												<div class="form-group m-form__group"style="margin-top: 2spx;">
														<fieldset style= "border :TRUE">
																<legend style="font-weight: bold; font-family: helvetica;">Subscriber</legend>
																<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																	Cable No:
																</label>
													
																<input type="text" name="cable3" id="cable3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>
													<br>		
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																	Color Code:
																</label>
																<input type="text" name="color3" id="color3" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" disabled>

															</fieldset>
					
												</div>

												<div class="form-group m-form__group" style="margin-top: 20px;">
														<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																Telephone Type :
														   </label>
														   <input type="text" name="type" id="type" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value=""  disabled>
												</div>

												<div class="form-group m-form__group" style="margin-top: 38px;">
														<label for="example_input_full_name" style="margin-left: 1px; margin-top:-250px; font-family: helvetica; font-weight: bold;">
															 Comments:
														</label>
													
													</div>
														<div>
															<textarea  placeholder="" style="size: 100%; margin-left:180px; height: 80px; width: 210px; margin-top: -38px"  name="cmt" type="text" class="txt_3" disabled></textarea>
																														
														</div>


											</div>
											
										</div>
									
									
		</div>
	
								</div>
								<!--end::Portlet-->
</section>








							</div>



							<form method="post">
										<button type="submit" class="btn btn-primary"style="postion:static; margin-left:500px; margin-top:10px" value="Submit">Swap</button>
</form>		<!--end::Form-->
</form>
							
						</div>
						
					</div>
				</div>
			</div>
			<!-- end:: Body -->
<!-- begin::Footer -->
			<footer class="m-grid__item		m-footer ">
				<div class="m-container m-container--fluid m-container--full-height m-page__container">
					<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
						<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
							<span class="m-footer__copyright">
								TIFR
								
							</span>
						</div>
						
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
    		        <!-- begin::Quick Sidebar -->
		
		<!-- end::Quick Sidebar -->		    
	    <!-- begin::Scroll Top -->
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->		    <!-- begin::Quick Nav -->
		
		<!-- begin::Quick Nav -->	
    	<!--begin::Base Scripts -->
		<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
	</body>
	<!-- end::Body -->
</html>
