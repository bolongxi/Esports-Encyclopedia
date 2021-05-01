// This javascript file is form validation. It checks to see if the information passed in by the user is formatted correctly.
function validateForm(sponsorName, sponsorDesc, sponsorTags) {
    let nameValidation = /^[a-zA-Z\s]+$/;
    if (sponsorName.value.length === 0 && sponsorName.value.match(nameValidation)) {
        alert("Game Title can't be 0 characters!");
        return false;
    }
    if (sponsorDesc.value.length > 5000) {
        alert("The description can only be a max of 5000 characters!");
        return false;
    }
    if (sponsorTags.value.length > 300) {
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