<?php 
session_start();
include '../_inc/dbconn.php';
        
if(!isset($_SESSION['admin_login'])) 
    header('location:../admin/');   
?>
<?php include 'displayinfo.php' ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="../vendor/img/favicon.png"/>
	<meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../vendor/css/sb-admin.css" rel="stylesheet">


    <!-- Page level plugin CSS-->
    <link href="../vendor/js/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	
	<title> Staff Settings | UBank</title>
  </head>
  <body id="page-top">
    <?php include 'aheader.php' ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs 
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol> -->
		  
		  <?php
				if (isset($_GET['add'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						New staff member added. </div>";
				} elseif (isset($_GET['deleted'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Staff member deleted.</div>";
				} elseif (isset($_GET['edit'])) {
					echo "<div class='alert alert-success alert-dismissible'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<i class='fas fa-check'></i>
						Staff member information changed.</div>";
				}
			?>
		  
		  <!-- Your Cards & Transfer Funds Section -->
		  <div class="row">
			<div class="col-xl-4 mb-6">
			  <div class="card o-hidden mb-3" id="general">
			    <!-- <div class="card-body-icon">
                    <i class="fas fa-user-plus"></i>
                </div> -->
				<div class="card-header">
				  <i class="fas fa-user-plus"></i>
				  Add Staff</div>
				<div class="card-body">
					<form action="staff-add.php" method="POST">
						<table>
							<tr>
								<td> Staff's name</td>
								<td><input type="text" name="staff_name" required=""/></td>
							</tr>
							<tr>
								<td>gender</td>
								<td>
									M<input type="radio" name="staff_gender" value="M" checked/>
									F<input type="radio" name="staff_gender" value="F" />
								</td>
							</tr>
							<tr>
								<td>DOB</td>
								<td><input type="date" name="staff_dob" required=""/></td>
							</tr>
							<tr>
								<td>Relationship</td>
								<td>
									<select name="staff_status">
										<option>unmarried</option>
										<option>married</option>
										<option>divorced</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Department</td>
								<td>
									<select name="staff_dept">
										<option>revenue</option>
										<option>developer</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>DOJ</td>
								<td><input type="date" name="staff_doj" required=""/></td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><textarea name="staff_address" required=""></textarea></td>
							</tr>
							<tr>
								<td>Mobile</td>
								<td><input type="text" name="staff_mobile" required=""/></td>
							</tr>

							<tr>
								<td>Email id</td>
								<td><input type="email" name="staff_email" required=""/></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="staff_pwd" required=""/></td>
							</tr>
						</table><br>
						<input type="submit" class="btn btn-success" name="add_staff" value="Add Staff member" class='addstaff_button'/>
					</form>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
			<div class="col-xl-8 mb-6">
			  <div class="card o-hidden mb-3" id="transfer">
				<div class="card-header">
				  <i class="fas fa-user-edit"></i>
				  Display/Edit Staff</div>
				<div class="card-body-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
				<div class="card-body">
					<form action="staff-edit" method="POST">
					<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<?php
							include '../_inc/dbconn.php';
							$sql="SELECT * FROM `staff`";
							$result=  mysql_query($sql) or die(mysql_error());
							$sql_min="SELECT MIN(id) from staff";
							$result_min=  mysql_query($sql_min);
							$rws_min=  mysql_fetch_array($result_min);
						?>
						<thead>
						<tr>
							<th></th>
							<th>id</th>
							<th>name</th>
							<th>email</th>
							<th>mobile</th>
							<th>department</th>
							<th>address</th>
							<th>DOB</th>
							<th>DOJ</th>
							<th>gender</th>
						</tr>
						</thead>
						<tbody>
						<?php
                        while($rws=  mysql_fetch_array($result)){
                            echo "<tr><td><input type='radio' name='staff_id' value=".$rws[0];
                            if($rws[0]==$rws_min[0]) echo' checked';
                            echo " /></td>";
                            echo "<td>".$rws[0]."</td>";
                            echo "<td>".$rws[1]."</td>";
							echo "<td>".$rws[8]."</td>";
							echo "<td>".$rws[7]."</td>";
							echo "<td>".$rws[4]."</td>";
							echo "<td>".$rws[6]."</td>";
                            echo "<td>".$rws[2]."</td>";
							echo "<td>".$rws[5]."</td>";
                            echo "<td>".$rws[10]."</td>";
                            echo "</tr>";
                        }
                        ?>
					  </tbody>
					</table>
					</div><br>
					<input type="submit" class="btn btn-warning" name="submit1_id" value="Edit Staff Member" />
					<a href="#" class="btn btn-danger" id="pagesDropdown" data-toggle="modal" data-target="#deleteModal" aria-haspopup="true">Delete Staff Member</a>
				</div>
				<div class="card-footer small text-muted">Updated <b>Today</b> at <?php echo date("H:i A (P)"); ?></i></div>
			  </div>
			</div>
		  </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
		
		<!-- Delete staff member Modal-->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i> Are you sure?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span>
				</button>
			  </div>
			  <div class="modal-body">Are you sure you want to delete this staff member?</div>
			  <div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<input type="submit" class="btn btn-danger" name="submit2_id" value="Delete Staff member" />
				</form>
			  </div>
			</div>
		  </div>
		</div>

<?php include 'afooter.php' ?>