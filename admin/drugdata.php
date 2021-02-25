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
	$drug_id=$_POST['drug_id'];
	$name=$_POST['name'];
	$trigger_time=$_POST['trigger_time'];
	$poison_name=$_POST['poison_name'];
	$poison_concentration =$_POST['poison_concentration'];
	$sql="INSERT INTO drug_data(drug_id,name,trigger_time,poison_name,poison_concentration) VALUES(:drug_id,:name,:trigger_time,:poison_name,:poison_concentration)";
	/*echo $drug_id;
	echo $name;
	echo $trigger_time;*/
	$query = $dbh->prepare($sql);
	$query->bindParam(':drug_id',$drug_id,PDO::PARAM_STR);
	$query->bindParam(':name',$name,PDO::PARAM_STR);
	$query->bindParam(':trigger_time',$trigger_time,PDO::PARAM_STR);
	$query->bindParam(':poison_name',$poison_name,PDO::PARAM_STR);
	$query->bindParam(':poison_concentration',$poison_concentration,PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	$error="Something went wrong. Please try again";
	}
	else
	{
	$msg="drug data Submitted Succesfully!";
	}

	}
	
	
if(isset($_POST['delete']))
{
	$drug_id=$_POST['drug_id'];
	$sql = "DELETE FROM drug_data WHERE drug_id='$drug_id'";
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
  $drug_id=$_POST['drug_id'];
	$name=$_POST['name'];
	$trigger_time=$_POST['trigger_time'];
	$poison_name=$_POST['poison_name'];
	$poison_concentration =$_POST['poison_concentration'];
  $sql="UPDATE drug_data SET name='$name',trigger_time='$trigger_time',poison_name='$poison_name',poison_concentration='$poison_concentration' WHERE drug_id='$drug_id'";

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
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>DDMS | Admin Dashboard</title>

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
</head>

<body>
<div class="container">

        <h1><a href="./dashboard.php">Welcome to Drug Data Management System</a></h1>
        </div>
<div class="row">
		<div class="col-lg-8 mb-15">

				<div class="card">
						<h4 class="card-header">Know All DRUGS</h4>
<p class="card-text" style="padding-left:2%">A drug is any substance (with the exception of food and water) which, when taken into the body, alters the body's function either physically and/or psychologically. Drugs may be legal (e.g. alcohol, caffeine and tobacco) or illegal (e.g. cannabis, ecstasy, cocaine and heroin). </p>
</div>
		</div>

</div>
</div>
<div>
<p>
</p>
</div>

<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
		<th>#</th>
			<th>Drug-id</th>
			<th>Drug Name</th>
			<th>Trigger Time</th>
			<th>Posison Name</th>
			<th>Posison Concentration</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
		<th>#</th>
		<th>Drug-id</th>
		<th>Drug Name</th>
		<th>Trigger Time</th>
		<th>Posison Name</th>
		<th>Posison Concentration</th>
		</tr>
		</tr>
	</tfoot>
	<tbody>

<?php $sql = "SELECT * from drug_data";
$query2 = $dbh -> prepare($sql);
$query2->execute();
$results=$query2->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query2->rowCount() > 0)
{
foreach($results as $result)
{				?>
		<tr>
			<td><?php echo htmlentities($cnt);?></td>
			<td><?php echo htmlentities($result->drug_id);?></td>
			<td><?php echo htmlentities($result->name);?></td>
			<td><?php echo htmlentities($result->trigger_time);?></td>
			<td><?php echo htmlentities($result->poison_name);?></td>
			<td><?php echo htmlentities($result->poison_concentration);?></td>
<td>
</tr>
		<?php $cnt=$cnt+1; }} ?>

	</tbody>
</table>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<br><br><br><br>
<h2> INSERT DATA</h2>
<form name="sentMessage"  method="post" action="drugdata.php">
		<div class="control-group form-group">
				<div class="controls">
						<label>drug_id</label>
						<input type="text" class="form-control" id="drug_id" name="drug_id" required data-validation-required-message="Please enter your drug_id">
						<p class="help-block"></p>
				</div>
		</div>

			<div class="control-group form-group">
					<div class="controls">
							<label>name</label>
							<input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Please enter your name">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>trigger_time</label>
							<input type="text" class="form-control" id="trigger_time" name="trigger_time" required data-validation-required-message="Please enter your trigger_time">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>poison_name</label>
							<input type="text" class="form-control" id="poison_name" name="poison_name" required data-validation-required-message="Please enter your poison_name">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>poison_concentration</label>
							<input type="text" class="form-control" id="poison_concentration" name="poison_concentration" required data-validation-required-message="Please enter your poison_concentration">
							<p class="help-block"></p>
					</div>
			</div>
					<button type="submit" name="send"  class="btn btn-primary">Insert</button>
		</form>
		<br><br><br><br><br>		
<h2> DELETE DATA</h2>
		<form name="sentMessage"  method="post" action="drugdata.php">
<label>DRUG ID</label>
						<input type="text" class="form-control" id="drug_id" name="drug_id" required data-validation-required-message="Please enter your drug_id">
						<p class="help-block"></p>
				</div>
		</div>
		<button type="submit" name="delete"  class="btn btn-primary">Delete</button>
</form>

<br><br><br><br>
<h2> UPDATE DATA</h2>
<form name="sentMessage"  method="post" >
		<div class="control-group form-group">
				<div class="controls">
						<label>drug_id</label>
						<input type="text" class="form-control" id="drug_id" name="drug_id" required data-validation-required-message="Please enter your drug_id">
						<p class="help-block"></p>
				</div>
		</div>

			<div class="control-group form-group">
					<div class="controls">
							<label>name</label>
							<input type="text" class="form-control" id="name" name="name" required data-validation-required-message="Please enter your name">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>trigger_time</label>
							<input type="text" class="form-control" id="trigger_time" name="trigger_time" required data-validation-required-message="Please enter your trigger_time">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>poison_name</label>
							<input type="text" class="form-control" id="poison_name" name="poison_name" required data-validation-required-message="Please enter your poison_name">
							<p class="help-block"></p>
					</div>
			</div>
			<div class="control-group form-group">
					<div class="controls">
							<label>poison_concentration</label>
							<input type="text" class="form-control" id="poison_concentration" name="poison_concentration" required data-validation-required-message="Please enter your poison_concentration">
							<p class="help-block"></p>
					</div>
			</div>
					<button type="submit" name="update"  class="btn btn-primary">Update</button>
		</form>




	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

	<script>

	window.onload = function(){

		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		});

		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php }
 ?>
