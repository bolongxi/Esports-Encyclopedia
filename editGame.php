<?php
/* Edit game from database; get info based on matching GameID */
require("connect.php");
$gameID = $_GET['GameID'];
$sql = "SELECT * FROM Games WHERE GameID ='".$gameID."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Esport Encyclopedia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <style>
        header {
            font-family: "DejaVu Sans Mono", sans-serif;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark mb-5" style="background-color: #2B303A;">
        <a class="navbar-brand" href="."><img src="images/logo2.svg" style="max-width: 50px"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="gameForm.html">Add Game</a>
                        <a class="dropdown-item" href="playerForm.php">Add Player</a>
                        <a class="dropdown-item" href="sponsorForm.html">Add Sponsor</a>
                        <a class="dropdown-item" href="teamForm.php">Add Team</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listGames.php">Games</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listPlayers.php">Players</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listSponsors.php">Sponsors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listTeams.php">Teams</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="container-md">
    <h1>Submit a Game Profile!</h1>
    <form action="updateGame.php?GameID=<?php echo $gameID; ?>"
          enctype="multipart/form-data"
          method="post"
          onsubmit="return validateForm(
              document.getElementById('gameTitle'),
              document.getElementById('gameDesc'),
              document.getElementById('gameTags')
              )
    ">
        <div class="form-group">
            <label for="gameTitle">Game Title</label>
            <input type="text" class="form-control" id="gameTitle" name="gameTitle" value="<?php echo $row['Title']; ?>">
        </div>
        <div class="form-group">
            <label for="gameImage">Image</label>
            <input type="file" onchange="ValidateSize(this)" class="form-control" id="gameImage" name="gameImage">
        </div>
        <div class="form-group">
            <label for="gameIcon">Icon</label>
            <input type="file" onchange="ValidateSize(this)" class="form-control" id="gameIcon" name="gameIcon">
        </div>
        <div class="form-group">
            <label for="gameDesc">Description</label>
            <textarea class="form-control" id="gameDesc" rows="5" name="gameDesc" style="white-space: pre-line;">
                <?php
                // converts <br> tags into newlines
                $gameDesc = $row['GameDesc'];
                $breaks = array("<br />","<br>","<br/>");
                $gameDesc = str_ireplace($breaks, "\r\n", $gameDesc);
                echo $gameDesc;
                ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="gameTags">Tags</label>
            <input type="text" class="form-control" id="gameTags" name="gameTags" value="<?php echo $row['Tags']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
</body>
</html>

