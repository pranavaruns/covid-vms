<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsuid']==0)) {
  header('location:logout.php');
  } else{
     if(isset($_POST['submit']))
  {
    $uid=$_SESSION['cvmsuid'];
    $fname=$_POST['fname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $sql="update tbluser set FullName=:fname,MobileNumber=:mobilenumber,Email=:email where ID=:uid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':fname',$fname,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
echo '<script>alert("Profile has been updated")</script>';
echo "<script>window.location.href ='profile.php'</script>";   

  }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Profile</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="../admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../admin/css/colorpicker.css" />
<link rel="stylesheet" href="../admin/css/datepicker.css" />
<link rel="stylesheet" href="../admin/css/uniform.css" />
<link rel="stylesheet" href="../admin/css/select2.css" />
<link rel="stylesheet" href="../admin/css/maruti-style.css" />
<link rel="stylesheet" href="../admin/css/maruti-media.css" class="skin-color" />
</head>
<body>

<?php include_once('includes/header.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="profile.php" class="tip-bottom">User Profile</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>User Profile</h5>
          </div>
          <div class="widget-content nopadding">
            <form method="post" class="form-horizontal">
              <?php
$uid=$_SESSION['cvmsuid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
              <div class="control-group">
                <label class="control-label">Full Name :</label>
                <div class="controls">
                   <input type="text" class="span11" id="exampleTextInput1" name="fname" value="<?php  echo $row->FullName;?>" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">User Name :</label>
                <div class="controls">
                 
                  <input type="text" class="span11" id="email2" name="username" value="<?php  echo $row->UserName;?>" readonly="true">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email  :</label>
                <div class="controls">
                  <input type="email" class="span11" id="email2" name="email" value="<?php  echo $row->Email;?>" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contact Number :</label>
                <div class="controls">
                  <input type="text" class="span11" id="mobilenumber" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>" required='true' maxlength='10'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Registration Date:</label>
                <div class="controls">
                  <input type="text" class="span11" value="<?php  echo $row->RegDate;?>" readonly="true">
                  </div>
              </div>
              <?php $cnt=$cnt+1;}} ?>
              <div class="form-actions">
                <button type="submit" class="btn btn-success" name="submit">Change</button>
              </div>
            </form>
          </div>
        </div>
      </div>
     
    </div><hr>
    
  </div>
</div>
</div>
<?php include_once('includes/footer.php');?>
<script src="../admin/js/jquery.min.js"></script> 
<script src="../admin/js/jquery.ui.custom.js"></script> 
<script src="../admin/js/bootstrap.min.js"></script> 
<script src="../admin/js/bootstrap-colorpicker.js"></script> 
<script src="../admin/js/bootstrap-datepicker.js"></script> 
<script src="../admin/js/jquery.uniform.js"></script> 
<script src="../admin/js/select2.min.js"></script> 
<script src="../admin/js/maruti.js"></script> 
<script src="../admin/js/maruti.form_common.js"></script>
</body>
</html>
<?php }  ?>