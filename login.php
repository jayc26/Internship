<?php



session_start();
//$aname="";
$l_err="";
require_once 'includes/config.php';

// LOGIN USER
 
if (isset($_POST['login_user'])){
	//if($_SERVER["REQUEST_METHOD"] == "POST"){
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
//Var_dump($username);
  if (empty($username)) {
  	$l_err="Invalid Username";
  }
  if (empty($password)) {
  	$l_err="Invalid Password";
  }
  $query = "SELECT * FROM login_details WHERE Username = '$username' ";
	if($run_query = mysqli_query($conn, $query))
	{
			$count=mysqli_num_rows($run_query);
			if($count == 1){
				while($row = mysqli_fetch_assoc($run_query)){
					$uname = $row['Username'];
					$pwd = $row['Password'];
					$role=$row['Role'];
					
				}
				if(password_verify($password, $pwd)) {
					
					$_SESSION['username'] = $username;
					$_SESSION['Role']=$role;
					if($role=="User")
					{
					//echo "redirecting...";
					header("Location: tabledata4.php");
					}
					elseif($role=="Admin"){
						header("Location: admtable.php");
					}
					else{
						$l_err="Wrong Username or Password";
						//header("Location: login.php");
					}
					
					
				} else {
					$l_err="Wrong Username or Password";
					//var_dump($password);
					//header("Location: login.php");
				}
			} else {
				$l_err="Wrong Username or Password";
					//echo "Error";
			}
		} else {
			echo "Error";
		}
	}
   /* $query = "SELECT * FROM user_details WHERE Username = '$username'";  
           $result = mysqli_query($conn, $query);  
           if(mysqli_num_rows($result) > 0)  
           {  
	    Var_dump($username);
                while($row = mysqli_fetch_array($result))  
                {  
			
                     if(password_verify($password, $row["Password"]))  
                     {  
                          //return true;  
                         // $_SESSION["Username"] = $username;  
                          header("location:register_model.php");  
						  mysqli_close($conn);
						  echo 'lol';
                     }  
					
                     else  
                     {  
                          //return false;  
                          echo '<script>alert("Wrong User Details")</script>';  
                     }  
                } 
			echo 'lol';
           }  
           else  
           {  
                echo '<script>alert("Wrong User Details")</script>';  
           }  
		   
			echo 'Failed';
	}
 */
  /* 	$password = password_verify($password, $hash)
  	$query = "SELECT * FROM users WHERE Username='$username' AND Password='$password'";
  	$results = mysqli_query($conn, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
	  echo "Logged In";
  	  header('location: register_model.php');
  	}else {
  		echo "Wrong username and pass";
  	} */
?>

<!DOCTYPE html>

<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			TIFE | Login Page 
		</title>
		<meta name="description" content="Latest updates and statistic charts">
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
		<link rel="shortcut icon" href="assets/demo/default/media/img/logo/logo.png" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(assets/app/media/img//bg/bg-3.jpg);">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img src="assets/demo/default/media/img/logo/logo.png" height="120" width="180">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Sign In To Admin
								</h3>
							</div>
							<form class="m-login__form m-form" action="" method="post">
							<div>
								<center>
                                                <span class="help-block" style="color:red;font:6px" id="lerr" name="lerr"><?php echo $l_err; ?></span>
												</div>
		</center>
								<div class="form-group m-form__group">
									<input class="form-control m-input"   type="text" placeholder="Email" name="username" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary" style="background-color:darkturquoise" name="login_user">
										Sign In
									</button>
								</div>
							</form>
						</div>
						</div>
					
						
					</div>
				</div>
			</div>
		</div>

	</body>	
</html>
