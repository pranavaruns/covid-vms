<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$vaccentid=$_POST['vaccentid'];
$empid=$_POST['empid'];
$name=$_POST['name'];
$mobnum=$_POST['mobnum'];
$email=$_POST['email'];
$address=$_POST['address'];
$noofexp=$_POST['noofexp'];
$joiningdate=$_POST['joiningdate'];
$password=md5($_POST['password']);
$ret="select Email from tblvaccinator where Email=:email || MobileNumber=:mobnum || EmpID=:empid";
 $query= $dbh -> prepare($ret);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{

$sql="insert into tblvaccinator(VaccinationCenterID,EmpID,Name,MobileNumber,Email,Address,NoofExp,JoiningDate,Password)values(:vaccentid,:empid,:name,:mobnum,:email,:address,:noofexp,:joiningdate,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':vaccentid',$vaccentid,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':noofexp',$noofexp,PDO::PARAM_STR);
$query->bindParam(':joiningdate',$joiningdate,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Vaccinator detail has been added.")</script>';
echo "<script>window.location.href ='add-vaccinator.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
else
{

echo "<script>alert('Email-id,Employee Id or Mobile Number already exist. Please try again');</script>";
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Add Vaccinator</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />

</head>
<body>

<?php include_once('includes/header.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-vaccinator.php" class="tip-bottom">Add Vaccinator</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Add Vaccinator</h5>
          </div>
          <div class="widget-content nopadding">
            <form method="post" class="form-horizontal">
              
              <div class="control-group">
                <label class="control-label">Select Vaccine Center</label>
                <div class="controls">
                  <select name="vaccentid" class="span11" id="vaccentid" required='true'>
                    <option value="">Choose Center</option>
                    <?php
$sql="SELECT * from tblvaccinecenter";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
  <option value="<?php  echo htmlentities($row->ID);?>"><?php  echo htmlentities($row->Nameofvaccinecenter);?></option>
  <?php $cnt=$cnt+1;}} ?>
                  </select>
                </div>
              </div>
             <div class="control-group">
                <label class="control-label">Employee ID :</label>
                <div class="controls"> 
                   <input type="text" class="span11" name="empid" id="empid" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Name :</label>
                <div class="controls">
                   <input type="text" class="span11" name="name" id="name" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number :</label>
                <div class="controls">
                   <input type="text" class="span11" name="mobnum" id="mobnum" required='true' pattern="[0-9]+" maxlength="10">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email :</label>
                <div class="controls">
                   <input type="email" class="span11" name="email" id="email" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Address :</label>
                <div class="controls">
                   <textarea type="text" class="span11" name="address" id="address" required='true'></textarea>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Number of Experience :</label>
                <div class="controls">
                   <input type="text" class="span11" name="noofexp" id="noofexp" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Joining Date :</label>
                <div class="controls">
                   <input type="date" class="span11" name="joiningdate" id="joiningdate" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password :</label>
                <div class="controls">
                   <input type="password" class="span11" name="password" id="password" required='true'>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success" name="submit">Add</button>
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.form_common.js"></script>
</body>
</html>
<?php }  ?>