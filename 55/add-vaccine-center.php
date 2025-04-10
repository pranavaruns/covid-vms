<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
 $novaccen=$_POST['novaccen'];
 $vaccenadd=$_POST['vaccenadd'];
 $state=$_POST['state'];
 $city=$_POST['city'];
 $pincode=$_POST['pincode'];
$sql="insert into tblvaccinecenter(Nameofvaccinecenter,CenterAddress,State,City,Pincode)values(:novaccen,:vaccenadd,:state,:city,:pincode)";
$query=$dbh->prepare($sql);
$query->bindParam(':novaccen',$novaccen,PDO::PARAM_STR);
$query->bindParam(':vaccenadd',$vaccenadd,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':city',$city,PDO::PARAM_STR);
$query->bindParam(':pincode',$pincode,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Center of vaccine has been added.")</script>';
echo "<script>window.location.href ='add-vaccine-center.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Add Vaccine Center</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="add-vaccine-center.php" class="tip-bottom">Add Vaccine Center</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Add Vaccine Center</h5>
          </div>
          <div class="widget-content nopadding">
            <form method="post" class="form-horizontal">
              
              <div class="control-group">
                <label class="control-label">Name of Vaccine Center :</label>
                <div class="controls">
                   
                   <input type="text" class="span11" name="novaccen" id="novaccen"required='true'>
                </div>
              </div>
             <div class="control-group">
                <label class="control-label">Vaccine Center Address :</label>
                <div class="controls">
                   <input type="text" class="span11" name="vaccenadd" id="vaccenadd"required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">State :</label>
                <div class="controls">
                   <input type="text" class="span11" name="state" id="state"required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">City :</label>
                <div class="controls">
                   <input type="text" class="span11" name="city" id="city"required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Pincode :</label>
                <div class="controls">
                 
                   
                   <input type="text" class="span11" name="pincode" id="pincode"required='true'>
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