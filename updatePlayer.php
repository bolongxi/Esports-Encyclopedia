<!DOCTYPE html>
<!-- This page is only accessible to Admin accounts. -->
<!-- This page prints the information updated to the screen and updates the information in the database. -->
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
        .px-md-5 {
            padding-left: 5rem !important;
            padding-right: 5rem !important;
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
<main class="container-sm">
    <?php
    include("connect.php");
    function create_image(&$image, $title) {
        $fileName = $image['name'];
        $fileTmpName = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileError = $image['error'];
        // $fileType = $image['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg');

        $fileDestination = 'images/player-default.png';

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = $title.".".$fileActualExt;
                    $fileDestination = 'images/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "File uploaded successfully<br>";
                } else {
                    echo "File is bigger than 1MB!<br>";
                }
            } else {
                echo "Error uploading the file<br>";
            }
        } else {
            echo "You cannot upload files of this type<br>";
        }
        return $fileDestination;
    }
    if(isset($_POST['submit'])) {
        echo "We have received your input!<br>";
        echo "Here is the following:<br>";
    }
    $playerID = $_GET['PlayerID'];
    $gameID = $_POST['Game'];
    $teamID = $_POST['Team'];
    $playerInGameName = $_POST['playerInGameName'];
    $playerName = $_POST['playerName'];
    $playerCountry = $_POST['playerCountry'];
    $playerDOB = $_POST['playerDOB'];
    $playerDesc = nl2br($_POST['playerDesc']);
    $playerSettings = $_POST['playerSettings'];
    $playerImage = $_FILES['playerImage'];
    $playerTags = $_POST['playerTags'];
    if($playerImage['name'] !== '') {
        $playerNewImage = create_image($playerImage,'PLAYER-' . $playerName);
        $sql="UPDATE Players SET ImagePath='" . $playerNewImage . "' WHERE PlayerID='" . $playerID ."'";
        if ($conn->query($sql) === TRUE) {
            echo "New image uploaded successfully <br>";
        } else {
            echo "Upload Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $sql = "UPDATE Players SET GameID='" . $gameID . "',
                               TeamID='" . $teamID . "',
                               InGameName='" . $playerInGameName . "',
                               FullName='" . $playerName . "',
                               Country='" . $playerCountry . "',
                               DOB='" . $playerDOB . "',
                               PlayerDesc='" . $playerDesc . "',
                               Settings='" . $playerSettings . "',
                               Tags='" . $playerTags . "'
                               WHERE PlayerID='" . $playerID ."'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "In-Game Name: $playerInGameName<br>";
    echo "Actual Name: $playerName<br>";
    echo "Country: $playerCountry<br>";
    echo "Date-of-Birth: $playerDOB<br>";
    echo "Description: $playerDesc<br>";
    echo "Settings: $playerSettings<br>";
    echo "Tags: $playerTags<br>";
    $conn->close();
    ?>
    <a href="playerForm.php"><button class="btn btn-primary">Insert Another Player</button></a>
    <a href="."><button class="btn btn-primary">Return Home</button></a>
</main>
</body>
</html>