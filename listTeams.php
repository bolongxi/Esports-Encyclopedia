<!DOCTYPE html>
<?php
  ob_start();
  include('login.php');
?>
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
<?php include('header.php'); ?>
<main class="container-md">
    <h2>Teams</h2>
    <div class="list-group">
        <?php
        include("connect.php");
        $sql = "SELECT Teams.TeamID, Teams.TeamName, Games.IconPath FROM Teams INNER JOIN Games ON Teams.GameID=Games.GameID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<a href='viewTeam.php?TeamID=" . $row['TeamID'] . "' class='list-group-item list-group-item-action'>";
                echo "<img src='" . $row['IconPath'] . "' alt='Team Icon'>";
                echo " " . $row['TeamName'];
                echo "</a>";
            }
        } else {
            echo "There are no teams available at the moment. Please try again later.";
        }
        $conn->close();
        ?>
    </div>
</main>
</body>
</html>
