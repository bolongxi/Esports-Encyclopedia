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
    // function used to upload an image and return image path
    function create_image(&$image, $title) {
        $fileName = $image['name'];
        $fileTmpName = $image['tmp_name'];
        $fileSize = $image['size'];
        $fileError = $image['error'];
        // $fileType = $image['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'svg');

        $fileDestination = 'images/game-default.png';

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
    $gameTitle = $_POST['gameTitle'];
    $gameImage = $_FILES['gameImage'];
    $gameIcon = $_FILES['gameIcon'];
    $gameDesc = nl2br($_POST['gameDesc']);
    $gameTags = $_POST['gameTags'];
    $gameNewImage = create_image($gameImage,$gameTitle);
    $gameNewIcon = create_image($gameIcon,"$gameTitle".'ICON');
    $sql = "INSERT INTO Games (Title, ImagePath, IconPath, GameDesc, Tags)
VALUES ('$gameTitle','$gameNewImage','$gameNewIcon','$gameDesc','$gameTags')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // See information that will be uploaded to database
    echo "<p>Game Title: $gameTitle</p>";
    echo "<p>Description: $gameDesc</p>>";
    echo "<p>Game Image Path: $gameNewImage</p>";
    echo "<p>Game Icon Path: $gameNewIcon</p>";
    echo "<p>Tags: $gameTags</p>";
    $conn->close();
    ?>
    <a href="gameForm.html"><button class="btn btn-primary">Insert Another Game</button></a>
    <a href="."><button class="btn btn-primary">Return Home</button></a>
</main>
</body>
</html>
