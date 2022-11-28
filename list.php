<?php
	ob_start();
	session_start();
	require_once('config.php');

	$query = "SELECT name, signature_img FROM employee_sign";
	$result = mysqli_query($linkid, $query);
	closeconnection($linkid);
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-Signature Pad List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="asset/js/jquery.min.js"></script>
    <link type="text/css" href="asset/css/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="asset/js/jquery-ui.min.js"></script>
</head>
<body class="bg-light">
<div class="container p-4">
	<?php include('header.php');?>
	<div class="row">
	<p style="color:red;"<?php if($_SESSION['_msg']!=""){ echo $_SESSION['_msg']; $_SESSION['_msg']=''; } ?> 
	</div>
    <div class="row">
        <div class="col-md-5 border p-3  bg-white">
           <table class="table">
			   <thead>
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Image</th>
					</tr>
			   </thead>
			   <tbody>
			   <?php if(mysqli_num_rows($result)>0) {
			   $sno=0;
				while($rs = mysqli_fetch_array($result)){  
				$sno++;
				   ?>
					<tr>
						<td><?php echo $sno;?></td>
						<td><?php echo $rs['name'];?></td>
						<td><a target="_blank" href="<?php echo $rs['signature_img'];?>"><?php echo $rs['signature_img'];?></a></td>
					</tr>
				<?php } } ?>
			   </tbody>
		   </table>
        </div>
    </div>
</div>
</body>
</html>