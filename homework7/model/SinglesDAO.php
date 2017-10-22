<?php

// DAO

require_once 'db-connection.php';
class SinglesDAO {

    public function authenticate($name, $password) {
        $db = DbConnection::dbconn();
        $pass_hash = hash("sha256", $password . $name);
        $stmt = $db->prepare("SELECT * FROM singles WHERE name ='" . $name . "' AND pass= '" . $pass_hash . "'");
        $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            $data = array($userRow['name'], $userRow['gender'], $userRow['age'], $userRow['type1'], $userRow['type2']
                , $userRow['type3'], $userRow['type4'], $userRow['os'], $userRow['min'], $userRow['max']);
            return $data;
        } else {
            return false;
        }
    }

    public function addUser($userdata) {
        $name = $userdata['name'];
        $gender = $userdata['gender'];
        $age = $userdata['age'];
        $persona = $userdata['persona'];
        $os = $userdata['OS'];
        $minAge = $userdata['minage'];
        $maxAge = $userdata['maxage'];
        $password = $userdata['password'];
        $pass_hash = hash("sha256", $password . $name);
        $type = str_split(trim($persona));
        try {
            $sql = "INSERT INTO singles(name, pass, gender, age, type1, type2, type3, type4, os, min, max)"
                    . "VALUES('$name', '$pass_hash', '$gender','$age','$type[0]', '$type[1]', '$type[2]', '$type[3]', '$os', '$minAge', '$maxAge' )";

            $db = DbConnection::dbconn();
            $db->exec($sql);
            $data = array($name, $gender, $age, $type[0], $type[1]
                , $type[2], $type[3], $os, $minAge, $maxAge);
            return $this->getMatches($data);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getMatches($userInfo) {
        try {
            $sql = "SELECT name, gender, age, type1, type2, type3, type4, os, min, max FROM singles WHERE gender <> '$userInfo[1]' AND age >= '$userInfo[8]' AND age <= '$userInfo[9]' AND os = '$userInfo[7]' AND
           (type1 = '$userInfo[3]' OR type2 = '$userInfo[4]' OR type3 = '$userInfo[5]' OR type4 = '$userInfo[6]')";
            $db = DbConnection::dbconn();
            $st = $db->prepare($sql);
            $st->execute();
            $st->setFetchMode(PDO::FETCH_ASSOC);
            $matches = array_values($st->fetchAll());
            return $matches;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    function validationCheck($POST) {
        if (strlen((string) $POST['name']) === 0 || strpos($POST['name'], ',') !== false) {
            header("Location: view/signup.php?err=Invalid name");
        } else if (strlen((string) $POST['password']) < 6 || strpos($POST['password'], ',') !== false) {
            header("Location: view/signup.php?err=Invalid password");
        } else if (trim($POST['gender']) !== "M" && trim($POST['gender']) !== "F") {
            header("Location: view/signup.php?err=Gender is invalid");
        } else if (intval($POST['age']) < 1 || intval($POST['age']) > 100) {
            header("Location: view/signup.php?err=Age is invalid");
        } else if ($POST['OS'] !== "Windows" && $POST['OS'] !== "Mac OS X" && $POST['OS'] !== "Linux") {
            header("Location: view/signup.php?err=OS type is invalid");
        } else if (intval($POST['minage']) <= 0 || intval($POST['minage']) > 100) {
            header("Location: view/signup.php?err=Minimum age is invalid");
        } else if (intval($POST['maxage']) <= 0 || intval($POST['maxage']) > 100) {
            header("Location:view/signup.php?err=Maximum age is invalid");
        }
    }

}
