<?php
// login-submit controller

require_once 'model/SinglesDAO.php';
if (!empty($_POST)) {
    $singlesDAO = new SinglesDAO();
    $result = $singlesDAO->authenticate($_POST['name'], $_POST['password']);
    if ($result) {
        $matchedData = $singlesDAO->getMatches($result);
        session_start();
        $_SESSION['matchedData'] = $matchedData;
        $_SESSION['userName'] = $_POST['name'];
        header("Location: view/view-match.php");
    } else {
        header("Location: view/login.php?err=Invalid username or password");
    }
}
?>