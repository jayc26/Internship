<?php
session_start();
require_once 'includes/config.php';

									if (!isset($_SESSION['username'])){

										header("location: login.php");
									
									
									}
									$role=$_SESSION['Role'];

if($role=="User")
{
	echo"<script>window.location.assign('tabledata4.php');</script>";
}

/*if(isset($_POST['data']))
										 {
										$data="Hi";
				echo "<script> disp1('$data');</script>";
			}*/
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
											 //$cc=$row['Colorcode'];
											 //$cn=$row['Cableno'];
											 $type=$row['Type'];
											 $cmt=$row['Comments'];
											 $ln=$row['LNode'];
										 $sa=$row['SAdd'];
										 $ba=$row['BAdd'];
										 $ea=$row['EAdd'];
										 $ecn=$row['ECN'];
										 $ecc=$row['ECC'];
										 $scn=$row['SCN'];
										 $scc=$row['SCC'];
											 //var_dump($een);
											 //var_dump($name);
											
											$_SESSION['extno'] = $een;
											$_SESSION['name'] = $name;
											$_SESSION['blockname'] = $bname;
											$_SESSION['ECN'] = $ecn;
											$_SESSION['ECC'] = $ecc;
											$_SESSION['Type'] = $type;
											$_SESSION['Comments'] = $cmt;
											$_SESSION['ln'] = $ln;
											$_SESSION['sa'] = $sa;
											$_SESSION['ba'] = $ba;
											$_SESSION['ea'] = $ea;
											$_SESSION['SCN'] = $scn;
											$_SESSION['SCC'] = $scc;
											//$_SESSION['sf'] = $sf;
											
										/*	echo '<script type="text/javascript">',
													'f1();',
													'</script';*/
													header("Location: edit4.php");
											 }
											 ?>
<!DOCTYPE html>
<html lang="en" >
	<head>

	<script>


											





		function Ce(ex) {
				

				var a=   confirm("Are you sure you want to delete?");
				
								if(a==true)
								{
									
									
									
							
									
									
									var reason=prompt("reason for delete ext number");
									
									
									if (reason!=null && reason!="") 
									{
										
											var data = {
												reason: reason,
												ex: ex
											};
				
											
											
											$.post("reason.php",data);
											alert('Record Deleted Successfully');
											window.location.assign("tabledata4.php");	
										
									}
								}
								else{
								return false;
								}
				}
		</script>
		<meta charset="utf-8" />
		<title>
				TIFR TELEPHONE DATA Table
		</title>
		<meta name="description" content="Datatable HTML table">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
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
var modal = document.getElementById('myModal');
var modal1 = document.getElementById('myModal1');
//$('#mymodal1').draggable();
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span1 = document.getElementsByClassName("close")[1];
// When the user clicks the button, open the modal 
$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal1.style.display = "none";
		}
	});
	$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal.style.display = "none";
		}
	});
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
	//modal1.style.display = "none";
}
span1.onclick = function() {
  //modal.style.display = "none";
	modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
	if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
}

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
function dis(ex)
{
	var modal = document.getElementById('myModal');
	var btn = document.getElementById('myBtn3');
	modal.style.display = "block";
	$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal.style.display = "none";
		}
	});
	
	btn.onclick = function() {
		var reason=document.getElementById('txt1').value;
		
									
									
									if (reason!=null && reason!="") 
									{

											var data = {
												reason: reason,
												ex: ex
											};
				
											
											
											$.post("reason.php",data);
											alert('Record Deleted Successfully');
											window.location.assign("tabledata4.php");	
										
									}
									return false;
									
}
return false;
}

function disp1(x)
{
	var modal = document.getElementById('myModal1');
	//$('#mymodal1').draggable();
	$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal1.style.display = "none";
		}
	});
	var l=	document.getElementById('ld');
	modal.style.display = "block";
	l.innerHTML=x;
}


function dis2(ex)
{
	var modal = document.getElementById('myModal');
	var btn = document.getElementById('myBtn3');
	modal.style.display = "block";
	$(document).on('keyup',function(evt){
		if(evt.keyCode==27)
		{
			modal.style.display = "none";
		}
	});
	btn.onclick = function() {
		var reason=document.getElementById('txt1').value;
		
									
									
									if (reason!=null && reason!="") 
									{
										//alert(ex);
										//alert(reason);
											var data = {
												reason: reason,
												ex: ex
											};
				
											
											
											$.post("reason.php",data);
											$("#td_" + ex).fadeOut('slow' );
		alert('Record Deleted Successfully');
		modal.style.display="none";
											
											
										
									}
									return false;
									
}
return false;
}
</script>

		
		
		
		<script type="text/javascript">








		

function delData(ex) {

	var a=   confirm("Are you sure you want to delete?");
				if(a==true)
				{
					
					//var ex= document.getElementById("Ext").value;
					
					//alert(ex[0]);
					
					
					var reason=prompt("reason for delete ext number");
					
					//console.log("reason value" +reason);
					if (reason!=null && reason!="") 
					{
	
	$.post("reason.php" , {ex: ex, reason: reason} , function(data){
		//data.preventDefault();
		$("#td_" + ex).fadeOut('slow' );
		alert('Record Deleted Successfully');
							//window.location.assign("tabledata1.php");
		
	});		
	//console.log("clickclick");
					}
	return false;
    }
	
	function delData1(ex) {
	
	$.post("del.php" , {sid:ex} , function(data){
		//data.preventDefault();
		//alert("IN!");
		$("#btn_" + ex).fadeOut('slow' );
		
		
	}).done(function(data){
		alert(data+"WORKINGNAH");
	});	
	//console.log("clickclick");
	

    }

       /* function myb() {
            var a = document.getElementById('del');
            var r = document.getElementById('edit');
          
           //var a = sel1.options[sel1.selectedIndex];
           
                a.style.display ="none";
               // alert("HELLO");
                r.style.display ="none";
               // p.style.display="block";
            }*/
}
            
           
        </script>
		<script>
		/*	$(".d").on('load', function()
			{
				var tex= $(this).data('id')

			}
			);*/


		</script>
		
		
		<script>
function update(str)
   {
      var xmlhttp;

      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }	

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","ulog3.php?opt="+str, true);
      xmlhttp.send();
  }







			/*function f1()
			{
				window.location.replace("form11.php");
			}*/
			 function showHint(str) {
    if (str.length == 0) { 
		//document.getElementById("txtHint").style.margin-left="300px";
        var a=document.getElementById("txtHint").innerHTML = "<span style='margin-left:300px;font-size:16px'>No results found. <br/><a href='tabledata4.php' style='margin-left:250px; margin-top:200px'>Back to Data Table or Search Again. </a></span>";
		//a.style.margin-left="300px";
		
		
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "search3.php?q=" + str, true);
        xmlhttp.send();
    }
}

</script>
		

		<script type="text/javascript">
		/*	function show()
			{	
				var a= confirm("are you sure?");
				
				console.log("a value"+a);
				if (a == true)
				
				{	
					var reason=prompt("reason for delete ext number");
					console.log("reason value" +reason);
					if (reason!=null && reason!="") 
					{
						<?php
										/*		$reason= $_POST['reason'];
								              $query="Insert into 'teledata' (reason) values('"+$reason+"')";
								              mysqli_query($conn, $query);*/
						?>
					}
					

				}
				else
				{	
					return false;
					/*console.log();*/
					
			/*	}
			}*/
			

			
		</script>
	
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="" />
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
										<label style="color:White; font-size:55px; font-style: italic; font-variant:small-caps; font-weight:bold; font-family:helvetica ">TIFR</label>
									<a href="index.html" class="m-brand__logo-wrapper">
										<!--<img alt="" src="imgs/tifr_logo.png" height="80" width="118"/>-->
										
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
													
												</span>
											</a>
											<div class="m-dropdown__wrapper">
												<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
												<div class="m-dropdown__inner">
												<div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
																<img src="icons/images11.png" class="m--img-rounded m--marginless" alt="" style= "height: 70px"/>
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
																<!--<li class="m-nav__item">
																	<a href="logs.php" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					Log Table
																				</span>
																				
																			</span>
																		</span>
																	</a>
																</li>-->
																
																<!--<li class="m-nav__item">
															
																	<a href="" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-share"></i>
																		<span class="m-nav__link-text">
																			ACT
																		</span>
																	</a>
									
																</li>-->
									
															<!--	<li class="m-nav__item">
																	<a href="../../../header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-chat-1"></i>
																		<span class="m-nav__link-text">
																			Messages
																		</span>
																	</a>
																</li> -->
															<!--	<li class="m-nav__separator m-nav__separator--fit"></li>
																<li class="m-nav__item">
																	<a href="../../../header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-info"></i>
																		<span class="m-nav__link-text">
																			FAQ
																		</span>
																	</a>
																</li>-->
															<!--	<li class="m-nav__item">
																	<a href="../../../header/profile.html" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-lifebuoy"></i>
																		<span class="m-nav__link-text">
																			Support
																		</span>
																	</a>
																</li>-->
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
		 m-menu-scrollable="0" m-menu-dropdown-timeout="500"  >
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							
							<li class="m-menu__section">
							<h5 class="m-menu__section-text" style="font-family:helvetica;font-weight:bold;">
									Components
								</h5>
								<i class="m-menu__section-icon flaticon-more-v3"></i>
							</li>
							<!--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								
								
							</li>-->
							<!--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
								<a  href="form11.php" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-share"></i>
									<span class="m-menu__link-text"style=" font-size:14px; font-family:helvetica">
										Add New Record
									</span>
								</a>
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="../../../components/icons/flaticon.html" class="m-menu__link ">
											<a  href="form11.php" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													create new connection
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="../../../components/icons/fontawesome.html" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													a2
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="form11.php" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													a3
												</span>
											</a>
										</li>
										
									</ul>
								</div>
							</li>-->


							<li class="m-menu__item  m-menu__item--submenu m-menu__item--open m-menu__item--expanded" aria-haspopup="true"  m-menu-submenu-toggle="hover">
						<!--	<a  href="javascript:;" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-share"></i>
									<span class="m-menu__link-text"style=" font-size:14px; font-family:helvetica">
										Add New Record
									</span>
								</a>-->
								<div class="m-menu__submenu ">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="admdata.php" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text" style="font-weight: bold; font-family: helvetica;">
												<h5> Create New Connection	 </h5>
												</span>
											</a>
										</li>
										<li class="m-menu__item " aria-haspopup="true" >
											<a  href="admswap.php" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text" style="font-weight: bold; font-family: helvetica;">
												 <h5> Swap Connection </h5>
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
								</div>	
							
							
							
							
							
							
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
								<h3 class="m-subheader__title m-subheader__title--separator" style="font-family:helvetica">
							

								
<!-- The Modal -->
<div id="myModal" class="modal" >

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header" style="    background-color: #212529;">
      <span class="close" style="margin-left:975px;">&times;</span>
      <h2></h2>
    </div>
    <div class="modal-body">
			<p align="center">Enter Reason For Deleting </p>
			<center>
			<textarea id="txt1" rows="4" cols="50"></textarea><br> <br> 
			<button type="submit" id="myBtn3" class="btn btn-primary"style="margin-left:10px; width:100px"  value="Submit">Okay</button>    </center>
    </div>
    <!--<div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>-->
  </div>

</div>
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


									Telephone Datatable
								</h3>
							</div>
							<div>
							
							</div>
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						
						<div class="m-portlet m-portlet--mobile">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
									<h3 class="m-portlet__head-text"style="font-family:helvetica">
										Employee Data 
									</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="m-portlet__nav">
										<li class="m-portlet__nav-item">
																		</li>
									</ul>
								</div>
							</div>
							<div class="m-portlet__body">
								<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30" >
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center"style="margin-top:-44px">
												<div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label>
																
															</label>
														</div>
														<div class="m-form__control">
															
														</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4">
													<div class="m-form__group m-form__group--inline">
														<div class="m-form__label">
															<label class="m-label m-label--single">
																
															</label>
														</div>
														<div class="m-form__control">
																													</div>
													</div>
													<div class="d-md-none m--margin-bottom-10"></div>
												</div>
												<div class="col-md-4" style="margin-left:800px;margin-top:10px">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch" onkeyup="showHint(this.value)">
														
														<span class="m-input-icon__icon m-input-icon__icon--left">

											
														<span>
																<i class="la la-search"></i>
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 order-1 order-xl-2 m--align-right">
											
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
									</div>
								</div>
								<!--end: Search Form -->
		<!--begin: Datatable -->
		<?php
		
		
		

       

        if (isset($_GET['pageno'])) { 
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 10;
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

									<div  class="table-hover"style="overflow-x:auto;" id="txtHint">
									<?php	if($offset+10>$total_rows)
									{?>
										<label>Displaying <?php echo $total_rows?> of <?php echo $total_rows?> Records</label>
								<?php	}
								else{
									?>
										<label>Displaying <?php echo $offset+10?> of <?php echo $total_rows?> Records</label>
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
									</div>
									<ul class="pagination" style="margin-left:800px">
									<li><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
</ul>
<div class="m-form__group m-form__group--inline" style="position:float;width:10%;margin-top:-50px;">
													
													<div class="m-form__control">
													<label>Records Per Page</label>
													<select  class="form-control" id="nrc" name="nrc" onchange=update(this.value);>
																	<option value="10">10</option>
																	<option value="50">50</option>
																	<option value="100">100</option>
																	<option value="200">200</option>
																</select>
														
													</div>
												</div>
								<!--end: Datatable -->
							</div>
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
								2019 &copy; 
								<a href="" class="m-link">
										TIFR
								</a>
							</span>
						</div>
						
					</div>
				</div>
			</footer>
			<!-- end::Footer -->
		</div>
		<!-- end:: Page -->
    		        <!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close">
					<i class="la la-close"></i>
				</span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">
							Messages
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" 		data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">
							Settings
						</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">
							Logs
						</a>
					</li>
				</ul>
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
        <!--begin::Page Resources -->
		<script src="assets/demo/default/custom/components/datatables/base/html-table.js" type="text/javascript"></script>
		<!--end::Page Resources -->
	</body>
	<!-- end::Body -->
</html>
