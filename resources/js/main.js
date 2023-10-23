$(document).ready(function(){
    $('#pet-form').on('submit', function(e) {
        e.preventDefault();

        // Haal gegevens op uit het formulier
        var url = $(this).attr('action');
        let name = $(this).find('#name').val();
        let type = $(this).find('#type').val();
        let address = $(this).find('#address').val();

        // Maak een JavaScript-object
        let formData = {
            name: name,
            type: type,
            address: address
        };

        // Converteer het object naar JSON
        let jsonData = JSON.stringify(formData);

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type:'POST',
                url: url,
                data: jsonData,
                dataType: 'json',
                processData: false,
                contentType: 'application/json',
                success: (response) => {
                    $('.pet-table-container').html(response.html);
                },
                error: (response) => {
                    let errorMessages = [];

                    // Loop door de validatiefouten en voeg ze toe aan het array
                    $.each(response.responseJSON.errors, function(key, value) {
                        errorMessages.push(value);
                    });

                    // Toon de foutberichten in een alert
                    if (errorMessages.length > 0) {
                        alert("Er zijn validatiefouten opgetreden:\n" + errorMessages.join("\n"));
                    }
                }
        });
    });

    $('body').on('click', '.delete-pet', function(e) {
        e.preventDefault();

        var url = $(this).data('url');

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type:'DELETE',
                url: url,
                dataType: 'json',
                processData: false,
                contentType: 'application/json',
                success: (response) => {
                    $('.pet-table-container').html(response.html);
                },
                error: (response) => {
                    let errorMessages = [];

                    // Loop door de validatiefouten en voeg ze toe aan het array
                    $.each(response.responseJSON.errors, function(key, value) {
                        errorMessages.push(value);
                    });

                    // Toon de foutberichten in een alert
                    if (errorMessages.length > 0) {
                        alert("Er zijn validatiefouten opgetreden:\n" + errorMessages.join("\n"));
                    }
            }
        });
    });

    function loadUsers(page) {
        $.ajax({
            url: '/get-pets?page=' + page,
            method: 'GET',
            success: function(response) {
                $('.pet-table-container').html(response.html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Initial load
    loadUsers(1);

    // Voeg event listeners toe voor paginaklikken
    $('body').on('click', '[aria-label="Pagination Navigation"] a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        loadUsers(page);
    });
});
