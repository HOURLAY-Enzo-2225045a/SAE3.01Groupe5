$(document).ready(function(){
    $(document).on("click", ".star", function(){
        console.log("click");
        // Toggle l'état rempli/vide de l'étoile
        let filled = !$(this).data("filled");
        $(this).data("filled", filled);
        // Récupérer l'ID du joueur associé
        let spartiateId = $(this).data("spartiate-id");
        // Mettre à jour l'image en fonction de l'état rempli/vide
        let imageUrl = filled ? "/assets/images/fullStar.svg" : "/assets/images/emptyStar.svg";
        $(this).attr("src", imageUrl);

        $.ajax({
            type: "POST",
            url: "/controls/actionController.php",
            data: {
                action: "changeStar",
                spartiateId: spartiateId
            },
            dataType: "json",
            success: function (response) {
            }
        });
    });

    $("#searchQuestion").on('input', function() {
        // recupere ce qui est ecrit dans la barre de recherche
        let searchTerm = $(this).val();

        if (searchTerm.length > 0){
            // envoie la requete ajax
            $.ajax({
                type: "POST",
                url: "/controls/actionController.php",
                data: {
                    action: "searchQuestion",
                    searchTerm: searchTerm
                },
                success: function (result) {
                    // affiche le resultat de la recherche
                    if (result === "")
                        result = "Aucun résultat";
                    $('.result').hide()
                    $('.searchedResult').show().html(result);
                }
            });
        }else{
            $('.searchedResult').hide()
            $('.result').show()
        }
    });

    $("#searchSpartiate").on('input', function() {
        // recupere ce qui est ecrit dans la barre de recherche
        let searchTerm = $(this).val();

        if (searchTerm.length > 0){
            // envoie la requete ajax
            $.ajax({
                type: "POST",
                url: "/controls/actionController.php",
                data: {
                    action: "searchSpartiate",
                    searchTerm: searchTerm
                },
                success: function (result) {
                    // affiche le resultat de la recherche
                    if (result === "")
                        result = "Aucun résultat";
                    $('.result').hide()
                    $('.searchedResult').show().html(result);
                }
            });
        }else{
            $('.searchedResult').hide()
            $('.result').show()
        }
    });

    $("#verificationForm").submit(function(e){
        e.preventDefault(); //empêcher une action par défaut
        // Récupérer l'URL du formulaire et la méthode
        let form_url = $(this).attr("action");
        let form_method = $(this).attr("method");

        // Encoder les éléments du formulaire et ajouter la letiable action
        let form_data = $(this).serialize()

        // Effectuer la requête AJAX
        $.ajax({
            url: form_url,
            type: form_method,
            data: form_data
        }).done(function(response){
            if(response.success) {
                // Si l'authentification est réussie, changer l'URL et recharger la page
                window.location.href = response.url;
            } else {
                // Si l'authentification échoue, afficher l'erreur
                $("#res").html(response.error);
            }
        });
    });

    $("#form:not(.test)").submit(function(e){
        e.preventDefault(); //empêcher une action par défaut
        // Récupérer l'URL du formulaire et la méthode
        let form_url = $(this).attr("action");
        let form_method = $(this).attr("method");

        // Encoder les éléments du formulaire et ajouter la letiable action
        let form_data = $(this).serialize()

        // Effectuer la requête AJAX
        $.ajax({
            url: form_url,
            type: form_method,
            data: form_data
        }).done(function(response){
            window.location.href = response;
        });
    });

});





