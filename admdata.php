
		<?php 
		session_start();
		if (!isset($_SESSION['username']))
		{
		
			header("location: login.php");
		
		
		}
		$role=$_SESSION['Role'];
		
		if($role=="User")
		{
			echo"<script>window.location.assign('adddata5.php');</script>";
		}
		// Include config file
		require_once 'includes/config.php';
		// Define variables and initialize with empty values
		
		$blockname=$cable=$colorcode=$extno=$uname=$type="";
$blockname_err=$uname_err=$type_err=$Ext_err=$colorcode_err=$cable_err=$Oth_err="";
if(isset($_POST['save']))
{
	if(empty(trim($_POST['uname'])))
      {
        $uname_err = "Please Enter valid Username/Room";
      }
      else
      {
        $uname = mysqli_real_escape_string($conn,$_POST["uname"]);
      }
      if(empty(trim($_POST['ext'])))
      {
      $Ext_err = "Please Enter valid Extension number";
      } 
         
			$extno=$_POST['ext'];
			if(($extno[0]!=='A') and ($extno[0]!=='2')  and ($extno[0]!=='3') and ($extno[0]!=='4'))
	 {
		 $Ext_err="Extension Number Must start with 2,3,4 or A";
	 
 
	 }
	 elseif(strlen($extno) != 4)
	 {
		 $Ext_err="Extension Number must be of length 4.";
	 }
	 else{}




	if(($extno[0] !== '2' or $extno[0] !== '3' or $extno[0] !== '3' or $extno[0] !== 'A') and strlen($extno) > 4) 
	 {
		 
		 
	 $Ext_err="Invalid Extension number. Use starting value 2,3,4 or A only.";
		 
	 } 
	 else{
		 //echo"Success";
	 }
	 
	 
 
	 $ext_check_query = "SELECT * FROM teledata WHERE Ext_No='$extno' LIMIT 1";
	 $result = mysqli_query($conn, $ext_check_query);
	 $user = mysqli_fetch_assoc($result);
	 if ($user) { // if user exists
		 if ($user['Ext_No'] === $extno) {
			 $Ext_err = "Extension Already Exist";
		 }
 
		 } 
			$blockname=$_POST['block'];
			//$colorcode=$_POST['color'];
			$cmt=mysqli_real_escape_string($conn,$_POST["cmt"]); 
			$ln=$_POST['ln'];
			$sa=$_POST['sa'];
			$ba=$_POST['ba'];
			$ea=$_POST['ea'];
			$ecn=$_POST['c1'];
			$ecc=$_POST['cc1'];
			$scn=$_POST['cable2'];
			$scc=$_POST['color2'];
			//$cable=$_POST['cable'];
			//echo "<script>alert('$ecn $ecc $scn $scc')</script>";
			$type=mysqli_real_escape_string($conn,$_POST["type"]); 
			//$cno=count($cable);
			//$color=$_POST['color'];
			//$cable=$_POST['cable'];
			if(empty($_POST['cable']))
      {
        //$uname_err = "Please Enter valid Username/Room";
      }
      else
      {
			
				$cable=$_POST['cable'];
				$cno=count($cable);
				$color=$_POST['color'];
				$lc=$_POST['location'];
				$i=1;
			if($cno>0)
			{
				while((list(,$color)= each($_POST['color'])) && (list(,$cable)= each($_POST['cable'])) && (list(,$lc)= each($_POST['location'])))
				{
					//echo "<script>alert('$cable')</script>";
					if(empty($cable) or empty($color) or empty($lc))
					{
						$_SESSION['aex']=$extno;
						$_SESSION['an']=$uname;
						$_SESSION['aln']=$ln;
						$_SESSION['asa']=$sa;
						$_SESSION['aba']=$ba;
						$_SESSION['aea']=$ea;
						$_SESSION['abn']=$blockname;
						$_SESSION['aecn']=$ecn;
						$_SESSION['aecc']=$ecc;
						$_SESSION['ascn']=$scn;
						$_SESSION['ascc']=$scc;
						$_SESSION['at']=$type;
						$_SESSION['acm']=$cmt;
						echo "<script>alert('Wrong Hop Information');window.location.assign('adddata5.php');</script>";
						exit();
						
					}
				
				}
			}
		

				$cable1=$_POST['cable'];
				$cno1=count($cable);
				
				$color1=$_POST['color'];
				$lc1=$_POST['location'];
				$i=1;
				while((list(,$color1)= each($_POST['color'])) && (list(,$cable1)= each($_POST['cable'])) && (list(,$lc1)= each($_POST['location'])))
				{
				    //echo"<script> alert('color1'); </script>";
						$q1="insert into hops(Ext_No,BlockName,LNode,Cableno,ColorCode,hopno,TCount) values('$extno','$blockname','$lc1','$cable1','$color1','$i','$cno1')";
                        mysqli_query($conn, $q1);
                        $i++;
                        
					}
			
				//echo"<script>alert('$color');</script>";
				//echo"<script>alert('$cable');</script>";
			
		
	
			}
		/*	if(empty($_POST['color']))
      {
        //$uname_err = "Please Enter valid Username/Room";
      }
      else
      {
				$color=$_POST['color'];
				if(count($color)>0){
					foreach($color as $co)
					{
						echo"<script>alert('$co');</script>";
					}
				}
				
			}*/
		
		//$color=$_POST['color'];
	
		$aname=$_SESSION['username'];
	$d=date("Y-m-d h:i:sa");
	//echo "<script>alert('$d');</script>";
		$type=mysqli_real_escape_string($conn,$_POST["type"]); 
		
		if(empty($uname_err) && empty($Ext_err) && empty($type_err) && empty($blockname_err) && empty($colorcode_err) && empty($type_err) && empty($Ext_err) && empty($cable_err))
		{
			$query="insert into teledata(Ext_No,BlockName,Uname,LNode,SAdd,BAdd,EAdd,ECC,ECN,SCC,SCN,Type,Comments) values('$extno','$blockname','$uname','$ln','$sa','$ba','$ea','$ecc','$ecn','$scc','$scn','$type','$cmt')";
			mysqli_query($conn, $query);
			$query1="insert into logdata(Ext_No,BlockName,Uname,LNode,SAdd,BAdd,EAdd,ECC,ECN,SCC,SCN,Type,Action,Reason,Aname,Timestamp) values('$extno','$blockname','$uname','$ln','$sa','$ba','$ea','$ecc','$ecn','$scc','$scn','$type','Inserted','$cmt','$aname','$d')";
			mysqli_query($conn, $query1);
			//echo"<script> alert('Entered'); </script>";
			if (isset($_SESSION['aex']))
		{
			unset($_SESSION['aex']);
		}
		if (isset($_SESSION['an']))
		{
			unset($_SESSION['an']);
		}
		if (isset($_SESSION['aln']))
		{
			unset($_SESSION['aln']);
		}
		if (isset($_SESSION['asa']))
		{
			unset($_SESSION['asa']);
		}
		if (isset($_SESSION['aba']))
		{
			unset($_SESSION['aba']);
		}
		if (isset($_SESSION['aea']))
		{
			unset($_SESSION['aea']);
		}
		if (isset($_SESSION['abn']))
		{
			unset($_SESSION['abn']);
		}
		if (isset($_SESSION['aecn']))
		{
			unset($_SESSION['aecn']);
		}
		if (isset($_SESSION['aecc']))
		{
			unset($_SESSION['aecc']);
		}
		if (isset($_SESSION['ascn']))
		{
			unset($_SESSION['ascn']);
		}
		if (isset($_SESSION['ascc']))
		{
			unset($_SESSION['ascc']);
		}
		if (isset($_SESSION['at']))
		{
			unset($_SESSION['at']);
		}
		if (isset($_SESSION['acm']))
		{
			unset($_SESSION['acm']);
		}

		}
		

	
	else{
		echo"<script> alert('Wrong Hop Values'); </script>";
	}
	echo"<script>alert('Record Inserted Successfully');window.location.assign('adddata5.php');</script>";
			

	}
		?>











<?php

//$blockname_err=$uname_err=$type_err=$Ext_err=$colorcode_err=$cable_err=$Oth_err="";



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
<style>
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

</style>
		<script type="text/javascript">
			/*	function validationform()
			{
				var extno=document.getElementById('Extno').value;
			var letters='/^[A-Z]/';
				var roomno=document.getElementById('Roomno').value;
				var cableno=document.getElementById('Cableno').value;
				var blockno=document.getElementById('Blockno').value;
				var colorcode=document.getElementById('Colorcode').value;
				var radio=document.getElementById('Radio').checked;
				

				if(extno==null || extno=="")
				
				{
					document.getElementById('exte').innerHTML="please enter valid extention no";

					return false;

				}
				else { document.getElementById('exte').innerHTML=""; }


				if(extno.length != 4) 
				{
					document.getElementById('exte').innerHTML="extention no length must be 4";
					return false;
				}
				else {document.getElementById('exte').innerHTML="";}

				if ((extno.charAt(extno.length-4)!='A' ) && (extno.charAt(extno.length-4)!= '2') && (extno.charAt(extno.length-4)!= '3') )
				{
					document.getElementById('exte').innerHTML="extention no must start with 'A','2' or '3' ";
					return false;

				}
				else {document.getElementById('exte').innerHTML="";} 

				




			/*	if (roomno==null || roomno=="") 
				{
					document.getElementById('roomNo').innerHTML="please enter valid room no";
					return false;
				}

				else{document.getElementById('roomNo').innerHTML="";}

				if (cableno=="Select one Menu") 
				{
					document.getElementById('cableNo').innerHTML="please select cable no";
					return false;
				}
				else{document.getElementById('cableNo').innerHTML="";}
				
				if (blockno=="Select one Menu") 
				{
					document.getElementById('blockNo').innerHTML="please select block no";
					return false;
				}
				else{document.getElementById('blockNo').innerHTML="";}


				if (colorcode=="Select one Menu") 
				{
					document.getElementById('colorCode').innerHTML="please select color code";
					return false;
				}
				else{document.getElementById('colorCode').innerHTML="";}

				if (!radio == true) 
				{
					document.getElementById('radioButton').innerHTML="please check one connection";
					return false;
				}
				else{document.getElementById('radioButton').innerHTML="";}
				return (true);

			}*/


			/*	function validationform()
			{
				var extno1=document.getElementById('ext').value;
			var letters='/^[A-Z]/';
				var roomno1=document.getElementById('Roomno').value;
				var cableno1=document.getElementById('Cableno').value;
				var blockno1=document.getElementById('Blockno').value;
				var colorcode1=document.getElementById('Colorcode').value;
				var radio1=document.getElementById('Radio').checked;
				

				if(extno1!=null || extno1!="")
				{
					document.getElementById('exte').innerHTML="";
					return false;
				}
			

				if(extno1.length == 4) 
				{
					document.getElementById('exte').innerHTML="extention no length must be 4";
					return true;
				}
				if ((extno1.charAt(extno.length-4)!='A' ) && (extno1.charAt(extno.length-4)!= '2') && (extno1.charAt(extno.length-4)!= '3') )
				{
					document.getElementById('exte').innerHTML="extention no must start with 'A','2' or '3' ";
					return true;

				}
				

				/*if (roomno1!=null || roomno1!="") 
				{
					document.getElementById('roomNo').innerHTML="";
					return true;
				}
				if (cableno1!="Select one Menu") 
				{
					document.getElementById('cableNo').innerHTML="";
					return true;
				}

				if (blockno1!="Select one Menu") 
				{
					document.getElementById('blockNo').innerHTML="please select block no";
					return false;
				}
				if (colorcode1!="Select one Menu") 
				{
					document.getElementById('colorCode').innerHTML="please select color code";
					return false;
				}

				if (radio == true) 
				{
					document.getElementById('radioButton').innerHTML="please check one connection";
					return false;
				}
			}*/
				

		</script>

<script>


function ol()
				{
					document.getElementById('ccode1').style.display ='none';
  document.getElementById('uname1').style.display ='none';
	document.getElementById('other').style.display ='none';
	document.getElementById("add1").style.display='none';
				}

				function show1(){
					document.getElementById('ccode1').style.display ='block';
  document.getElementById('uname1').style.display ='block';
}
function show2(){
  document.getElementById('uname1').style.display = 'block';
	document.getElementById('ccode1').style.display ='none';
}

function show3(v){

	//var e= document.getElementById("color");
	
	//var v= e.options[e.selectedIndex].value;
	//var t= e.options[e.selectedIndex].text;
	//var a = color.selectedIndex.text;
	
					if(v=="Other")
					{
					document.getElementById('other').style.display ='block';
					
					}
					else{
						document.getElementById('other').style.display ='none';
						//alert("YOYO");
					}
					
					//document.getElementById('other').style.display ='block';
  //document.getElementById('uname1').style.display ='block';
}

function update(str,str1)
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

      xmlhttp.open("GET","cc.php?opt="+str+"&cn="+str1, true);
      xmlhttp.send();
  }


	function update1(str)
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
          document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","cn.php?opt="+str, true);
      xmlhttp.send();
  }



	function update14(str)
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
          document.getElementById("uhide").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","info.php?opt="+str, true);
      xmlhttp.send();
  }








  function checkext(str)
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
          document.getElementById("eerr").innerHTML = xmlhttp.responseText;
        }
      }

      xmlhttp.open("GET","cext.php?opt="+str, true);
      xmlhttp.send();
  }

function d()
{
	var ex=document.getElementById("ext").value;
	var n=document.getElementById("uname").value;
	var ln=document.getElementById("ln").value;
	var sa=document.getElementById("sa").value;
	var ba=document.getElementById("ba").value;
	var ea=document.getElementById("ea").value;
	var b=document.getElementById("block").value;
	var c1=document.getElementById("cable1").value;
	var cc1=document.getElementById("color1").value;
	var c2=document.getElementById("cable2").value;
	var cc2=document.getElementById("color2").value;
	var t=document.getElementById("type").value;
	var c=document.getElementById("cmt").value;
	if(ex!="" && n!="" && ln!="" && sa!="" && ba!="" && ea!="" && b!="" && c1!="" && cc1!="" && c2!="" && cc2!="" && t!="" && c!="" )
	{
		if(ln!="0")
	{
	var da=document.getElementById("add2");


if(da.style.display=='none')
	{
		//alert("hello25");
		//da.parentNode.removeChild(da);
		$( ".hel7" ).remove();
		//da.remove();
	//	$("#add2").empty();
	}
	}
}
}



function validate()
{
	var e= document.getElementById("block");
    var v= e.options[e.selectedIndex].value;
	var t= e.options[e.selectedIndex].text;
var c= document.getElementById("txtHint1").lastChild;
var v1= c.options[c.selectedIndex].value;

//var n=document.getElementById("n2");
//var n1=n.length;
//var loc=document.getElementById("loc").value;
//var cab=document.getElementById("cab").value;
//var col=document.getElementById("col").value;
var x = document.getElementsByClassName("hop");
var i;
alert("Hey");
for (i = 0; i < x.length; i++) {
	alert("in");
	alert(x[i]);
	return false;
	
}

//var co= document.getElementById("txtHint").lastChild;
//var v2= co.options[co.selectedIndex].value;
//alert(v1);
//var x=c.document.getElementById("cable");
//var v1=x.options[x.selectedIndex].value;
//alert(v1);
//var txt=c.options[e.selectedIndex].nodeValue;
//alert(txt);
	

	
    //var name = document.forms["myform"]["uname"];
    var name=document.getElementById("uname");
    //var cc = document.forms["myform"]["ccode"];
    var n1=name.value;
    
    //alert(n1);
    var cc=document.getElementById("ccode");
    var c1=cc.value;
   // alert(c1);
	
	//alert(n1);
	//var a = color.selectedIndex.text;
   // alert(v);
  




 if(cc.style.display=='block')
 {
  if(c1=="")
  {
    document.getElementById('cerr').innerHTML ="Please Enter Valid C-Code";
                    return false;

  }
 }
  if(n1=="")
  {
      //alert("HI");
					document.getElementById('nerr').innerHTML ="Please Enter Valid Name";
                    return false;

  }
    if(v=="Select Block Name")
					{
					document.getElementById('berr').innerHTML ="Please Select valid Block Name";
                    e.focus();
                    return false;
					
					}
					//alert(v1);
					if(v1=="Select Cable No")
					{
					document.getElementById('cnerr').innerHTML ="Please Select Valid Number";
				
   
                    //e.focus();
                    return false;
					
					}
					var co= document.getElementById("txtHint").lastChild;
var v2= co.options[co.selectedIndex].value;
//alert(v2);
if(v1!="Select Cable No")
{
if(v2=="Select Color Code")
					{
					document.getElementById('ccerr').innerHTML ="Please Select valid Color Code";
                   // cc.focus();
                    return false;
					
					}
}
				
   

                    return( true );

}



  



	</script>


<script>
	function hide1(e)
{
	
//l.style.display="none";
	//var ex=document.getElementById('exte').text;
	//alert(e);
	if(e="Extension Already Exist")
	{
	//alert("In!");
	document.getElementById('hide').style.display="none";
	document.getElementById('save').style.display="none";
	document.getElementById('cancel').style.display="none";
}
}
function hide2()
{
	document.getElementById('uname2').style.display="none";
	//document.getElementById('label').style.display="none";
	document.getElementById('hide').style.display="block";
	document.getElementById('save').style.display="block";
	document.getElementById('cancel').style.display="block";
}
function hide3(l)
{
	//alert(l);
	document.getElementById('label').style.display="none";
}





				var eid=0;

function myFunction9() {
	alert('in');
	eid++;
	var html= '<fieldset  name="personalia">'+
  'Name: <input type="text" name="username"><br>'+
  'Email: <input type="text" name="usermail"><br>'+
'</fieldset>';
alert(html);
addElement('add1','fieldset-'+eid,html);

}
function addElement(parentId, elementTag, elementId, html) {
	alert('hi');
    // Adds an element to the document
    var p = document.getElementById(parentId);
   var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;
		p.appendChild(newElement);
		

}

function b()
{
	var a=document.getElementById("add");
	var a1=document.getElementById("add1");
	var d=document.getElementById("add2");
	a.style.display="none";
	a1.style.display="block";
	d.style.display="block";
}



function a()
{
	var e=	document.getElementById('add1');
	var i = 1;
	var b=document.createElement('button');
	//var a=createAttribute('data-duplicate-remove','demo');
	//a.value="demo";
	//b.setAttributeNode(a);
	e.innerHTML = e.innerHTML +"  <div id='h' >     <fieldset style= 'border :TRUE'><legend>Hop</legend><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Location Node:</label><input type='text' name='location[]' id='lc' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''><br><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Cable No:</label><input type='text' name='cable[]' id='cadsaadsble' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''><br><label for='example_input_full_name'  style='font-weight: bold; font-family: helvetica;'>Color Code:</label><input type='text' name='color[]' id='cor' class='form-control m-input' style='width: 200px; margin-left: 180px; margin-top: -33px;' placeholder='' value=''/> </fieldset> <button data-duplicate-remove='demo'>-</button></div>";
	e.appendChild(b);
}
function remove()
{
	var list = document.getElementById("add1");
  list.removeChild(list.childNodes[0]);

}
function r1()
{
	alert('hello');
	$("#r1").remove(x);
}
</script>
	


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
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" onload="ol();">
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
							<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
					 <!---- 	<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
									<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
							
									</li>
								</ul>-->
							</div>
							<!-- END: Horizontal Menu -->						
									<!-- BEGIN: Topbar -->
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
													<div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
														<div class="m-card-user m-card-user--skin-dark">
															<div class="m-card-user__pic">
															<img src="icons/images11.png" class="m--img-rounded m--marginless" alt=""/>
															</div>
															<div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	<?php echo $_SESSION['username']; ?>
																</span>
																<!--<a href="" class="m-card-user__email m--font-weight-300 m-link">
																	mark.andre@gmail.com
																</a>-->
															</div>
														</div>
													</div>
													<div class="m-dropdown__body">
														<div class="m-dropdown__content">
															<ul class="m-nav m-nav--skin-light">
																		<!--<li class="m-nav__item">
																				<a href="logs.php" class="m-nav__link">
																					<i class="m-nav__link-icon flaticon-profile-1"></i>
																					<span class="m-nav__link-title">
																						<span class="m-nav__link-wrap">
																							<span class="m-nav__link-text">
																								Log Table
																							</span>
																							<span class="m-nav__link-badge">
																								
																							</span>
																						</span>
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
	<div id="m_ver_menu" 
		class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
		m-menu-vertical="1"
		 m-menu-scrollable="0" m-menu-dropdown-timeout="500"  >
						<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
							<!--<li class="m-menu__item " aria-haspopup="true" >
								<a  href="../../../index.html" class="m-menu__link ">
									<i class="m-menu__link-icon flaticon-line-graph"></i>
									<span class="m-menu__link-title">
										<span class="m-menu__link-wrap">
											<span class="m-menu__link-text" style="font-size:16px; font-family:helvetica">
												Dashboard
											</span>
											
										</span>
									</span>
								</a>
							</li>-->
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
								<h3 class="m-subheader__title m-subheader__title--separator"style="font-family:helvetica">
									Employee Data
								</h3>
								
							</div>
							
						</div>
					</div>
					<!-- END: Subheader -->
					
					
					<div class="m-content">
						<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="m-portlet">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
												<h3 class="m-portlet__head-text" style="font-family:helvetica">
													Add New Data
												</h3>
											</div>
										</div>
									</div>
									<!--begin::Form-->
									
									<form class="m-form" name="myform"  style="margin-left: 300px;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit = "return(validate());">

									
										<div class="m-portlet__body">
											<div class="m-form__section m-form__section--first">
												<div class="form-group m-form__group  <?php echo (!empty($Ext_err)) ? 'has-error' : ''; ?>">
													<label for="example_input_full_name" style="font-weight: bold; font-family: helvetica;">
														Extension Number:
													</label>
													<?php 	if (isset($_SESSION['aex']))
		{

													?>
													<input type="text" name="ext" id="ext" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -35px;" placeholder="" onfocusout="checkext(this.value);hide2();" value="<?php echo $_SESSION['aex'] ?>" required>
		<?php } else{ ?>
                                                    <input type="text" name="ext" id="ext" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -35px;" placeholder="Enter Extention No" onfocusout="checkext(this.value);hide2();" required>
		<?php } ?>
                                                </div>
                                                <div id="eerr">
                                                    
																										</div>
																										<div id="uhide">
																										</div>
																										<br>

																		<div id="hide">

												<div class="m-form__group form-group  <?php echo (!empty($type_err)) ? 'has-error' : ''; ?>">
														<label for="" style="margin-left: 1px; font-family: helvetica; font-weight: bold;">
															Search By:
														</label>
														<div class="m-radio-list" style="margin-left:185px; margin-top:-25px" id="c">
															<label class="m-radio">
																<input type="radio"  name="sb" id="sb" value="C-Code" onclick="show1();">
																C-Code
																<span></span>
															</label>
															<label class="m-radio">
																<input type="radio"  name="sb" id="sb" value="Name" onclick="show2();" required>
																Name
																<span></span>
															</label>
															
														</div>
														
                                                    </div>                                    

																										<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														C-Code:
													</label>
													<input type="text" name="ccode" id="ccode" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="">
													
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="cerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
																								

												<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="uname1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														 Name and room number:
													</label>
													<?php 	if (isset($_SESSION['an']))
		{

													?>
													<input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['an']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed"  required>
	<?php	} else {?>
		<input type="text" name="uname" id="uname" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>						
	<?php } ?>	
																							</div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="nerr" name="nerr"><?php echo $uname_err; ?></span>
																								</div>
																								



																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Location Node
													</label>
												<?php	if (isset($_SESSION['aln']))
		{ ?>
													<input type="number" min="1" name="ln" id="ln" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['aln']?>" required>
		<?php } else{ ?>
			<input type="number" min="1" name="ln" id="ln" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" required>
		<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="lnerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
																								

																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Shelf Address
													</label>
													<?php	if (isset($_SESSION['asa']))
		{ ?>
													<input type="text" name="sa" id="sa" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['asa']?>" pattern="[A-Za-z0-9,./'`'@$%&]{1,}" title="Blankspace Not allowed" required>
													<?php } else{ ?>
														<input type="text" name="sa" id="sa" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&]{1,}" title="Blankspace Not allowed" required>
														<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="saerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
																								
																								
																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Board Address
													</label>
													<?php	if (isset($_SESSION['aba']))
		{ ?>
													<input type="text" name="ba" id="ba" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['aba']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
													<?php } else{ ?>
														<input type="text" name="ba" id="ba" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
														<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="baerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
																								


																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Equipment Address
													</label>
													<?php	if (isset($_SESSION['aea']))
		{ ?>
													<input type="text" name="ea" id="ea" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['aea']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
													<?php } else{ ?>
														<input type="text" name="ea" id="ea" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed"  required>
														<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="eaerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
																								

																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Block Name:
													</label>
													<?php	if (isset($_SESSION['abn']))
		{ ?>
													<input type="text" name="block" id="block" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['abn']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
													<?php } else{ ?>
														<input type="text" name="block" id="block" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
														<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="sterr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>

																							




																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ex" >
																								<fieldset style= "border :TRUE">
																									<legend>Exchange</legend>
																									<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																										Cable No:
																									</label>
																									<?php	if (isset($_SESSION['aecn']))
		{ ?>
																									<input type="text" name="c1" id="cable1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['aecn']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																									<?php } else{ ?>
																										<input type="text" name="c1" id="cable1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																										<?php } ?>
																									<br>			<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																										Color Code:
																									</label>
																									<?php	if (isset($_SESSION['aecc']))
		{ ?>
																									<input type="text" name="cc1" id="color1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['aecc']?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																									<?php } else{ ?>
																										<input type="text" name="cc1" id="color1" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																										<?php } ?>
																								</fieldset>
																								
                                              	<button  name= "add" id="add" class="btn btn-primary" style="postion:static;margin-left:550px; margin-top :-210px;" onclick="b(); return false;">+</button>                                                 
																								<button  name= "add1" id="add1" class="btn btn-primary" style="postion:static;margin-left:550px; margin-top :-110px;" data-duplicate-add="demo" onclick="return false;">+</button>                                                 

																								
																								<!--	<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Entity Number
													</label>
													<input type="text" name="en" id="en" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" required>-->
													
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="enerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
									
																						
																								<div id="add2" style="display:none" class="hel7" style="margin-top: 200px;" >
																									<div data-duplicate="demo" data-duplicate-min="0" id="n2" class="hop" style="margin-top: 75px;" >
																								
																									<fieldset style= "border :TRUE">
																									<legend>Ad Hoc</legend>
																									<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																										Location Node
																									</label>
																						
																									<input type="text" name="location[]" id="loc" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" value="" placeholder="">
																						<br>	
																									<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																										Cable No:
																									</label>
																						
																									<input type="text" name="cable[]" id="cab" class="form-control m-input" style="width: 200px; margin-left: 182px; margin-top: -33px;" value="" placeholder="">
																						<br>			<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																										Color Code:
																									</label>
																									<input type="text" name="color[]" id="col" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" value="" placeholder="">

																								</fieldset>
																								<span class="help-block" style="color:red;font:6px" id="herr" name="herr"></span>
																							
																								<button  name= "can" id="remove" class="btn btn-danger"style="postion:static;margin-left:550px; margin-top :-250px;" value="remove" data-duplicate-remove="demo">-</button>
									</div>
																								</div>
		
																								<!--<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Set Function
													</label>
													<input type="text" name="sf" id="sf" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" required>
													
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="sferr" name="cerr"></span>
                                                </div>-->





											
												<?php
													$qbn="select * from cableno";
													$re=mysqli_query($conn,$qbn);
                                                    
													?>
                                                
												<!--<div class="form-group m-form__group  <?php echo (!empty($blockname_err)) ? 'has-error' : ''; ?>">
													<label for="example_input_full_name" style="margin-left: 1px; font-family: helvetica; font-weight: bold;">
														 Block Name:
													</label>
													
													<select class="form-control m-input" name="block" id="block" style="width: 200px; margin-left: 180px; margin-top: -40px; " onchange=update1(this.value);>
													<option selected> Select Block Name</option>
													<?php while($r=mysqli_fetch_array($re))
                                                        { ?>
													
														<option value="<?php echo $r['BlockName']?>"><?php echo $r['BlockName']?></option>
                                                        <?php } 
                                                        mysqli_close($conn); ?>
													   
													</select>
                                                </div>
                                                <div id="berr1">
                                                <span class="help-block" style="color:red;font:6px" id="berr"><?php echo $blockname_err; ?></span>
                                                </div>

												<div class="form-group m-form__group  <?php echo (!empty($cable_err)) ? 'has-error' : ''; ?>" id="txtHint1">
												
													
				
												</div>-->
												<div>
												<span class="help-block" style="color:red;font:6px" id="cnerr"><?php echo $cable_err; ?></span>
																												</div>


												<div class="form-group m-form__group  <?php echo (!empty($colorcode_err)) ? 'has-error' : ''; ?>" id="txtHint">
												
				
												</div>
												<div>
												<span class="help-block" style="color:red;font:6px" id="ccerr"><?php echo $colorcode_err; ?></span>
																												</div>                     

												<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="other">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														 Enter Other Color Code <br/> Combination:
													</label>
													<input type="text" name="occ" id="occ" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -45px;" placeholder="Other Combination">
													<span class="help-block" style="color:red;font:6px"><?php echo $uname_err; ?></span>
												</div>


												
												<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="sub"  style="margin-top: -50px;">
																								<fieldset style= "border :TRUE">
																									<legend>Subscriber</legend>
																									<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
																										Cable No:
																									</label>
																									<?php	if (isset($_SESSION['ascn']))
		{ ?>
																									<input type="text" name="cable2" id="cable2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['ascn'] ?>" pattern="[A-Za-z0-9,./'`'@$%&]{1,}" title="Blankspace Not allowed" required>
		<?php } else { ?>
			<input type="text" name="cable2" id="cable2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&]{1,}" title="Blankspace Not allowed" required>
		<?php } ?>
																									<br>		
																							<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">

																										Color Code:
																									</label>
																									<?php	if (isset($_SESSION['ascc']))
		{ ?>
																									<input type="text" name="color2" id="color2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['ascc'] ?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																									<?php } else { ?>
																										<input type="text" name="color2" id="color2" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
																										<?php } ?>
																								</fieldset>
													
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="enerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>



												

																								<div class="form-group m-form__group  <?php echo (!empty($uname_err)) ? 'has-error' : ''; ?>" id="ccode1">
													<label for="example_input_full_name"  style="font-weight: bold; font-family: helvetica;">
														Connection Type
													</label>
													<?php	if (isset($_SESSION['at']))
		{ ?>
													<input type="text" name="type" id="type" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="<?php echo $_SESSION['at'] ?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
													<?php } else { ?>
														<input type="text" name="type" id="type" class="form-control m-input" style="width: 200px; margin-left: 180px; margin-top: -33px;" placeholder="" value="" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed" required>
														<?php } ?>
                                                </div>
                                                <div>
                                                <span class="help-block" style="color:red;font:6px" id="eaerr" name="cerr"><?php echo $uname_err; ?></span>
																								</div>
												<div class="form-group m-form__group" >
													<label for="example_input_full_name" style="margin-left: 1px; margin-top:-250px; font-family: helvetica; font-weight: bold;">
														 Comments:
													</label>
												
												</div>
													<div>
													<?php	if (isset($_SESSION['acm']))
		{ ?>
														<textarea  placeholder="Comments Here" style="size: 100%; margin-left:180px; height: 80px; width: 210px; margin-top: -38px"  name="cmt"  id="cmt" type="text" class="txt_3" value="<?php echo $_SESSION['acm'] ?>" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed"><?php echo $_SESSION['ascc'] ?></textarea>
														<?php } else { ?>	
															<textarea  placeholder="Comments Here" style="size: 100%; margin-left:180px; height: 80px; width: 210px; margin-top: -38px"  name="cmt"  id="cmt" type="text" class="txt_3" pattern="[A-Za-z0-9,./'`'@$%&-]{1,}" title="Blankspace Not allowed"></textarea>
															<?php } ?>
													</div>
											</div>
										</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											
											<div class="m-form__actions m-form__actions" style="postion:float;margin-left:10px">
											
											<button type="submit" name= "save" id="save" class="btn btn-primary"style="postion:static;margin-left:10px" value="Submit" onclick="d();">submit</button>
											<div class="m-form__actions m-form__actions" style="postion:float;margin-left:60px;margin-top:-67px">
													<button type="reset" name="cancel" id="cancel" class="btn btn-secondary" style="postion:float;margin-left:20px">Cancel </button>
																																					
												</div>
												</div>
										</div>
																											
									</form>





																							

									<!--end::Form-->
								</div>
								<!--end::Portlet-->
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
								<!--<a href="" class="m-link">-->
									TIFR
								</a>
							</span>
						</div>
						<div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
							<ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
								
							</ul>
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
		
			<!--begin::Base Scripts -->

		

		<script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Base Scripts -->
	</body>
	<!-- end::Body -->
</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


<script src="jquery.duplicate.min.js"></script>
