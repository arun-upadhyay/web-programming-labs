<htm> 
    <title>Database Queries using PHP </title>
    <h1> Database Queries using PHP </h1 >
    <body>
        <?php
        require_once 'conn.php';
        $connection = new Connection("movies", "localhost", "popcorn", "imdb");
        $conn = $connection->connectdb();
        echo "<b>================>>>>>>>>>>>>>>>>>>>>> ACTORS <<<<<<<<<<<<<<<<<<<<<<<==================</b>" . "\n";
        $sql = "SELECT id, first_name, last_name, gender FROM actors where id in (4306, 7979, 8426)";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<th>ID </th> <th> First name</th> <th> Last name </th><th> Gender </th>  ";
            while ($row = $result->fetch_assoc()) {
                echo "<tr> ";
                echo "<td>" . $row["id"] . "</td> <td>" . $row["first_name"] . "</td> <td>  " .
                $row["last_name"] . "</td> <td> " . $row["gender"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }

        echo "\n"."<b>================>>>>>>>>>>>>>>>>>>>>> MOVIES <<<<<<<<<<<<<<<<<<<<<<<==================</b>" . "\n";
        $sql = "SELECT id, name, year FROM movies where id in (109093, 147603, 194874)";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <th> ID </th> <th> Name </th> <th> Year </th>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["id"] . "</td> <td> " . $row["name"] . "</td> <td>  " . $row["year"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        echo "\n"."<b>========>>>>>> SHOW ALL COLUMNS OF ALL ACTORS WHO HAVE THE FIRST NAME JULIA <<<<<<<<<<=====</b>" . "\n";
        $sql = "SELECT * FROM actors where first_name ='Julia'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table> <th> ID </th> <th> First name </th> <th> Last name </th><th> Gender </th>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["id"] . "</td> <td> " . $row["first_name"] . "</td> <td>  " . $row["last_name"] . "</td><td>". $row["gender"]. "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        echo "\n" . "<b>================>>>>>>>>>>>>>>>>>>>>> ROLES IN MOVIE PIE <<<<<<<<<<<<<<<<<<<<<<<==================</b>" . "\n";
        $sql = "SELECT * FROM roles, movies where roles.movie_id = movies.id and name = 'Pi'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table>  <th> Roles </th> ";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["role"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        echo "\n<b>" . "===> SHOW FIRST/LAST NAMES OF ALL ACTORS WHO APPEARED IN Pi ALONG WITH THEIR ROLES <<======" . "</b>\n";
        $sql = "SELECT * FROM roles, movies, actors WHERE roles.movie_id = movies.id AND actors.id = roles.actor_id AND name = 'Pi'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table>  <th> Roles </th> <th> First name </th> <th> Last name </th> ";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["first_name"] . "</td>";
                echo "<td> " . $row["last_name"] . "</td>";
                echo "<td> " . $row["role"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }


        echo "\n<b>" . "===> SHOW THE FIRST/LAST NAMES OF ALL ACTORS WHO APPEARED IN BOTH KILL BILL: VOL. 1 AND KILL BILL: VOL. 2 <<======" . "</b>\n";
        $sql = "SELECT * FROM roles, movies, actors where roles.movie_id = movies.id and actors.id = roles.actor_id AND name = 'Kill Bill: Vol. 1' AND name = 'Kill Bill: Vol. 2'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            echo "<table>  <th> Roles </th> <th> First name </th> <th> Last name </th> ";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["first_name"] . "</td>";
                echo "<td> " . $row["last_name"] . "</td>";
                echo "<td> " . $row["role"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

    </body>
</html>