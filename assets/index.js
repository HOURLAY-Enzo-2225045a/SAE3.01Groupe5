$(document).ready(function(){
    $(document).on("click", ".star", function(){
        console.log("click");
        // Toggle l'état rempli/vide de l'étoile
        var filled = !$(this).data("filled");
        $(this).data("filled", filled);
        // Récupérer l'ID du joueur associé
        var spartiateId = $(this).data("spartiate-id");
        // Mettre à jour l'image en fonction de l'état rempli/vide
        var imageUrl = filled ? "/assets/images/fullStar.svg" : "/assets/images/emptyStar.svg";
        $(this).attr("src", imageUrl);

        $.ajax({
            type: "POST",
            url: "/index.php",
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
        var searchTerm = $(this).val();

        if (searchTerm.length > 0){
            // envoie la requete ajax
            $.ajax({
                type: "POST",
                url: "/index.php",
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
        var searchTerm = $(this).val();

        if (searchTerm.length > 0){
            // envoie la requete ajax
            $.ajax({
                type: "POST",
                url: "/index.php",
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


});

function checkSessionCode() {
    var code = $('#code').val();

    // Requête AJAX
    $.ajax({
        type: 'POST',
        url: 'check_code.php',
        data: {
            action: "checkCode",
            code: code
        },
        success: function(response) {
            console.log(response);
        },
    });
}






