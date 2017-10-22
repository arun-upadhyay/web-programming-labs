<?php include("top.html"); ?>

<?php
$userName = $_POST["name"];
$userData = $userName;
foreach ($_POST as $key => $value) {
	if ($key != "name"){
		$userData = $userData.",".$value;
	}
}

file_put_contents("singles.txt", "\n".$userData, FILE_APPEND);
?>

<div>
<h1>Thank you!</h1>
<p>
Welcome to NerdLuv, <?= $userName ?>!<br /><br />
Now <a href="matches.php">log in to see your matches!</a>
</p>
</div>

<?php include("bottom.html"); ?>