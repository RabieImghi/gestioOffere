<?php
session_start();
require "Class/ApplyOnline.php";
if(isset($_SESSION['roleUser']) && $_SESSION['roleUser']==1){
	header("locaton:dashboard/dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" ></script>
	
	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">
					<i class="fas fa-code"></i>
					<h1>JobEase &nbsp &nbsp</h1>
				</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item ">
							<a class="nav-link" href="index.php">Home</a>
						</li>
						<li class="nav-item active">
							<a class="nav-link" href="not.php">Notification</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								language
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">FR</a>
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</li>
						<span class="nav-item active">
							<a class="nav-link" href="#">EN</a>
						</span>
						<?php 
						if(!isset($_SESSION['roleUser'])){
						?>
						<li class="nav-item">
							<a class="nav-link" href="login.php">Login</a>
						</li>
						<?php }else{ ?>
						<li class="nav-item">
							<a class="nav-link" href="Controller/controller.php?logout=ok">logout</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<!--------------------------  card  --------------------->
	<section class="light">
        <div class='m-4 p-4'>
            <?php
            if(isset($_SESSION['idUser'])){
                $jobsNotif=ApplyOnline::getNotefication($_SESSION['idUser']);
                foreach($jobsNotif as $notif){
                    if($notif['notification']==1){
                ?>
                    <div class="alert alert-success mb-4" id='<?=$notif['ApplyOnlineID']?>' role="alert">
                        Congradulation <?=$notif['username']?> ! your Offer Job <?=$notif['title']?> On <?=$notif['entreprise']?> Is accepted.
                    </div>

                <?php
                    }
                }
            }
            ?>
        </div>
    
	</section>
	<script>
		function addOffer(i){
			var jobid = document.getElementById('applyOffre'+i);
			var xml = new XMLHttpRequest();
			xml.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(xml.responseText=="ok"){
						Swal.fire({
							position: "top-end",
							icon: "success",
							title: "You have Apply this Offer with Succes",
							showConfirmButton: false,
							timer: 1500
						});
					}else{
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "Errore ! You have Already Apply this Offer",
						});
					}
					
				}
			};
			let url = "Controller/controller.php?applyOffre="+jobid.value;
			xml.open("GET", url, true);
			xml.send();
		}
		function search(typeSearch){
			let input = document.getElementById(typeSearch);
			let url = "Controller/search.php?value="+input.value+"&type="+typeSearch;
			let xml = new XMLHttpRequest();
			xml.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("articles").innerHTML=xml.responseText;
				}
			};
			xml.open("POST", url, true);
			xml.send();
		}
	</script>   
	<footer>
		<p>© 2023 JobEase </p>
	</footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>