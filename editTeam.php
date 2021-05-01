<?php
/* Edit team from database; get info based on matching TeamID */
require("connect.php");
$teamID = $_GET['TeamID'];
$sql = "SELECT * FROM Teams WHERE TeamID ='".$teamID."'";
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
    <script src="validateTeamForm.js"></script>
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
                        <a class="dropdown-item" href=".">Add Team</a>
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
    <h1>Submit a Team Profile!</h1>
    <form action="updateTeam.php?TeamID=<?php echo $teamID; ?>"
          enctype="multipart/form-data"
          method="post"
          onsubmit="return validateForm(
              document.getElementById('teamName'),
              document.getElementById('teamDesc'),
              document.getElementById('teamTags')
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
            <label for="Sponsor">Select Sponsor</label>
            <select class="form-control" id="Sponsor" name="Sponsor">
                <?php
                include("connect.php");
                $sql = "SELECT SponsorID, Name FROM Sponsors";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($sponsorRow = $result->fetch_assoc()) {
                        echo "<option value='".$sponsorRow['SponsorID']."'>".$sponsorRow['Name']."</option>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="teamName">Team Name</label>
            <input type="text" class="form-control" id="teamName" name="teamName" value="<?php echo $row['TeamName']; ?>">
        </div>
        <div class="form-group">
            <label for="teamImage">Image</label>
            <input type="file" onchange="ValidateSize(this)" class="form-control" id="teamImage" name="teamImage">
        </div>
        <div class="form-group">
            <label for="teamDesc">Description</label>
            <textarea class="form-control" id="teamDesc" rows="5" name="teamDesc" style="white-space: pre-line;">
                <?php
                // converts <br> tags into newlines
                $teamDesc = $row['TeamDesc'];
                $breaks = array("<br />","<br>","<br/>");
                $teamDesc = str_ireplace($breaks, "\r\n", $teamDesc);
                echo $teamDesc;
                ?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="teamTags">Tags</label>
            <input type="text" class="form-control" id="teamTags" name="teamTags" value="<?php echo $row['Tags']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</main>
</body>
</html>
