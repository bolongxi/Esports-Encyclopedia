function Validator(username, password) {
    var nameExp = /^[0-9A-Za-z]+$/;
    
    // if username has a space or uses characters not apart of alphabet/number, return false
    if (!username.value.match(nameExp) || !password.value.match(nameExp)){
        alert("Invalid format!");
        return false;
    }
    // if username/password is less than 5 charcaters or greater than 15 characters, return false
    else if (username.value.length < 5 || password.value.length < 5 || username.value.length > 15 || password.value.length > 15){
        alert("Wrong input length. Length should be between 5 to 15 characters!");
        return false;
    }

    return true;
}