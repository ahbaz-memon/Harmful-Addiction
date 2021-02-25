<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{
if(isset($_POST['send']))
{
	$ssn=$_POST['ssn'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$designation=$_POST['designation'];
	$salary = $_POST['salary'];
	$contact = $_POST['contact'];
	$hired_date = $_POST['hired_date'];
	$rehab_id = $_POST['rehab_id'];
	$sql="INSERT INTO rehab_doctor(ssn,fname,lname,designation,salary,contact,hired_date,rehab_id) VALUES(:ssn,:fname,:lname,:designation,:salary,:contact,:hired_date,:rehab_id)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':ssn',$ssn,PDO::PARAM_STR);
	$query->bindParam(':fname',$fname,PDO::PARAM_STR);
	$query->bindParam(':lname',$lname,PDO::PARAM_STR);
	$query->bindParam(':designation',$designation,PDO::PARAM_STR);
	$query->bindParam(':salary',$salary,PDO::PARAM_STR);
	$query->bindParam(':contact',$contact,PDO::PARAM_STR);
	$query->bindParam(':hired_date',$hired_date,PDO::PARAM_STR);
	$query->bindParam(':rehab_id',$rehab_id,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$error="Something went wrong. Please try again";
	}
	else
	{
	$msg="Values Submitted Succesfully!";
	}

}
if(isset($_POST['delete']))
{
	$ssn=$_POST['ssn'];
	$sql = "DELETE FROM rehab_doctor WHERE ssn='$ssn'";
	$query = $dbh->prepare($sql);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$error="Something went wrong. Please try again";
	}
	else
	{
	$msg="Values deleted Succesfully!";
	}


}
  if(isset($_POST['update']))
    {
 $ssn=$_POST['ssn'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$designation=$_POST['designation'];
	$salary = $_POST['salary'];
	$contact = $_POST['contact'];
	$hired_date = $_POST['hired_date'];
	$rehab_id = $_POST['rehab_id'];
	$sql="UPDATE rehab_doctor SET fname='$fname',lname='$lname',designation='$designation',salary='$salary',contact='$contact',hired_date='$hired_date' WHERE rehab_id='$rehab_id'";

  $query = $dbh->prepare($sql);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();

  if($lastInsertId)
  {
  $error="Something went wrong. Please try again";
  }
  else
  {
  $msg="Data Updated Succesfully!";
  }
  }
 

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="theme-color" content="#3e454c">

  <title>DDMS|Admin Dashboard</title>

  <!-- Font awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Sandstone Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Bootstrap Datatables -->
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <!-- Bootstrap social button library -->
  <link rel="stylesheet" href="css/bootstrap-social.css">
  <!-- Bootstrap select -->
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <!-- Bootstrap file input -->
  <link rel="stylesheet" href="css/fileinput.min.css">
  <!-- Awesome Bootstrap checkbox -->
  <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
  <!-- Admin Stye -->
  <link rel="stylesheet" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Drug Data Management System</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/modern-business.css" rel="stylesheet">
    <style>
    .navbar-toggler {
        z-index: 1;
    }

    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }
    </style>

</head>

<body>

    <!-- Navigation -->
<?php include('includes/header.php');?>
<?php include('includes/slider.php');?>

    <!-- Page Content -->
    <div class="container">
	
        <h1><a href="./dashboard.php">Welcome to Drug Data Management System</a></h1>


        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-8 mb-15">

                <div class="card">
                    <h4 class="card-header">Know all Doctors</h4>
                    <p class="card-text" style="padding-left:2%">Physical Medicine and Rehabilitation (PM&R), also known as physiatry, is a medical specialty that involves restoring function for a person who has been disabled as a result of a disease, disorder, or injury.</p>    </div>

      </div>
        </div>

<p>
</p>
</div>

        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
            <th>#</th>
            <th>SSN</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Designation</th>
            <th>Salary</th>
            <th>Email-id</th>
            <th>Hired</th>
            <th>Rehab-id</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>#</th>
            <th>SSN</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Designation</th>
            <th>Salary</th>
            <th>Email-id</th>
            <th>Hired</th>
            <th>Rehab-id</th>
            </tr>
            </tr>
          </tfoot>
          <tbody>

        <?php $sql = "SELECT * from rehab_doctor";
        $query = $dbh -> prepare($sql);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $result)
        {				?>
            <tr>
              <td><?php echo htmlentities($cnt);?></td>
              <td><?php echo htmlentities($result->ssn);?></td>
              <td><?php echo htmlentities($result->fname);?></td>
              <td><?php echo htmlentities($result->lname);?></td>
              <td><?php echo htmlentities($result->designation);?></td>
              <td><?php echo htmlentities($result->salary);?></td>
              <td><?php echo htmlentities($result->contact);?></td>
              <td><?php echo htmlentities($result->hired_date);?></td>
              <td><?php echo htmlentities($result->rehab_id);?></td>
        </tr>
            <?php $cnt=$cnt+1; }} ?>

          </tbody>
        </table>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<br><br><br><br>
<h2> INSERT DATA</h2>
<form name="sentMessage"  method="post">
		<div class="control-group form-group">
				<div class="controls">
						<label>SSN</label>
						<input type="text" class="form-control" id="ssn" name="ssn" required data-validation-required-message="Please enter your ssn">
						<p class="help-block"></p>
				</div>
		</div>

			<div class="control-group form-group">
					<div class="controls">
							<label>fname</label>
							<input type="text" class="form-control" id="fname" name="fname" required data-validation-required-message="Please enter your fname">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>lname</label>
							<input type="text" class="form-control" id="lname" name="lname" required data-validation-required-message="Please enter your lname">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>designation</label>
							<input type="text" class="form-control" id="designation" name="designation" required data-validation-required-message="Please enter your designation">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>salary</label>
							<input type="text" class="form-control" id="salary" name="salary" required data-validation-required-message="Please enter your salary">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>contact</label>
							<input type="text" class="form-control" id="contact" name="contact" required data-validation-required-message="Please enter your contact">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>hired date</label>
							<input type="text" class="form-control" id="hired_date" name="hired_date" required data-validation-required-message="Please enter your hired date">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>rehab id</label>
							<input type="text" class="form-control" id="rehab_id" name="rehab_id" required data-validation-required-message="Please enter your rehab id">
							<p class="help-block"></p>
					</div>
			</div>
					<button type="submit" name="send"  class="btn btn-primary">Insert</button>
					
		</form>
<br><br><br><br><br>		
<h2> DELETE DATA</h2>
<form name="sentMessage"  method="post">
		<div class="control-group form-group">
				<div class="controls">
						<label>SSN</label>
						<input type="text" class="form-control" id="ssn" name="ssn" required data-validation-required-message="Please enter your ssn">
						<p class="help-block"></p>
				</div>
		</div>
		<button type="submit" name="delete"  class="btn btn-primary">Delete</button>
</form>

<br><br><br><br>
<h2> UPDATE DATA</h2>
<form name="sentMessage"  method="post">
		<div class="control-group form-group">
				<div class="controls">
						<label>SSN</label>
						<input type="text" class="form-control" id="ssn" name="ssn" required data-validation-required-message="Please enter your ssn">
						<p class="help-block"></p>
				</div>
		</div>

			<div class="control-group form-group">
					<div class="controls">
							<label>fname</label>
							<input type="text" class="form-control" id="fname" name="fname" required data-validation-required-message="Please enter your fname">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>lname</label>
							<input type="text" class="form-control" id="lname" name="lname" required data-validation-required-message="Please enter your lname">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>designation</label>
							<input type="text" class="form-control" id="designation" name="designation" required data-validation-required-message="Please enter your designation">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>salary</label>
							<input type="text" class="form-control" id="salary" name="salary" required data-validation-required-message="Please enter your salary">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>contact</label>
							<input type="text" class="form-control" id="contact" name="contact" required data-validation-required-message="Please enter your contact">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>hired date</label>
							<input type="text" class="form-control" id="hired_date" name="hired_date" required data-validation-required-message="Please enter your hired date">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>rehab id</label>
							<input type="text" class="form-control" id="rehab_id" name="rehab_id" required data-validation-required-message="Please enter your rehab id">
							<p class="help-block"></p>
					</div>
			</div>
					<button type="submit" name="update"  class="btn btn-primary">update</button>
					
		</form>


<?php include('includes/footer.php');?>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/tether/tether.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

                    <!-- /.row -->
</body>

</html>
<?php } ?>
