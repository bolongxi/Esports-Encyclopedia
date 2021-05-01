<?php
ob_start();
session_start();
?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark mb-5" style="background-color: #2B303A;">
        <a class="navbar-brand" href="."><img src="images/logo2.svg" style="max-width: 50px"></a>
        <a class="navbar-brand" href="aboutUs.php">ABOUT US</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <?php
                    // if username doesn't exist, assume not logged-in
                    if(!isset($_SESSION['username'])) {
                        echo '<li class="nav-item">
                    <a class="nav-link" href="login.html">Login</a>
                </li>';
                    }
                    else {
                        echo '<li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>';
                    }
                    // if userid = 1, they are the Admin
                    // show admin options in header
                    if(isset($_SESSION['id'])) {
                        if ($_SESSION['id'] == 1) {
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Admin
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="gameForm.html">Add Game</a>
                                        <a class="dropdown-item" href="playerForm.php">Add Player</a>
                                        <a class="dropdown-item" href="sponsorForm.html">Add Sponsor</a>
                                        <a class="dropdown-item" href="teamForm.php">Add Team</a>
                                    </div>
                            ';
                        }
                    }
                    ?>

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