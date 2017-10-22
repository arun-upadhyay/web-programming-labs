<?php include("top.html"); ?>
<?php
global $matches;
global $userName;
session_start();
if (isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
    $matches = $_SESSION['matchedData'];
    displayMatches();
} else {
    header("Location:../view/index.php");
}

//Function to get matches
function displayMatches() {
    global $matches;
    $size = count($matches);
    if ($size > 1) {
        if (!empty($_GET['page'])) {
            $indexValue = $_GET['page'];
        } else {
            $indexValue = 1;
        }

        $i = 1;
        foreach ($matches as $match) {
            if ($i == $indexValue) {
                printMatches(array_values($match));
                break;
            }
            $i++;
        }
        // prev link
        if ($indexValue > 1) {
            $prev = $indexValue - 1;
            echo "<a href='view-match.php?page=$prev'> Previous </a>";
        }
        //next link
        if ($indexValue < $size) {
            $next = $indexValue + 1;
            echo "<a href='view-match.php?page=$next'> Next </a>";
        }
    } else {
        //single match
        foreach ($matches as $match) {
            printMatches(array_values($match));
        }
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
<br />
<h1>Matches for <?= $userName ?></h1>

<span style="float: right"> <a href='../logout.php'> Logout </a> </span>
<?php include("bottom.html"); ?>