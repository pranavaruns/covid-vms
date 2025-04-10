<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Covid Vaccination Management System || Reports of Vaccination Application</title>
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="between-dates-report.php" class="current">Reports of Vaccination Application</a> </div>
    
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title">
             <span class="icon"><i class="icon-th"></i></span> 
            <h5>Reports of Vaccination Application</h5>
          </div>
          <div class="container-fluid">            
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="widget-content nopadding">
            <form method="post" class="form-horizontal" action="between-date-reports-details.php">
              
              <div class="control-group">
                <label class="control-label">From Date :</label>
                <div class="controls">
                 
                   <input type="date" class="span11" id="fromdate" name="fromdate" value="" required='true'>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">To Date :</label>
                <div class="controls">
                 
                  <input type="date" class="span11" id="todate" name="todate" value="" required='true'></div>
                </div>
                <div class="form-actions">
                <button type="submit" class="btn btn-success" name="submit">Submit</button>
              </div>
              </div>
             
              
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
