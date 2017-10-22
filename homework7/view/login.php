<?php include("top.html"); ?>

<form action="../login-submit.php" method="post">
    <fieldset>
        <legend>Returning User:</legend>

        <ul>
            <li>
                <strong>Name:</strong>
                <input type="text" name="name" size="16" />
            </li>
            <li>
                <strong>Password:</strong>
                <input type="password" name="password" size="16" />
            </li>
        </ul>

        <input type="submit" value="View My Matches">
    </fieldset>
</form>
<span style="color: red">
    <?php
    if (isset($_GET['err'])) {
        echo $_GET['err'];
    }
    ?>
</span>
<?php include("bottom.html"); ?>