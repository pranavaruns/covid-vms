<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['cvmsuid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
  $uid=$_SESSION['cvmsuid'];
  $patient=$_POST['patient'];
  $name=$_POST['name'];
  $mobnum=$_POST['mobnum'];
  $idproof=$_POST['idproof'];
  $idnumber=$_POST['idnumber'];
  $vaccentype=$_POST['vaccentype'];
  $vaccencenter=$_POST['vaccencenter'];
  $dateofvaccine=$_POST['dateofvaccine'];
  $idnumber=$_POST['idnumber'];
  $bookslot=$_POST['bookslot'];
  $dose=$_POST['dose'];
  $bookingnum=mt_rand(100000000, 999999999);
  $sql="insert into tblvaccinationbooking(UserID,BookingNumber,Patient,Name,MobileNumber,IdentityProof,IdentityNumber,VaccineType,VaccineCenterid,DateofVaccination,BookingSlots,Dose)values(:uid,:bookingnum,:patient,:name,:mobnum,:idproof,:idnumber,:vaccentype,:vaccencenter,:dateofvaccine,:bookslot,:dose)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->bindParam(':bookingnum',$bookingnum,PDO::PARAM_STR);
$query->bindParam(':patient',$patient,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':idproof',$idproof,PDO::PARAM_STR);
$query->bindParam(':idnumber',$idnumber,PDO::PARAM_STR);
$query->bindParam(':vaccentype',$vaccentype,PDO::PARAM_STR);
$query->bindParam(':vaccencenter',$vaccencenter,PDO::PARAM_STR);
$query->bindParam(':dateofvaccine',$dateofvaccine,PDO::PARAM_STR);
$query->bindParam(':bookslot',$bookslot,PDO::PARAM_STR);
$query->bindParam(':dose',$dose,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your vaccination slot has been book succeffuly.")</script>';
echo "<script>window.location.href ='vaccination-form.php'</script>";
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
<title>Covid Vaccination Management System || Vaccination Booking Form</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="vaccination-form.php" class="tip-bottom">Vaccination Booking Form</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Vaccination Booking Form</h5>
          </div>
          <div class="widget-content nopadding">
            <form method="post" class="form-horizontal">
              
              <div class="control-group">
                <label class="control-label">Add Patient :</label>
                <div class="controls">
                   <select name="patient" id="patient" required='true'>
                    <option value="">Choose Patient</option>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Daughter">Daughter</option>
                     <option value="Self">Self</option>
                     <option value="Others">Others</option>
                    <select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Name :</label>
                <div class="controls">
                 
                  <input type="text" class="span11" name="name"  class="form-control" required="true">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number :</label>
                <div class="controls">
                   <input type="text" class="span11" name="mobnum" id="mobnum" required='true' pattern="[0-9]+" maxlength="10">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Goverment ID Proof :</label>
                <div class="controls">
                   <select name="idproof" id="idproof" required='true'>
                    <option value="">Choose ID Proof</option>
                    <option value="Aadhar Card">Aadhar Card</option>
                    <option value="Voter Card">Voter Card</option>
                    <option value="Driving License">Driving License</option>
                     <option value="Passport">Passport</option>
                     <option value="Others">Others</option>
                    <select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">ID Number :</label>
                <div class="controls">
                  <input type="text" class="span11" name="idnumber"  class="form-control" required="true">
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Select Vaccine Type</label>
                <div class="controls">
                  <select name="vaccentype" id="vaccentype" required='true'>
                    <option value="">Choose Vaccine Type</option>
                   <?php
$sql="SELECT * from tblvaccinetype";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
  <option value="<?php  echo htmlentities($row->VaccineType);?>"><?php  echo htmlentities($row->VaccineType);?></option>
  <?php $cnt=$cnt+1;}} ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Select Vaccine Center</label>
                <div class="controls">
                  <select name="vaccencenter" id="vaccencenter" required='true'>
                    <option value="">Choose Vaccine Center</option>
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
                <label class="control-label">Date of Vaccine :</label>
                <div class="controls">
                  <input type="date" class="span11" name="dateofvaccine"  class="form-control" required="true">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Book Slot :</label>
                <div class="controls">
                   <select name="bookslot" id="bookslot" required='true'>
                    <option value="">Choose Your Slot</option>
                    <option value="10 am to 12 pm">10 am to 12 pm</option>
                    <option value="12 pm to 2 pm">12 pm to 2 pm</option>
                    <option value="2 pm to 4 pm">2 pm to 4 pm</option>
                     <option value="4 pm to 6 pm">4 pm to 6 pm</option>
                    <select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Dose :</label>
                <div class="controls">
                  
                  <select name="dose" id="dose" required='true'>
                    <option value="">Choose Your Dose</option>
                    <option value="First Dose">First Dose</option>
                    <option value="Second Dose">Second Dose</option>
                    <option value="Booster Dose">Booster Dose</option>
                  </select>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
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