<?php

ob_start();
include 'db-connection.php';
if (!empty($_POST)) {
    $result = checkCredentials($_POST['name'], $_POST['password']);
}

function checkCredentials($name, $password) {
    global $db;
    $pass_hash = hash("sha256", $password . $name);
    $stmt = $db->prepare("SELECT * FROM singles WHERE name ='" . $name . "' AND pass= '" . $pass_hash . "'");
    $stmt->execute();
    $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        session_start();
        $_SESSION['username'] = $name;
        $data = array($userRow['name'], $userRow['gender'], $userRow['age'], $userRow['type1'], $userRow['type2']
            , $userRow['type3'], $userRow['type4'], $userRow['os'], $userRow['min'], $userRow['max']);
        $_SESSION['matches'] = $data;
        header("Location: view-match.php");
    } else {
        header("Location: login.php?err=Invalid username or password");
    }
}

?>