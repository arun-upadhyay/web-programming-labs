
<!-- Controller -->
<?php
require_once 'model/SinglesDAO.php';
if (isset($_POST['submit'])) {
    $singlesDAO = new SinglesDAO();
    $singlesDAO->validationCheck($_POST);
    $matchedData = $singlesDAO->addUser($_POST);
    if ($matchedData) {
        session_start();
        $_SESSION['matchedData'] = $matchedData;
        $_SESSION['userName'] = $_POST['name'];
        header("Location: view/view-match.php");
    } else {
        
    }
}
?>
<!--


<div>
    <h1>Thank you!</h1>
    <p>
        Welcome to NerdLuv, <?= $name ?>!<br /><br />
        Now <a href="view-match.php">Now continue on to see your matches!</a>
    </p>
</div>

-->