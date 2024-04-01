$(document).ready(function() {
    var currentStep = 1;
    var data = {};
    $(".next").click(function() {
        var isValidStep = false;
        switch (currentStep) {
            case 1:
                data.username = $("#username").val();
                isValidStep = validateStep1(data);
                break;
            case 2:
                data.email = $("#email").val();
                data.tel = $("#tel").val();
                data.password = $("#password").val();
                data.passwordConfirmation = $("#passwordConfirmation").val();
                isValidStep = validateStep2(data);
                break;
            case 3:
                data.prenom = $("#prenom").val();
                data.nom = $("#nom").val();
                data.sexe = $("#sexe").val();
                isValidStep = validateStep3(data);
                break;
            case 4:
                data.pays = $("#pays").val();
                data.ville = $("#ville").val();
                data.adresse = $("#adresse").val();
                isValidStep = validateStep4(data);
                break;
        }
        if (isValidStep) {
            $("#step" + currentStep).removeClass("active");
            currentStep++;
            $("#step" + currentStep).addClass("active");
        } else {
            alert("Please fill in the required fields.");
        }
    });
    $(".prev").click(function() {
        $("#step" + currentStep).removeClass("active");
        currentStep--;
        $("#step" + currentStep).addClass("active");
    });
    function validateStep1(data) {
        var username = data.username;
        if (username == "" || !/^[A-Za-z0-9]+$/.test(username) || username.length > 30 || $("#username").hasClass("invalid")) {
            return false;
        }
        return true;
    }
    function validateStep2(data) {
        var email = data.email;
        var tel = data.tel;
        var password = data.password;
        var passwordConfirmation = data.passwordConfirmation;
        if (email == "" || !/[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$/.test(email) || email.length > 50) {
            return false;
        }
        if (!(tel == "") && !/^[0-9]{10}$/.test(tel)) {
            return false;
        }
        if (password == "" || password.length < 8 || password.length > 40) {
            return false;
        }
        if (password != passwordConfirmation) {
            return false;
        }
        return true;
    }
    function validateStep3(data) {
        var prenom = data.prenom;
        var nom = data.nom;
        var sexe = data.sexe;
        if (prenom == "" || prenom.length > 20) {
            return false;
        }
        if (nom == "" || nom.length > 30) {
            return false;
        }
        if (sexe == "") {
            return false;
        }
        return true;
    }
    function validateStep4(data) {
        var pays = data.pays;
        var ville = data.ville;
        var adresse = data.adresse;
        if (pays == "") {
            return false;
        }
        if (ville == "" || ville.length > 30) {
            return false;
        }
        if (adresse == "" || adresse.length > 60) {
            return false;
        }
        return true;
    }
    $("#username").blur(function() {
        var input=$(this);
        var re = /^[A-Za-z0-9]+$/;
        var is_alphanumeric=re.test(input.val());
        var username = $(this).val();
        $.ajax({
            type: "POST",
            url: "./BackEnd/VerifUsername.php",
            data: {username: username},
            success: function(response) {
                $(".error").remove();
                if (response == "exists" || !is_alphanumeric) {
                    $("#username").removeClass("valid").addClass("invalid");
                    if(response == "exists"){
                        $("#username").after("<span class='error'>Le pseudo est déja pris</span>");
                    } else {
                        $("#username").after("<span class='error'>Le pseudo ne doit contenir que des lettres et chiffres</span>");
                    }
                } else {
                    $("#username").removeClass("invalid").addClass("valid");
                }
            }
        });
    });
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
        if(password.length < 8 || password.length > 40){
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
            formData.append('username', document.getElementById('username').value);
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
            formData.append('profileImage', fileField.files[0]);
            fetch('./BackEnd/ValidationInscription.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert(data.success);
                    window.location.href = './index.php';
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