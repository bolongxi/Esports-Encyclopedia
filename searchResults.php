<!DOCTYPE html>
<!-- File for the result page after you use the search bar on index.html. -->
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
        main img {
            height: 20px;
            width: 20px;
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
                    <a class="nav-link" href=".">Teams</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="container-md">
    <h2>Games</h2>
    <div class="list-group">
        <!-- PHP code that querys for information in the mysql database and returns the results to the screen. Querys for the "Games", "Players", and "Sponsors". -->
        <?php
        include("connect.php");
        $search = $_GET['search'];
        $sql = "SELECT GameID, Title FROM Games WHERE Tags LIKE '%" . $search . "%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<a href='viewGame.php?GameID=" . $row['GameID'] . "' class='list-group-item list-group-item-action'>" . $row['Title'] . "</a>";
            }
        } else {
            echo "There are no games that match this search.";
        }
        $conn->close();
        ?>
    </div>
    <h2>Players</h2>
    <div class="list-group">
        <?php
        include("connect.php");
        $search = $_GET['search'];
        $sql = "SELECT PlayerID, InGameName FROM Players WHERE Tags LIKE '%" . $search . "%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<a href='viewPlayer.php?PlayerID=" . $row['PlayerID'] . "' class='list-group-item list-group-item-action'>" . $row['InGameName'] . "</a>";
            }
        } else {
            echo "There are no players that match this search.";
        }
        $conn->close();
        ?>
    </div>
    <h2>Sponsors</h2>
    <div class="list-group">
        <?php
        include("connect.php");
        $search = $_GET['search'];
        $sql = "SELECT SponsorID, Name FROM Sponsors WHERE Tags LIKE '%" . $search . "%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<a href='viewSponsor.php?SponsorID=" . $row['SponsorID'] . "' class='list-group-item list-group-item-action'>" . $row['Name'] . "</a>";
            }
        } else {
            echo "There are no sponsors that match this search.";
        }
        $conn->close();
        ?>
    </div>
    <h2>Teams</h2>
    <div class="list-group">
        <?php
        include("connect.php");
        $search = $_GET['search'];
        $sql = "SELECT TeamID, TeamName FROM Teams WHERE Tags LIKE '%" . $search . "%'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<a href='viewTeam.php?TeamID=" . $row['TeamID'] . "' class='list-group-item list-group-item-action'>" . $row['TeamName'] . "</a>";
            }
        } else {
            echo "There are no teams that match this search.";
        }
        $conn->close();
        ?>
    </div>
</main>
</body>
</html>