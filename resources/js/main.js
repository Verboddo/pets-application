$(document).ready(function(){
    $('#pet-form').on('submit', function(e) {
        e.preventDefault();

        var url = $(this).attr('action');
        // Haal gegevens op uit het formulier
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
                    console.log(response);
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
        // var object = $(this);

        console.log(url);

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
                    console.log(response);
                    // object.parents("tr").remove();
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
});
