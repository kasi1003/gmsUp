$(document).ready(function () {
    // Fetch service provider data from the PHP script using AJAX
    // Use relative path to the PHP file (starting from the "gms1" folder)
    $.getJSON("../php/serviceProvidersPage.php", function (data) {
        console.log(data); // Log the received data in the console

        var tableBody = $("#serviceProvidersTableBody");

        // Iterate through the data and dynamically create table rows
        $.each(data, function (index, provider) {
            var row = $("<tr>").attr("id", "clickable-row").css("cursor", "pointer");
            row.append($("<td>").text(index + 1));
            row.append($("<td>").text(provider.service_provider_name));
            row.append($("<td>").text(provider.total_burials));
            row.append($("<td>").text(provider.successful_burials));
            row.append($("<td>").text(provider.unsuccessful_burials));

            tableBody.append(row);
        });
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
        // Go up one level to the root directory, then go to the 'php' folder
        var redirectURL = "../php/companyPage.php?service_provider_name=" + encodeURIComponent(serviceProviderName);
    
        // Redirect to the detail page
        window.location.href = redirectURL;
    });

   
});
