<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $fname=$_POST['fname'];
    $uname=$_POST['uname'];
    $mobno=$_POST['mobno'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $ret="select Email,UserName from tbluser where Email=:email || UserName=:uname";
    $query= $dbh -> prepare($ret);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':uname',$uname,PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{
$sql="Insert Into tbluser(FullName,UserName,MobileNumber,Email,Password)Values(:fname,:uname,:mobno,:email,:password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':mobno',$mobno,PDO::PARAM_INT);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{

echo "<script>alert('You have successfully registered with us');</script>";
echo "<script>window.location.href ='login.php'</script>";
}
else
{

echo "<script>alert('Something went wrong.Please try again');</script>";
}
}
 else
{

echo "<script>alert('Email-id already exist. Please try again');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Covid Vaccination Management System || Registration Page</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../admin/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="../admin/css/maruti-login.css" />
        
    </head>
    <body>
        <div id="loginbox">            
            <form class="form-vertical" method="post">
				 <div class="control-group normal_text"> <h3><img src="../admin/img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Enter your full name" required="true" name="fname" value="" >
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" class="form-control" placeholder="Enter user name" required="true" name="uname" value="" >
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Enter your Mobile Number" required="true" name="mobno" value="" maxlength="10" pattern="[0-9]{10}">
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="email" placeholder="Enter your email id" required="true" name="email" value="" >
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" class="form-control" placeholder="Password" name="password" required="true" value="">
                        </div>
                    </div>
                </div>
               
                <div class="form-actions">
                    
                    <span class="pull-right"><input type="submit" class="btn btn-success" name="submit" value="Register" /></span>
                </div>
                <div class="form-actions">
                                    <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="login.php">Sign in</a></span>
                                  
                                </div>

            </form>
        </div>
        
        <script src="../admin/js/jquery.min.js"></script>  
        <script src="../admin/js/maruti.login.js"></script> 
    </body>

</html>
