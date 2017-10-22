<!DOCTYPE html>
<html>
    <!--
    Web Programming Step by Step
    Lab #3, PHP
    -->

    <head>
        <title>Music Viewer</title>
        <meta charset="utf-8" />
        <link href="viewer.css" type="text/css" rel="stylesheet" />
    </head>

    <body>

        <h1>My Music Page</h1>

        <!-- Exercise 1: Number of Songs (Variables) -->
        <p>
            <?php
            $totalSongs = 1234;
            $musicHours = 123;
            $defaultpages = 5;
            ?>
            I love music.
            I have <?= $totalSongs ?>  total songs,
            which is over <?= $musicHours ?> hours of music!
        </p>

        <!-- Exercise 2: Top Music News (Loops) -->
        <!-- Exercise 3: Query Variable -->
        <div class="section">
            <h2>Yahoo! Top Music News</h2>
            <ol>
                <?php
                if (isset($_GET['newspages'])) {
                    $newspages = (int) $_GET['newspages'];
                } else {
                    $newspages = $defaultpages;
                }
                for ($songIndex = 1; $songIndex <= $newspages; $songIndex = $songIndex + 1) {
                    ?>		
                    <li><a href="http://music.yahoo.com/news/archive/<?= $songIndex ?>.html">Page <?= $songIndex ?></a></li>

                <?php } ?>
            </ol>
        </div>

        <!-- Exercise 4: Favorite Artists (Arrays) -->
        <!-- Exercise 5: Favorite Artists from a File (Files) -->
        <div class="section">
            <h2>My Favorite Artists</h2>

            <ol>
                <?php
                $artists = fopen("favorite.txt", "r") or die("Unable to open file!");
                while (!feof($artists)) {
                    $artistName = fgets($artists);
                    $artistSplit = explode(" ", $artistName);
                    $url = "http://music.yahoo.com/videos/" . $artistSplit[0] . "-" . $artistSplit[1];
                    ?>
                    <li><a href="<?= $url ?>" target="_blank"> <?= $artistName ?> </a></li>
                <?php } fclose($artists); ?>
            </ol>
        </div>

        <!-- Exercise 6: Music (Multiple Files) -->
        <!-- Exercise 7: MP3 Formatting -->
        <div class="section">
            <h2>My Music and Playlists</h2>
            <ul id="musiclist">
                <?php
                $mp3 = glob("./songs/*.mp3");
                foreach ($mp3 as $m) {
                    $fileSize = floor(filesize($m) / 1024);
                    ?>
                    <li class="mp3item">
                        <!-- HTML5 audio tag -->
                        <audio controls>
                            <source src="<?= $m ?>" type="audio/ogg">
                        </audio>                  
                       <!-- <a href="<?= $m ?>"><?= $m . "(<b>" . $fileSize . "KB </b>)" ?></a> -->
                    </li>
                <?php } ?>
                <!-- Exercise 8: Playlists (Files) -->

                <li class="playlistitem">472-mix.m3u:
                    <ul>
                        <?php
                        $playlist = fopen("songs/playlist.m3u", "r") or die("Unable to open file!");
                        while (!feof($playlist)) {
                            $line = trim((string) fgets($playlist));
                            if (strpos($line, "mp3") !== false) {
                                $mp3 = glob("./songs/*.mp3");
                                foreach ($mp3 as $m) {
                                    if (strpos((string) $m, $line) !== false) {
                                        ?>
                                        <li ><?= $m ?></li>
                                        <?php
                                    }
                                }
                            }
                        }
                        fclose($playlist);
                        ?> 
                    </ul>
                </li>
            </ul>
        </div>

        <div>
            <a href="http://validator.w3.org/check/referer">
                <img src="http://mumstudents.org/cs472/Labs/3/w3c-html.png" alt="Valid HTML5" />
            </a>
            <a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img src="http://mumstudents.org/cs472/Labs/3/w3c-css.png" alt="Valid CSS" />
            </a>
        </div>
    </body>
</html>

