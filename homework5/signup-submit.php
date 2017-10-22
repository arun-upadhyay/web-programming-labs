<?php include("top.html"); ?>
<?php include 'db-connection.php' ?>

<?php
if (!empty($_POST)) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $persona = $_POST['persona'];
    $os = $_POST['OS'];
    $minAge = $_POST['minage'];
    $maxAge = $_POST['maxage'];
    $password = $_POST['password'];
    $pass_hash = hash("sha256", $password . $name);
    $type = str_split(trim($persona));
    try {
        $sql = "INSERT INTO singles(name, pass, gender, age, type1, type2, type3, type4, os, min, max)"
                . "VALUES('$name', '$pass_hash', '$gender','$age','$type[0]', '$type[1]', '$type[2]', '$type[3]', '$os', '$minAge', '$maxAge' )";

        $db->exec($sql);
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}
?>

<div>
    <h1>Thank you!</h1>
    <p>
        Welcome to NerdLuv, <?= $name ?>!<br /><br />
        Now <a href="matches.php">log in to see your matches!</a>
    </p>
</div>

<?php include("bottom.html"); ?>