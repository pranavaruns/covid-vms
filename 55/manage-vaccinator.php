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
$sql="delete from tblvaccinator where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage-vaccinator.php'</script>";     


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Manage Vaccinator</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage-vaccinator.php" class="current">Manage Vaccinator</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Manage Vaccinator</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" style="font-size: 15px;">
              <thead>
                <tr >
                  <th style="font-size: 15px;">S.No</th>
                  <th style="font-size: 15px;">Center Name</th>
                  <th style="font-size: 15px;">Name of Vaccinator</th>
                  <th style="font-size: 15px;">Employee ID</th>
                  <th style="font-size: 15px;">Creation Date</th>
                  <th style="font-size: 15px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
$sql="SELECT tblvaccinator.ID as vid,tblvaccinator.VaccinationCenterID,tblvaccinator.EmpID,tblvaccinator.Name,tblvaccinator.CreationDate,tblvaccinecenter.ID,tblvaccinecenter.Nameofvaccinecenter from tblvaccinator join tblvaccinecenter on tblvaccinecenter.ID=tblvaccinator.VaccinationCenterID  ";
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
                                    <td><?php  echo htmlentities($row->Nameofvaccinecenter);?></td>
                                    <td><?php  echo htmlentities($row->Name);?></td>
                                    <td><?php  echo htmlentities($row->EmpID);?></td>
                                    <td><?php  echo htmlentities($row->CreationDate);?></td>
                                    <td><a class="btn btn-sm btn-primary" href="edit-vaccinator-details.php?editid=<?php echo htmlentities ($row->vid);?>">Edit</a> <a class="btn btn-sm btn-primary" href="manage-vaccinator.php?delid=<?php echo ($row->vid);?>"  onclick="return confirm('Do you really want to Delete ?');">Delete</a></td>
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
