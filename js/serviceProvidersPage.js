$(document).ready(function () {
    // Fetch service provider data from the PHP script using AJAX
    $.getJSON("../php/serviceProvidersPage.php?fetch=true", function (data) {
        console.log(data); // Log the received data in the console

        if (data.error) {
            console.error('Error:', data.error);
            return;
        }

        var tableBody = $("#serviceProvidersTableBody");

        // Clear any existing rows
        tableBody.empty();

        // Iterate through the data and dynamically create table rows
        $.each(data, function (index, providers) {
            var row = $("<tr>").css("cursor", "pointer");
            row.append($("<td>").text(index + 1));
            row.append($("<td>").text(providers.Name));
            row.append($("<td>").text(providers.Email));
            row.append($("<td>").text(providers.ContactNumber));
            row.append($("<td>").text(providers.TotalBurials));
            row.append($("<td>").text(providers.UnsuccessfulBurials));
            row.append($("<td>").text(providers.SuccessfulBurials));

            tableBody.append(row);
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX request failed:", textStatus, errorThrown);
    });

    // Add event listener for the search input field
    $("input[type='text']").on("input", function () {
        // Get the search query value
        var query = $(this).val().toLowerCase();

        // Filter the table rows based on the query
        $("#serviceProvidersTableBody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
        });
    });

    // Add event listener for the table rows
    $("#serviceProvidersTableBody").on("click", "tr", function () {
        var serviceProviderName = $(this).find("td:eq(1)").text();

        // Construct the URL to the companyPage.php page using the appropriate relative path
        var redirectURL = "../php/companyPage.php?service_provider_name=" + encodeURIComponent(serviceProviderName);

        // Redirect to the detail page
        window.location.href = redirectURL;
    });
});
