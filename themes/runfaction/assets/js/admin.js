/**
 * @file admin.js
 * @brief Liste de fonctions permettant de gérer dans son intégralité les actions utilisateurs sur de pages admin.
 * 
 * @author Daumand David
 * @date 18/12/2023
 */

"use strict";

$(document).ready(function () {

    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
    $('#accordion1').on('hidden.bs.collapse', toggleChevron);
    $('#accordion1').on('shown.bs.collapse', toggleChevron);

    // Initialise les widgets de sélection de dates avec les options spécifiées
    /*$('#datetimepicker1').datetimepicker({
        locale: 'fr',
        format: 'L',
        viewMode: 'years',
        format: 'MM/YYYY',
    });
    $('#datetimepicker2').datetimepicker({
        locale: 'fr',
        format: 'L',
        viewMode: 'years',
        format: 'MM/YYYY',
    });*/

    let data = getRecherche();
    if (data != "") {
        let decodeData = JSON.parse(data);
        $('#collapse1').collapse();

        $('#critaria_search_date_option').val(decodeData.rc_searchType);
        $('#critaria_search_date_start').val(decodeData.rc_searchStartDate);
        $('#critaria_search_date_end').val(decodeData.rc_searchEndDate);
        $('#critaria_search_number_max').val(decodeData.rc_searchCountMax);
        $('#critaria_search_name').val(decodeData.rc_searchName);
        $('#critaria_search_firstname').val(decodeData.rc_searchFirstName);
        $('#critaria_role').val(decodeData.rc_searchRole).trigger("change");
        $('#critaria_search_state').val(decodeData.rc_searchState).trigger("change");

        $('#critaria_search_date_option').change();

        $('#critaria_search_info').css('display', 'block');

        showDateCritere( $('#critaria_search_date_option'));
    }

    make_table_users("");
    config_table_users();

    let dataPost = {
        rc_searchType: $('#critaria_search_date_option').val(),
        rc_searchStartDate: $('#critaria_search_date_start').val(),
        rc_searchEndDate: $('#critaria_search_date_end').val(),
        rc_searchRole: $('#critaria_role').val(),
        rc_searchCountMax: $('#critaria_search_number_max').val(),
        rc_searchState: $('#critaria_search_state').val(),
        rc_searchName: $('#critaria_search_name').val(),
        rc_searchFirstName: $('#critaria_search_firstname').val()
    };
   

    console.log(dataPost);

    ask_update_users(dataPost);

    $('#critaria_search_date_option').on('change', function () {
        showDateCritere($(this));
        $("#critaria_search_date_start").val("");
        $("#critaria_search_date_end").val("");
    });

    $('#collapse2').collapse();

    // Initialise les éléments de sélection de Select2
    $('.select2').select2();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

});

function make_table_users(data) 
{
    // Récupère l'élément HTML qui contiendra le tableau
    var table_users_id = $gdi('table_users');

    // Efface le contenu précédent de l'élément
    table_users_id.innerHTML = "";

    // Liste des titres de colonnes pour le tableau
    let title = ['Numéro', 'Date création', 'Nom', 'Prénom', 'Action(s)'];

    // Crée l'en-tête du tableau
    let thead = document.createElement('thead');
    let row = document.createElement('tr');
    for (var i = 0; i < title.length; i++) {
        let cell = document.createElement('th');
        cell.appendChild(document.createTextNode(title[i]));
        row.appendChild(cell);
    }
    thead.appendChild(row);

    // Crée le corps du tableau
    var tbody = document.createElement('tbody');
    
    if (data != null && data != "") {

        console.log(data);

        let response = data.body;

        // Parcours des données de réponse pour créer les lignes du tableau
        for (var i = 0; i < response.length; i++) {
            let row = document.createElement('tr');

            let idUsers = document.createElement('td');
            idUsers.innerText = response[i].number;

            let insertDateUsers = document.createElement('td');
            insertDateUsers.innerText = response[i].insertdate;

            let nomUsers = document.createElement('td');
            nomUsers.innerText = response[i].name;
           
            let prenomUsers = document.createElement('td');
            prenomUsers.innerText = response[i].firstname;

            let action = document.createElement('td');
            action.setAttribute('class', 'text-right py-0 align-middle');

            let buttonAction = "";

            if (response[i].hasModify == true) {
                buttonAction += '<a onclick="javascript:modify_user(\'' + response[i].uuid + '\')" data-toggle="tooltip" data-placement="top" title="Modifier l\'utilisateur" class="btn btn-success"><i class="fas fa-edit"></i></a>';
            }
            if (response[i].hasBanne == true) {
                buttonAction += '<a onclick="javascript:banne_user(\'' + response[i].uuid + '\')" data-toggle="tooltip" data-placement="top" title="Bannir l\'utilisateur" class="btn btn-secondary"><i class="fa fa-user-times"></i></a>';
            }
            if (response[i].hasCancel == true) {
                buttonAction += '<a onclick="javascript:cancel_user(\'' + response[i].uuid + '\')" data-toggle="tooltip" data-placement="top" title="Annuler l\'utilisateur" class="btn btn-danger"><i class="fa fa-ban"></i></a>';
            }
            if (response[i].hasDelete == true) {
                buttonAction += '<a onclick="javascript:delete_user(\'' + response[i].uuid + '\')" data-toggle="tooltip" data-placement="top" title="Supprimer l\'utilisateur" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
            }
        
            action.innerHTML = '<div class="btn-group btn-group-sm">' + buttonAction + '</div>';

            row.appendChild(idUsers);
            row.appendChild(insertDateUsers);
            row.appendChild(nomUsers);
            row.appendChild(prenomUsers);
            row.appendChild(action);

             // Ajoute la ligne au corps du tableau
            tbody.appendChild(row);
        }
    }
    // Ajoute l'en-tête et le corps au tableau
    table_users_id.appendChild(thead);
    table_users_id.appendChild(tbody);
}

function config_table_users() {
    $('#table_users').DataTable({
        fixedHeader: false,
        searching: true,
        paging: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        lengthMenu:[[10,25,50,-1],["10","25","50","Tout"]],
        buttons: [{
            extend: 'copy',
            text: 'Copier',
        },
        {
            extend: 'csv',
            text: 'CSV',
        },
        {
            extend: 'excel',
            text: 'Excel',
        },
        {
            extend: 'colvis',
            text: 'Visibilité colonnes',
        }],
        order: [[1, "desc"]],
        columnDefs: [{ "type": "date-euro", "targets": 1 }, {
            "render": function (data, type, row, meta) {
                return data;
            }, "targets": [1]
        }],
        language: {
            "search": "Rechercher:",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
            "infoFiltered": "(filtrées depuis un total de _MAX_ entrées)",
            "lengthMenu": "Afficher _MENU_ entrées",
            "paginate": {
                "first": "Première",
                "last": "Dernière",
                "next": "Suivante",
                "previous": "Précédente"
            },
            "zeroRecords": "Aucune entrée correspondante trouvée"
        }
    }).buttons().container().appendTo('#table_users_wrapper .col-md-6:eq(0)');
}

function update_users(data) 
{
    // Sélection de la table des utilisateurs à l'aide de la bibliothèque DataTables
    let table = $('#table_users').DataTable();
    // Si la table existe
    if (table != null) {
        // Destruction de la table existante pour préparer la mise à jour
        table.rows().remove().draw();
        table.destroy();
        $("#table_users").empty(); // Vide le contenu de la div contenant la table

        // Création de la nouvelle table avec les nouvelles données
        make_table_users(data);

        // Configuration de la table avec les nouvelles données
        config_table_users();
    }
}

function ask_update_users(dataPost)
{  
    $axios_getpost_timed('admin/users/get', dataPost, null, update_users, null);
}

function add_users()
{
    toastr.warning('Not implemented');
}

function show_page_add_users()
{
    window.location.href = window.location.origin + '/admin/user.php';
}

function reset_critere_recherche()
{
    setRecherche("");
    // Définit un message d'alerte
    setAlert("Les critères de recherche ont été effacés avec succès",'success');
    // Redirige vers la page principale
    location.reload();
}

function modify_user(uuid)
{
    toastr.warning('Not implemented='+ uuid);
}

function banne_user(uuid)
{
    toastr.warning('Not implemented='+ uuid);
}

function cancel_user(uuid)
{
    toastr.warning('Not implemented='+ uuid);
}

function delete_user(uuid)
{
    toastr.warning('Not implemented='+ uuid);
}

$('#critariaSearchForm').validate({
    // Définit les règles de validation pour chaque champ du formulaire
    rules: {
        // règles de validation (non spécifiées ici)
    },
    // Définit les messages d'erreur à afficher si une règle de validation n'est pas respectée
    messages: {
        // messages d'erreur (non spécifiés ici)
    },
    // Spécifie l'élément HTML à utiliser pour afficher les messages d'erreur
    errorElement: 'span',
    // Spécifie comment afficher les messages d'erreur
    errorPlacement: function (error, element) {
        // Ajoute la classe "invalid-feedback" à l'élément d'erreur et l'ajoute au groupe de formulaire le plus proche
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    // Spécifie comment mettre en évidence les champs non valides
    highlight: function (element, errorClass, validClass) {
        // Ajoute la classe "is-invalid" à l'élément non valide
        $(element).addClass('is-invalid');
    },
    // Spécifie comment retirer la mise en évidence des champs qui ont été corrigés
    unhighlight: function (element, errorClass, validClass) {
        // Retire la classe "is-invalid" de l'élément
        $(element).removeClass('is-invalid');
    },
    // Spécifie ce qui doit être fait lorsque le formulaire est soumis
    submitHandler: function (form) {

        // Démarre le compteur de temps d'exécution
        startExecutionTime();

        // Crée un objet avec les valeurs des champs de formulaire comme propriétés
        let dataPost = {
            rc_searchType: $('#critaria_search_date_option').val(),
            rc_searchStartDate: $('#critaria_search_date_start').val(),
            rc_searchEndDate: $('#critaria_search_date_end').val(),
            rc_searchRole: $('#critaria_role').val(),
            rc_searchCountMax: $('#critaria_search_number_max').val(),
            rc_searchState: $('#critaria_search_state').val(),
            rc_searchName: $('#critaria_search_name').val(),
            rc_searchFirstName: $('#critaria_search_firstname').val()
        };

        // Stocke les critères de recherche au format JSON
        setRecherche(JSON.stringify(dataPost));

        // Affiche l'élément contenant les informations de recherche
        $('#critaria_search_info').css('display', 'block');
      
        // Affiche un message de succès indiquant l'application des critères de recherche
        toastr.success("Les critères de recherche ont été appliqués avec succès");

        // Affiche un message informant l'utilisateur  sont en cours de recherche
        show_message_temporisation();

        // Effectue la recherche en utilisant les critères
        ask_update_users(dataPost);

    }
});