<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsvid']==0)) {
  header('location:logout.php');
  } else{
    
if(isset($_POST['submit']))
  {
    
    $eid=$_GET['editid'];
    $bookid=$_GET['bookid'];
    $status=$_POST['status'];
   $remark=$_POST['remark'];
   $vacdoneby=$_SESSION['cvmsvid'];
      $sql= "update tblvaccinationbooking set VaccinationDoneby=:vacdoneby, Status=:status,Remark=:remark where ID=:eid";
    $query=$dbh->prepare($sql);
     $query->bindParam(':vacdoneby',$vacdoneby,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
 echo '<script>alert("Remark has been updated")</script>';
 echo "<script>window.location.href ='all-vaccination-booking.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || View Vaccination Details</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
<link rel="stylesheet" href="../admin/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../admin/css/uniform.css" />
<link rel="stylesheet" href="../admin/css/select2.css" />
<link rel="stylesheet" href="../admin/css/maruti-style.css" />
<link rel="stylesheet" href="../admin/css/maruti-media.css" class="skin-color" />
</head>
<body>

<?php include_once('includes/header.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage-vaccine-type.php" class="current">Manage Vaccine Type</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>View Vaccination Details of users</h5>
          </div>
          <div class="widget-content nopadding">
            <?php
                $eid=$_GET['editid'];
$sql="SELECT tblvaccinecenter.ID,tblvaccinecenter.Nameofvaccinecenter,tblvaccinecenter.CenterAddress,tblvaccinecenter.State,tblvaccinecenter.City,tblvaccinecenter.Pincode,tbluser.ID,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tbluser.RegDate,tblvaccinator.Name as vaccname,tblvaccinator.EmpID, tblvaccinationbooking.* from tblvaccinationbooking join tblvaccinecenter on tblvaccinecenter.ID=tblvaccinationbooking.VaccineCenterid 
join tbluser on tbluser.ID=tblvaccinationbooking.UserID 
left join tblvaccinator on tblvaccinator.ID=tblvaccinationbooking.VaccinationDoneby 
where tblvaccinationbooking.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
            <table class="table table-bordered data-table" style="font-size: 15px;">
              <tr>
    <th colspan="4" style="color: orange;font-size: 15px;">Register User Details</th>
   
  </tr>
  <tr>
    <th>Full Name</th>
    <td><?php  echo $row->FullName;?></td>
     <th>Mobile Number</th>
    <td><?php  echo $row->MobileNumber;?></td>
    
  </tr>
  <tr>
    <th>Email</th>
    <td><?php  echo $row->Email;?></td>
     <th>Registration Date</th>
    <td><?php  echo $row->RegDate;?></td>
    
  </tr>
  
  </table>
  <table class="table table-bordered data-table" style="font-size: 15px;">
<tr>
    <th colspan="4" style="color: orange;font-size: 15px;">Vaccination Center Details</th>
   
  </tr>
  <tr>
    <th>Vaccine Center Name</th>
    <td><?php  echo $row->Nameofvaccinecenter;?></td>
     <th>Address of Center</th>
    <td><?php  echo $row->CenterAddress;?>,<br><?php  echo $row->State;?>,<br><?php  echo $row->City;?>,<br><?php  echo $row->Pincode;?></td>
    
  </tr>
</table>
<table class="table table-bordered data-table" style="font-size: 15px;" id="print2">
  <tr>
    <th colspan="4" style="color: orange;font-size: 15px;">Vaccination Booking Number : <?php  echo $bookingno=($row->BookingNumber);?> </th>
  </tr>
  <tr>
    <th>Realtion with Regsitered User</th>
    <td><?php  echo $row->Patient;?></td>
     <th>Name</th>
    <td><?php  echo $row->Name;?></td>
    
  </tr>
  <tr>
    <th>MobileNumber</th>
    <td><?php  echo $row->MobileNumber;?></td>
     <th>IdentityProof</th>
    <td><?php  echo $row->IdentityProof;?></td>
  </tr> 
<tr>
    <th>IdentityNumber</th>
    <td><?php  echo $row->IdentityNumber;?></td>
     <th>VaccineType</th>
    <td><?php  echo $row->VaccineType;?></td>
    
  </tr>
<tr>
    <th>Date of Vaccination</th>
    <td><?php  echo $row->DateofVaccination;?></td>
     <th>Booking Slots</th>
    <td><?php  echo $row->BookingSlots;?></td>
    
  </tr>
  <tr>
    <th>Dose</th>
    <td><?php  echo $row->Dose;?></td>
     <th>Date of Booking</th>
    <td><?php  echo $row->DateofBooking;?></td>
    
  </tr>
  <tr>
    <th> Vaccination Final Status</th>
   <td> <?php  $status=$row->Status;
    
if($row->Status=="Vaccinated")
{
  echo "You have vaccinated";
}
if($row->Status=="")
{
  echo "Not Response Yet";
}


     ;?></td>
    <th>Admin Remark</th>
    <?php if($row->Remark==""){ ?>

                     <td  colspan="4"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } ?>  

  </tr>

  <tr>
    <th> Vaccination Done By</th>
   <?php if($row->VaccinationDoneby==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->vaccname);?>(<?php  echo htmlentities($row->EmpID);?>)
                  </td>
                  <?php } ?>
    <th>Vaccinated Date</th>
    <?php if($row->VaccinationDoneby==""){ ?>

                     <td  colspan="4"><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->UpdationDate);?>
                  </td>
                  <?php } ?>  

  </tr>
  
  <?php $cnt=$cnt+1;}} ?>
            </table>
            <?php 

if ($status==""){
?> 
<p align="center"  style="padding-top: 20px">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Take Action</button></p>  

<?php } ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                <form method="post" name="submit" class="form-horizontal">

                                
                               
     <tr>
    <th>Remark :</th>
    <td>
    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="span11" required="true"></textarea></td>
  </tr> 
  <tr>
    <th>Status :</th>
    <td>

   <select name="status" class="span11" required="true" >
     <option value="Vaccinated">Vaccinated</option>
   </select></td>
  </tr>
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Update</button>
  
  </form>
  

</div>

                      
                        </div>
                    </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('includes/footer.php');?>
<script src="../admin/js/jquery.min.js"></script> 
<script src="../admin/js/jquery.ui.custom.js"></script> 
<script src="../admin/js/bootstrap.min.js"></script> 
<script src="../admin/js/jquery.uniform.js"></script> 
<script src="../admin/js/select2.min.js"></script> 
<script src="../admin/js/jquery.dataTables.min.js"></script> 
<script src="../admin/js/maruti.js"></script> 
<script src="../admin/js/maruti.tables.js"></script>
</body>
</html><?php }  ?>
