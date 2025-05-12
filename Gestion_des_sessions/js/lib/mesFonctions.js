function verifierMdp() {
    event.preventDefault();
    mdp = $("#mdp").val();
    confirme = $("#confirme").val();
    if (mdp === confirme) {
        console.log("c'est good");
    } else {
        console.log("c'est pas good");
    }
}

function afficherMdp() {
    var inputId = $(this).data('target');
    if ($('#' + inputId).attr("type") === 'password') {
        $('#' + inputId).attr("type", "text");
    } else {
        $('#' + inputId).attr("type", "password");
    }
}



function main() {
    console.log("Welcome");
    //$('form').submit(verifierMdp);
    $('.oeilmdp').click(afficherMdp);
}


$(document).ready(main);