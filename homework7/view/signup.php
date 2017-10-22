<?php include("top.html"); ?>


<form action="../signup-submit.php" method="post">
    <fieldset>
        <legend>New User Signup:</legend>

        <ul>
            <li>
                <strong>Name:</strong>
                <input type="text" name="name" size="16" />

            </li>
            <li>
                <strong>Password:</strong>
                <input type="password" name="password" size="16" />
            </li>

            <li><strong>Gender:</strong>
                <label><input type="radio" name="gender" value="M" />Male</label>
                <label><input type="radio" name="gender" value="F" checked="checked" />Female</label>
            </li>

            <li>
                <strong>Age:</strong>
                <input type="text" name="age" size="6" maxlength="2" />
            </li>

            <li>
                <strong>Personality type:</strong>
                <input type="text" name="persona" size="6" maxlength="4" />
                <a href="">(Don't know your type?)</a>
            </li>

            <li>
                <strong>Favorite OS:</strong>
                <select name="OS">
                    <option selected="selected">Windows</option>
                    <option>Mac OS X</option>
                    <option>Linux</option>
                </select>
            </li>

            <li>
                <strong>Seeking age:</strong>
                <input type="text" name="minage" size="6" maxlength="2" value="min" />to<input type="text" name="maxage" size="6" maxlength="2" value="max" />
            </li>
        </ul>

        <input type="submit" name="submit" value="Sign Up">
    </fieldset>
</form>
<span> 
    <?php
    
    if (!empty($_GET['err'])) {
        $err = $_GET['err'];
        echo "<font color='red'>$err</font>";
    }
    ?>
</span>
<?php include("bottom.html"); ?>