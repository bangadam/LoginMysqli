<?php 

$db = new mysqli("127.0.0.1", "root", "", "db_belajar");
@session_start();
 ?>



<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	</head>
	<body>
		
		<!-- Dropdown Structure -->
		<ul id="dropdown1" class="dropdown-content">
			<li><a href="#!">one</a></li>
			<li><a href="#!">two</a></li>
			<li class="divider"></li>
			<li><a href="#!">three</a></li>
		</ul>
		<nav>
			<div class="nav-wrapper container">
				<a href="#!" class="brand-logo">CRUD</a>
				<!-- activate side-bav in mobile view -->
				<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="">Login</a></li>
					<li><a href="">Register</a></li>
				</ul>
				<!-- navbar for mobile -->
				<ul class="side-nav" id="mobile-demo">
					<li><a href="">Login</a></li>
					<li><a href="">Register</a></li>
				</ul>
			</div>
		</nav>

		
		<div class="row" style="margin-top:40px;">
			<div class="col m6 offset-m3">
			<div class="card z-depth-2">
				<div class="container">
					<h3 class="center">Login <span class="orange-text">Area</span></h3>
					<div class="card-content">
					<form action="" method="POST">
						<div class="input-field"> 
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username">
							</div>
						</div>
						<div class="input-field">
							<div class="form-group">
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						</div>
						
						<button type="submit" name="login" class="btn">Login</button>
					</form>
					<?php 

					if (@$_POST['login']) {
						$username = @$_POST['username'];
						$password = @$_POST['password'];

						if ($username == '' || $password == '') {
							?>
							<script type="text/javascript">alert("Username atau Password Tidak boleh kosong")</script>
							  <?php
						} else {
							$log = $db->prepare("SELECT * FROM users where username = ? AND password = md5(?)") or die($db->error);

							$log->bind_param('ss', $username, $password);
							$log->excute();
							$log->store_result();
							$cek = $log->num_rows;
							$log->bind_result($id, $username, $password);
							$log->fetch();
							if ($cek > 0) {
								@$_SESSION['admin'] = $id;
								header("Location:index.php");
							}else {
								?>
								<script type="text/javascript">alert("Login gagal,Silahkan ulangi lagi")</script>
								<?php
							}
						}
					}

					 ?>

					</div>
				</div>
			</div>
		</div>
		</div>


		<script type="text/javascript" src="js/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="js/materialize.min.js"></script>

	</body>
</html>