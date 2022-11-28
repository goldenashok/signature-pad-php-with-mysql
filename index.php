<?php
	ob_start();
	session_start();
	require_once('config.php');

	if (isset($_POST['submit'])) {
		$name = $file = "";
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}

		$folderPath = "upload/";
		$image_parts = explode(";base64,", $_POST['signature']);
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		$file = $folderPath . $name . "_" . uniqid() . '.' . $image_type;
		file_put_contents($file, $image_base64);
		$sql = "INSERT INTO employee_sign(name, signature_img) VALUES ('".$name."', '".$file."')";
		$query = mysqli_query($linkid, $sql);
		closeconnection($linkid);
		$_SESSION['_msg']=  "Signature uploaded successfully.!";
		header("Location:list.php");	
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form with Signature Pad | E-Signature Pad using Jquery UI and PHP
        - bootstrapfriendly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="asset/js/jquery.min.js"></script>
    <link type="text/css" href="asset/css/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="asset/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="asset/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="asset/css/jquery.signature.css">

    <style>
        .kbw-signature {
            width: 400px;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>
	<script type="text/javascript">
	$(document).ready(function(){
	var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
		$('#disable').click(function() {
			var disable = $(this).text() === 'Disable';
			$(this).text(disable ? 'Enable' : 'Disable');
			sig.signature(disable ? 'disable' : 'enable');
		});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
		$('#json').click(function() {
			alert(sig.signature('toJSON'));
		});
		$('#svg').click(function() {
			alert(sig.signature('toSVG'));
		});
		});
        
    </script>
</head>
<body class="bg-light">
<div class="container p-4">
	<?php include('header.php');?>
	<div class="row">
	<p style="color:red;"<?php if($_SESSION['_msg']!=""){ echo $_SESSION['_msg']; $_SESSION['_msg']=''; } ?> 
	</div>
    <div class="row">
        <div class="col-md-5 border p-3  bg-white">
            <form method="POST" action="">
                <h1>PHP Signature Pad</h1>
                <div class="col-md-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-12">
                    <label class="" for="">Signature:</label>
                    <br />
                    <div id="sig"></div>
                    <br />

                    <input type="text" id="signature64" name="signature" style="display: none">
                    <div class="col-12">
						<button class="btn btn-sm btn-primary" id="disable">Disable</button>
                        <button class="btn btn-sm btn-warning" id="clear">?Clear Signature</button>
						<button class="btn btn-sm btn-secondary"id="json">To JSON</button>
						<button class="btn btn-sm btn-info" id="svg">To SVG</button>
                    </div>
                </div>
                <br />
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>