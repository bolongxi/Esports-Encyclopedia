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
<?php include('header.php'); ?>
<main class="container-md">
    <div class="container-fluid px-md-5">
        <img class="img-fluid mx-auto d-block" src="images/ee-logo.png">
    </div>
    <form action="searchResults.php">
        <input class="form-control form-control-lg" type="text" placeholder="Enter your favourite game, team, or player..." name="search">
        <button type="submit" class="btn btn-primary d-block mx-auto mt-2">Submit</button>
    </form>
</main>
</body>
</html>