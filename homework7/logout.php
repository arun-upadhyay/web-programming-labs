<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['matches']);
session_destroy();

header("Location:view/index.php");
