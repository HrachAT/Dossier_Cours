function afficherMdp() {
    attribut = $('#mdp').attr('type');
    console.log(attribut);
    if (attribut === "password")
        $('#mdp').attr('type', 'text');
    if (attribut === "text")
        $('#mdp').attr('type', 'password');
}

function cacherMdp() {
    $('#mdp').attr('type', 'password');
}

function verifierMdp() {

    event.preventDefault();

    mdp = $("#mdp").val();
    confirm = $("#confirme").val();
    if (mdp === confirm) {
        console.log("C'est bon");
    } else {
        console.log("It's not good !!!");
    }
}

function main() {
    console.log("Welcome Exo2");
    $("form").submit(verifierMdp);
    $('#oeilmdp').click(afficherMdp);
}


$(document).ready(main);