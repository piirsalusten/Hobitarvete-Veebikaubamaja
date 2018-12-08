<?php
	//et pääseks ligi sessioonile ja funktsioonidele
	require("../../config.php");
	require("functions.php");
	
	#muutujad
	$loginEmail = "";
	$notice= "";
	
	#Kui on sisse loginud, siis pealehele
	if(isset($SESSION["userId"])){
		header("Location: index.php");
		exit();
	}
	
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: index.php");
		exit();
	}
	
	#Kas logiti sisse
	if(isset ($_POST["signinButton"])){
	
	//kas on kasutajanimi sisestatud
	if (isset ($_POST["loginEmail"])){
		if (empty ($_POST["loginEmail"])){
			$loginEmailError ="NB! Ilma selleta ei saa sisse logida!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	if(!empty($loginEmail) and !empty($_POST["loginPassword"])){
		#echo "Logime sisse!";
		$notice = signin($loginEmail, $_POST["loginPassword"]);
	}
	
	}
	
	
	
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>tlushop.ee</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="tlu_watermark.png">
</head>
<body>

	<div id="main">

		<div class="container">

			<div id="header">
				<div id="logo">
					
				</div>

				<div style="clear:both"></div>

				<ul id="menu">
					<li><a href="index.php"><pealkiri>AVALEHT</pealkiri></a></li>
					<li><a href=""><pealkiri>OSTA</pealkiri></a>
				<ul>
				
					<li><a href="item_list.php?Category=1&type=1"><pealkiri>Veesport</pealkiri></a></li>
					<li><a href="item_list.php?Category=2&type=1"><pealkiri>Talisport</pealkiri></a></li>
					<li><a href="item_list.php?Category=3&type=1"><pealkiri>Kalastus</pealkiri></a></li>
					<li><a href="item_list.php?Category=4&type=1"><pealkiri>Ratsasport</pealkiri></a></li>
					<li><a href="item_list.php?Category=5&type=1"><pealkiri>Jahindus</pealkiri></a></li>
					<li><a href="item_list.php?Category=6&type=1"><pealkiri>Kõik kuulutused</pealkiri></a></li>
				
				</ul>
				<li><a href=""><pealkiri>RENDI</pealkiri></a>
				<ul>
				
					<li><a href="item_list.php?Category=1&type=2"><pealkiri>Veesport</pealkiri></a></li>
					<li><a href="item_list.php?Category=2&type=2"><pealkiri>Talisport</pealkiri></a></li>
					<li><a href="item_list.php?Category=3&type=2"><pealkiri>Kalastus</pealkiri></a></li>
					<li><a href="item_list.php?Category=4&type=2"><pealkiri>Ratsasport</pealkiri></a></li>
					<li><a href="item_list.php?Category=5&type=2"><pealkiri>Jahindus</pealkiri></a></li>
					<li><a href="item_list.php?Category=6&type=2"><pealkiri>Kõik kuulutused</pealkiri></a></li>
				
				</ul>
				
				<div style="clear:both"></div>

				</div>

			<div id="content">
				<h2> Kõik müügikuulutused: </h2>
				<span><table style="width:100%"> <tr><?php echo latestSell(); ?></tr></table> <br></span>
		
				</div>
		
			</div>

			<div id="sidebar">
				<div id="feeds">
					
					<?php if( isset($_SESSION['userId']) && !empty($_SESSION['userId']) )
						{
					?>
					<p>Tere, <?php echo $_SESSION["firstname"] ." " .$_SESSION["lastname"]; ?></p>
					<p><a href="addsale.php">Lisa kuulutus</a></p>
					<a href="mylistings.php">Minu kuulutused</a><br>
					<a href="?logout=1">Logi välja!</a>
					<?php }else{ ?>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<label>Kasutajanimi (E-post): </label>
					<br>
					<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>">
					<br><br>
					<label>Parool: </label>
					<br>
					<input name="loginPassword" placeholder="Salasõna" type="password">
					<br><br>
					<input name="signinButton" type="submit" value="Logi sisse"> <span> <?php echo $notice ?><span>
					</form>
					<a href="register.php">Registreeri!</a>
					<?php } ?>
				</div>

			
				</div>

		
			</div>
			<div style="clear:both"></div>

		</div>

	</div>	

	<div id="footer">
		<div class="container">
			<p>Copyright &copy; 2017 tlushop.ee <br>
				All Rights Reserved
			</p>
			
		</div>
	</div>


	
</body>
</html>