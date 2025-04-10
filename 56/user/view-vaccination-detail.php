<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsuid']==0)) {
  header('location:logout.php');
  } else{
    

 
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
<script type="text/javascript">

function print1(strid)
{
if(confirm("Do you want to print?"))
{
var values = document.getElementById(strid);
var printing =
window.open('','','left=0,top=0,width=550,height=400,toolbar=0,scrollbars=0,sta­?tus=0');
printing.document.write(values.innerHTML);
printing.document.close();
printing.focus();
printing.print();

}
}
</script>
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
          <div class="widget-content nopadding" id="print2">
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
            <table class="table table-bordered data-table" style="font-size: 15px;" width="100%" border="1">
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
  <table class="table table-bordered data-table" style="font-size: 15px;" width="100%" border="1">
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
<table class="table table-bordered data-table" style="font-size: 15px;" id="print2" width="100%" border="1">
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
            <p style="text-align: center; padding-top: 30px"><input type="button"  name="printbutton" value="Print" class="btn btn-primary" onclick="return print1('print2')"/></p>
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
