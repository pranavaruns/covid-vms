<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsvid']==0)) {
  header('location:logout.php');
  } else{
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Vaccination Done</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="vaccination-done.php" class="current">Vaccination Done</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Vaccination Done</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" style="font-size: 15px;">
              <thead>
                <tr >
                  <th style="font-size: 15px;">S.No</th>
                  <th style="font-size: 15px;">Booking Number</th>
                  <th style="font-size: 15px;">Name</th>
                  <th style="font-size: 15px;">Mobile Number</th>
                  <th style="font-size: 15px;">Booking Date</th>
                  <th style="font-size: 15px;">Status</th>
                  <th style="font-size: 15px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $vcenid=$_SESSION['cvmsvcenid'];
$sql="SELECT * from tblvaccinationbooking where VaccineCenterid=:vcenid && Status='Vaccinated'";
$query = $dbh -> prepare($sql);
$query->bindParam(':vcenid',$vcenid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <tr class="gradeX">
                  <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php  echo htmlentities($row->BookingNumber);?></td>
                                    <td><?php  echo htmlentities($row->Name);?></td>
                                    <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                    <td><?php  echo htmlentities($row->DateofBooking);?></td>
                                     <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>         
                                   
                                    <td><a href="view-vaccination-detail.php?editid=<?php echo htmlentities ($row->ID);?>&&bookid=<?php echo htmlentities ($row->BookingNumber);?>" class="btn btn-primary">View</a></td>
                </tr><?php $cnt=$cnt+1;}} ?>
              
              </tbody>
            </table>
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
