<?php
session_start();
include 'phpmysql.php';
if($_SESSION['loggedin']==''){
	header("location: index.php");
}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<link rel='stylesheet' href='dashboard.css'>
	</head>
	<body>

	<?php 
		require_once "phpmysql.php";

		if (isset($_POST["addE"])){
			$date = $_POST["date"];
			$type = $_POST["type"];
			$category = $_POST["category"];
			$time = $_POST["time"];
			$notes = $_POST["notes"];
			$tags = $_POST["tags"];
			$insert_query = "INSERT INTO ENTRIES(date, type, category, spent_time, notes, tags)VALUES('".$date."', '".$type."', '".$category."', '".$time."' , '".$notes."', '".$tags."')";
			$i = $conn->query($insert_query);
		}
	?>


	<div id="side-menu" class="sideMenu">
		<a href="javascript:void(0)" style="color:red;" class="closebtn" onclick="closeNav()"> &times;</a>
		<div class="main-menu">
			<h3 style="font-family: inherit;"> Add New Entry</h3>
			<form action="" method="POST" id="data">
				<label> Date * </label>
				<input name="date">
				<label> Type * </label>
				<input name="type">
				<label> Category * </label>
				<input name="category">
				<label> Time * </label>
				<input name="time">
				<label> Notes </label>
				<input name="notes">
				<label> Tags * </label>
				<input name="tags">
				<input id="lisa" class="btn btn-primary" type='submit' name="addE"> ADD ENTRY </input>
			</form>
		</div>
	</div>
		
	<section>
		<ul>
			<li><button onclick="openNav();"> + ADD NEW </button></li>
			<li class='right'><button onclick="location.href = 'logout.php'"> SIGN OUT </button></li>
			<li class='right'><?php echo $_SESSION['firstName']." ".$_SESSION['lastName'];?></li>
		</ul> 
	</section>
	
	<div class='flex-container'>
		<!-- Dashboard cards -->
		<div class="container flex-items">
			<div class="draggable" draggable="true">1</div>
			<div class="draggable" draggable="true">2</div>
			<div class="draggable" draggable="true">3</div>
			<div class="draggable" draggable="true">4</div>
		</div>

		<!-- Table -->
		<div class='flex-items' id='log_results'></div>
	</div>

	<script src='dashboard.js'></script>
	</body>
</html>
