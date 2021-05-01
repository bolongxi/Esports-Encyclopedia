// This javascript file is form validation. It checks to see if the information passed in by the user is formatted correctly.
function validateForm(playerInGameName, playerName, playerCountry, playerDOB, playerDesc, playerSettings, playerTags) {
    let playerInGameValidation = /^[0-9a-zA-Z]+$/;
    let nameValidation = /^[a-zA-Z\s]+$/;
    if (playerInGameName.value.length === 0 || playerName.value.length === 0) {
        alert("In-Game and Actual Name can't be 0 characters long!");
        return false;
    }
    if (playerInGameName.value.length > 30) {
        alert("In-Game Name must be 30 characters long or less!");
        return false;
    }
    if (playerName.value.length > 40) {
        alert("Full Name must be 40 characters long or less!");
        return false;
    }
    if (!playerInGameName.value.match(playerInGameValidation)) {
        alert("In-Game name must consist of only letters and numbers!");
        return false;
    }
    if (!playerName.value.match(nameValidation)) {
        alert("Actual name must consist of only letters and spaces!");
        return false;
    }
    if (!playerCountry.value.match(nameValidation)) {
        alert("Country must consist of only letters and spaces!");
        return false;
    }
    if (playerDesc.value.length > 5000) {
        alert("The description can only be a max of 5000 characters!");
        return false;
    }
    if (playerSettings.value.length > 500) {
        alert("The setting can only be a max of 500 cahracters!");
        return false;
    }
    if (playerTags.value.length > 300) {
        alert("The player tags can only be a max of 300 characters");
        return false;
    }
    return true;
}

function ValidateSize(file) {
    let FileSize = file.files[0].size / 1024 / 1024; // in MB
    if (FileSize > 1) {
        alert('File size exceeds 1 MB');
        $(file).val('');
    }
}
