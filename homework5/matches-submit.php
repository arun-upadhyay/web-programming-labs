<?php include("top.html"); ?>
<?php include 'db-connection.php' ?>
<?php
$matches = "";
//Get User Information
$userName = $_GET["name"];
$password = $_GET["password"];

$userInfo = array();
try {

    $pass_hash = hash("sha256", $password . $userName);
    $st = $db->prepare("SELECT name, gender, age, type1, type2, type3, type4, os, min, max  FROM singles WHERE name ='$userName' AND pass = '$pass_hash'");
    $st->execute();
    $st->setFetchMode(PDO::FETCH_ASSOC);
    $userInfo = array_values($st->fetch());
} catch (Exception $ex) {
    echo $ex->getMessage();
}

//Function to check personality match
function checkPersona($matchPersona, $userPersona) {
    for ($i = 0; $i < 4; $i++) {
        if ($matchPersona[$i] == $userPersona[$i]) {
            return true;
        }
    }
}

//Function to create match array
function createMatches() {
    global $userInfo;
    global $db;
    try {
        $sql = "SELECT name, gender, age, type1, type2, type3, type4, os, min, max FROM singles WHERE gender <> '$userInfo[1]' AND age >= '$userInfo[8]' AND age <= '$userInfo[9]' AND os = '$userInfo[7]' AND
           (type1 = '$userInfo[3]' OR type2 = '$userInfo[4]' OR type3 = '$userInfo[5]' OR type4 = '$userInfo[6]')";
        $st = $db->prepare($sql);
        $st->execute();
        $st->setFetchMode(PDO::FETCH_ASSOC);
        $matches = array_values($st->fetchAll());
        return $matches;
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

//Function to get matches
function displayMatches() {

    $matches = createMatches();
    foreach ($matches as $match) {
        printMatches(array_values($match));
    }
}

//Function to display matches
function printMatches($rawMatch) {
    echo "<div class='match'>
		<p><img src='https://webster.cs.washington.edu/images/nerdluv/user.jpg' alt='user icon' />
		" . $rawMatch[0] . "</p>
		<ul>
			<li><strong>gender:</strong>" . $rawMatch[1] . "</li>
			<li><strong>age:</strong>" . $rawMatch[2] . "</li>
			<li><strong>type:</strong>" . $rawMatch[3] . "</li>
			<li><strong>OS:</strong>" . $rawMatch[4] . "</li>                        
		</ul>
		</div>";
}
?>

<h1>Matches for <?= $userName ?></h1>

<?php displayMatches(); ?>


<?php include("bottom.html"); ?>