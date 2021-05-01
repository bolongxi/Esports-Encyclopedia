<?php
/* Edit player from database; get info based on matching PlayerID */
require("connect.php");
$playerID = $_GET['PlayerID'];
$sql = "SELECT * FROM Players WHERE PlayerID ='".$playerID."'";
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
    <script src="validatePlayerForm.js"></script>
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
                        <a class="dropdown-item" href=".">Add Player</a>
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
                    <a class="nav-link" href="listTeams.php">Teams</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="container-md">
    <h1>Submit a Player Profile!</h1>
    <form action="updatePlayer.php?PlayerID=<?php echo $playerID; ?>"
          enctype="multipart/form-data"
          method="post"
          onsubmit="return validateForm(
              document.getElementById('playerInGameName'),
              document.getElementById('playerName'),
              document.getElementById('playerCountry'),
              document.getElementById('playerDOB'),
              document.getElementById('playerDesc'),
              document.getElementById('playerSettings'),
              document.getElementById('playerTags')
              )
    ">
        <div class="form-group">
            <label for="Game">Select Game</label>
            <select class="form-control" id="Game" name="Game">
                <?php
                include("connect.php");
                $sql = "SELECT GameID, Title FROM Games";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($gameRow = $result->fetch_assoc()) {
                        echo "<option value='".$gameRow['GameID']."'>".$gameRow['Title']."</option>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Team">Select Team</label>
            <select class="form-control" id="Team" name="Team">
                <?php
                include("connect.php");
                $sql = "SELECT TeamID, TeamName FROM Teams";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($teamRow = $result->fetch_assoc()) {
                        echo "<option value='".$teamRow['TeamID']."'>".$teamRow['TeamName']."</option>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="playerInGameName">In-Game Name</label>
            <input type="text" class="form-control" id="playerInGameName" name="playerInGameName" value="<?php echo $row['InGameName']; ?>">
        </div>
        <div class="form-group">
            <label for="playerName">Actual Name</label>
            <input type="text" class="form-control" id="playerName" name="playerName" value="<?php echo $row['FullName']; ?>">
        </div>
        <div class="form-group">
            <label for="playerCountry">Country</label>
            <input type="text" class="form-control" id="playerCountry" name="playerCountry" value="<?php echo $row['Country']; ?>">
        </div>
        <div class="form-group">
            <label for="playerDOB">Date of Birth</label>
            <input type="text" class="form-control" id="playerDOB" name="playerDOB" placeholder="YYYY-MM-DD" value="<?php echo $row['DOB']; ?>">
        </div>
        <div class="form-group">
            <label for="playerDesc">Description</label>
            <textarea class="form-control" id="playerDesc" rows="5" name="playerDesc" style="white-space: pre-line;">
                <?php
                // converts <br> tags into newlines
                $playerDesc = $row['PlayerDesc'];
                $breaks = array("<br />","<br>","<br/>");
                $playerDesc = str_ireplace($breaks, "\r\n", $playerDesc);
                echo $playerDesc;
                ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="playerSettings">Settings</label>
            <textarea class="form-control" id="playerSettings" rows="3" name="playerSettings">
                <?php
                $playerSettings = $row['Settings'];
                $breaks = array("<br />","<br>","<br/>");
                $playerSettings = str_ireplace($breaks, "\r\n", $playerSettings);
                echo $playerSettings;
                ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="playerImage">Image</label>
            <input type="file" onchange="ValidateSize(this)" class="form-control" id="playerImage" name="playerImage">
        </div>
        <div class="form-group">
            <label for="playerTags">Tags</label>
            <input type="text" class="form-control" id="playerTags" name="playerTags" value="<?php echo $row['Tags']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
</body>
</html>
