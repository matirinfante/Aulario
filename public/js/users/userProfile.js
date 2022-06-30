function showPassword(elem) {
    var token = document.getElementById(elem);
    if (token.type == "password") {
        token.type = "text";
        document.getElementById("hidden_" + elem).style.visibility = 'hidden';
        document.getElementById("show_" + elem).style.visibility = 'visible';
    } else {
        token.type = "password";
        document.getElementById("show_" + elem).style.visibility = 'hidden';
        document.getElementById("hidden_" + elem).style.visibility = 'visible';
    }
}