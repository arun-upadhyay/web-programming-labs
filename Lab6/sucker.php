
<!DOCTYPE html>
<html>
    <head>
        <title>Buy Your Way to a Better Education!</title>
        <link href="buyagrade.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <?php
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['name']) && !empty($_POST['section']) && !empty($_POST['cardnumber']) && isset($_POST['cardtype'])) {
                $name = trim((string) $_POST['name']);
                $section = trim((string) $_POST['section']);
                $cardno = trim((string) $_POST['cardnumber']);
                $cardType = trim((string) $_POST['cardtype']);
                if (is_numeric($cardno) && strlen($cardno) === 16) {
                    if (($cardType === "visa" && substr($cardno, 0, 1) === '4') || ($cardType === "mastercard" && substr($cardno, 0, 1) === '5')) {
                        if (luhnCCTest($cardno)) {
                            ?>
                            <h1>Thanks, Sucker!</h1>

                            <p>Your information has been recorded.</p>

                            <dl>
                                <dt>Name</dt>
                                <dd><?= $name ?></dd>

                                <dt>Section</dt>
                                <dd><?= $section ?></dd>

                                <dt>Credit Card</dt>
                                <dd><?= $cardno ?></dd>
                            </dl>
                            <?php
                        } else {
                            echo "<h1> Sorry </h1>";
                            echo " <p>Your card is did not pass Luhn algorithm. <a href='buyagrade.html'>Try again?</a> </p>";
                        }
                    } else {
                        echo "<h1> Sorry </h1>";
                        echo " <p>Your card is invalid. <a href='buyagrade.html'>Try again?</a> </p>";
                    }
                } else {
                    echo "<h1> Sorry </h1>";
                    echo " <p>You didn't fill out the form completely. <a href='buyagrade.html'>Try again?</a> </p>";
                }
            } else {
                echo "<h1> Sorry </h1>";
                echo " <p>You didn't fill out the form completely. <a href='buyagrade.html'>Try again?</a> </p>";
            }
        }
        ?>

    </body>
</html>  

<?php

// Luhn algorithm
function luhnCCTest($card_number) {
    $card_number_checksum = '';
    foreach (str_split(strrev((string) $card_number)) as $i => $d) {
        $card_number_checksum .= $i % 2 !== 0 ? $d * 2 : $d;
    }
    return array_sum(str_split($card_number_checksum)) % 10 === 0;
}
?>