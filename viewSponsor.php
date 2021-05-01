<?php
// This file is the page for the viewSponsor page. This is where information on a "Sponser" is presented.
require("connect.php");
$sponsorID = $_GET['SponsorID'];
$sql = "SELECT * FROM Sponsors WHERE SponsorID ='" . $sponsorID . "'";
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
<?php include('header.php'); ?>
<main class="container-md">
    <?php
    // Checks to see if the account logged in is an Admin. If it is, display content only accessible to Admin accounts.
    if(isset($_SESSION['id'])) {
      if ($_SESSION['id'] == 1) {
    echo "<a href='editSponsor.php?SponsorID=" . $sponsorID . "'><button class='btn btn-primary'>Edit</button></a>";
    echo "<a href='deleteSponsor.php?SponsorID=" . $sponsorID . "'><button class='btn btn-primary'>Delete</button></a>";
      }
    }
    echo "<h1 style='text-align: center'>" . $row['Name'] . "</h1>";
    ?>
    <div class="container-fluid">
        <?php
        echo "<img src='" . $row['Imagepath'] . "' class='img-fluid mx-auto d-block'>";
        ?>
    </div>
    <div class="container-fluid mt-3 border-top">
        <h2>Description</h2>
        <?php
        echo $row['SponsorDesc'];
        ?>
    </div>
</main>
</body>
</html>

