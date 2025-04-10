<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tblvaccinetype where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage-vaccine-type.php'</script>";     


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Registered Users Details</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
</head>
<body>

<?php include_once('includes/header.php');?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="reg-users.php" class="current">Registered Users Details</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Registered Users Details</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" style="font-size: 15px;">
              <thead>
                <tr>
                                  <th>S.No</th>
                                        <th>Full Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Date of Registration</th>
                                        <th>Action</th>
                                     
                                            </tr>
              </thead>
              <tbody>
                 <?php
$sql="SELECT * from tbluser";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                <tr class="gradeX">
                  <td><?php echo htmlentities($cnt);?></td>
                                       
                                        <td><?php  echo htmlentities($row->FullName);?></td>
                                        <td><?php  echo htmlentities($row->MobileNumber);?></td>   <td><?php  echo htmlentities($row->Email);?></td>         
                                        <td><?php  echo htmlentities($row->RegDate);?></td>
                                        <td><a href="user-vaccination-request.php?userid=<?php  echo htmlentities($row->ID);?>&&uname=<?php  echo htmlentities($row->FullName);?>" class="btn btn-success" target="_blank">View Vaccination Request</td>
                                      
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
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.tables.js"></script>
</body>
</html><?php }  ?>
