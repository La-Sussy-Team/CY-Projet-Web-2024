$(document).ready(function() {
    $("#email").blur(function() {
        var input=$(this);
        var re = /[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/;
        var is_email=re.test(input.val());
        $("#email").next(".error").remove();
        if(is_email){
            $("#email").removeClass("invalid").addClass("valid");
        } else {
            $("#email").removeClass("valid").addClass("invalid");
            $("#email").after("<span class='error'>Adresse email invalide</span>");
        }
    });
    $("#tel").blur(function() {
        var input=$(this);
        var tel=input.val();
        $("#tel").next(".error").remove();
        if(tel.length != 10){
            $("#tel").removeClass("valid").addClass("invalid");
            $("#tel").after("<span class='error'>Le numéro de téléphone doit contenir 10 chiffres</span>");
        } else {
            $("#tel").removeClass("invalid").addClass("valid");
        }
    });
    $("#password").blur(function() {
        var input=$(this);
        var password=input.val();
        $("#password").next(".error").remove();
        if(password.length < 8 && password.length > 0 || password.length > 40){
            $("#password").removeClass("valid").addClass("invalid");
            $("#password").after("<span class='error'>Le mot de passe doit contenir entre 8 et 40 caractères</span>");
        } else {
            $("#password").removeClass("invalid").addClass("valid");
        }
    });
    $("#passwordConfirmation").blur(function() {
        var input=$(this);
        var password=input.val();
        var passwordConfirmation=$("#password").val();
        $("#passwordConfirmation").next(".error").remove();
        if(password != passwordConfirmation){
            $("#passwordConfirmation").removeClass("valid").addClass("invalid");
            $("#passwordConfirmation").after("<span class='error'>Les mots de passe ne correspondent pas</span>");
        } else {
            $("#passwordConfirmation").removeClass("invalid").addClass("valid");
        }
    });
    $("#prenom").blur(function() {
        var input=$(this);
        var prenom=input.val();
        $("#prenom").next(".error").remove();
        if(prenom.length > 20){
            $("#prenom").removeClass("valid").addClass("invalid");
            $("#prenom").after("<span class='error'>Le prénom ne doit pas dépasser 20 caractères</span>");
        } else {
            $("#prenom").removeClass("invalid").addClass("valid");
        }
    });
    $("#nom").blur(function() {
        var input=$(this);
        var nom=input.val();
        $("#nom").next(".error").remove();
        if(nom.length > 30){
            $("#nom").removeClass("valid").addClass("invalid");
            $("#nom").after("<span class='error'>Le nom ne doit pas dépasser 30 caractères</span>");
        } else {
            $("#nom").removeClass("invalid").addClass("valid");
        }
    });
    $("#ville").blur(function() {
        var input=$(this);
        var ville=input.val();
        $("#ville").next(".error").remove();
        if(ville.length > 30){
            $("#ville").removeClass("valid").addClass("invalid");
            $("#ville").after("<span class='error'>La ville ne doit pas dépasser 30 caractères</span>");
        } else {
            $("#ville").removeClass("invalid").addClass("valid");
        }
    });
    $("#adresse").blur(function() {
        var input=$(this);
        var adresse=input.val();
        $("#adresse").next(".error").remove();
        if(adresse.length > 60){
            $("#adresse").removeClass("valid").addClass("invalid");
            $("#adresse").after("<span class='error'>L'adresse ne doit pas dépasser 60 caractères</span>");
        } else {
            $("#adresse").removeClass("invalid").addClass("valid");
        }
    });
    $(".send").click(function() {
        if ($("#username").hasClass("invalid") || $("#email").hasClass("invalid") || $("#tel").hasClass("invalid") || $("#password").hasClass("invalid") || $("#passwordConfirmation").hasClass("invalid") || $("#prenom").hasClass("invalid") || $("#nom").hasClass("invalid") || $("#ville").hasClass("invalid") || $("#adresse").hasClass("invalid")) {
            alert("Veuillez remplir les champs correctement.");
            return;
        } else {
            console.log("sending data");
            var formData = new FormData();
            var fileField = document.querySelector('input[type="file"]');
            formData.append('currentPassword', document.getElementById('currentPassword').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('tel', document.getElementById('tel').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('passwordConfirmation', document.getElementById('passwordConfirmation').value);
            formData.append('prenom', document.getElementById('prenom').value);
            formData.append('nom', document.getElementById('nom').value);
            formData.append('sexe', document.getElementById('sexe').value);
            formData.append('pays', document.getElementById('pays').value);
            formData.append('ville', document.getElementById('ville').value);
            formData.append('adresse', document.getElementById('adresse').value);
            if (fileField.files.length > 0) {
                formData.append('profileImage', fileField.files[0]);
            }
            formData.append('currentProfileImage', document.getElementById('currentProfileImage').value);
            fetch('./BackEnd/ValidationModification.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    window.location.href = './ModifierProfil.php';
                } else {
                    alert("Modification effectuée avec succès.");
                    window.location.href = './MonProfil.php';
                }
            })
        }
    });
});
function loadFile(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('profilePic');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}