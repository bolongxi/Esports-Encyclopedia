// This javascript file is form validation. It checks to see if the information passed in by the user is formatted correctly.
function validateForm(gameTitle, gameDesc, gameTags) {
    let titleValidation = /^[a-zA-Z\s]+$/;
    // These 3 if statements check if the gamne title information character length is 0, if it doesn't match the expression above and if the if game description and game tags length are greater than 5000 and 300 respectively. 
    // Return false if this is the case. 
    if (gameTitle.value.length == 0 && gameTitle.value.match(titleValidation)) {
        alert("Game Title can't be 0 characters!");
        return false;
    }
    if (gameDesc.value.length > 5000) {
        alert("The description can only be a max of 5000 characters!");
        return false;
    }
    if (gameTags.value.length > 300) {
        alert("The game tags can only be a max of 300 characters!");
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