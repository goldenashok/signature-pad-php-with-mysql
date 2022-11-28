<?PHP
	if($_SERVER['HTTP_HOST'] ==  'localhost') {
		$host = "localhost";
		$dbusername="root";
		$dbpassword="";
		$dbname="signpad";
	} else {
		$host = "localhost";
		$dbusername="";//Server Username
		$dbpassword="";//Server password
		$dbname="signpad";
	}
	function connection() {		
		$linkid = mysqli_connect("localhost", "root", "", "signpad");
		return $linkid;
	}

	$linkid=connection();
	function closeconnection($con) {
		mysqli_close($con);
	}
	error_reporting(0);

?>