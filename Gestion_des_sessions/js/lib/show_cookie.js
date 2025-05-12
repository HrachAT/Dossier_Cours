$(document).ready(main);

function main() {
    console.log("Welcome");
    
    var cookie = window.document.cookie;
    console.log(window.document.cookie);
    $("#cook").text(cookie);
}
