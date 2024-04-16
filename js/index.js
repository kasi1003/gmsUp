$(document).ready(function () {
  // Fetch service provider names from the PHP script
  $.getJSON("../php/index.php", function (data) {
    // Dynamically populate the dropdown menu
    var dropdownMenu = $("#serviceProvidersDropdown");

    // Create a container for the service provider links
    var linksContainer = $("<div>");

    // Append individual service provider links to the container
    $.each(data, function (index, serviceProvider) {
      var link = $("<a>")
        .attr(
          "href",
          "index.html?provider=" + encodeURIComponent(serviceProvider)
        )
        .addClass("dropdown-item")
        .text(serviceProvider);
      linksContainer.append(link);
    });

    // Append the container with the service provider links to the dropdown menu
    dropdownMenu.append(linksContainer);

    // Create the "View More" link and append it to the dropdown menu
    var viewMoreLink = $("<a>")
      .attr("href", "../html/serviceProvidersPage.html") // Set href to "#" for now
      .addClass("dropdown-item view-more") // Add the "view-more" class
      .text("View More");

    dropdownMenu.append(viewMoreLink);
  });

  // Define the relative path to the PHP file from the HTML file
  const phpPath = "../php/khomas.php";

  // Get all the SVG paths with class 'map'
  const mapPaths = document.querySelectorAll(".map");

  // Add a click event listener to each path
  mapPaths.forEach((path) => {
    path.addEventListener("click", function () {
      // Get the 'name' attribute of the clicked path (region name)
      const region = this.getAttribute("name");

      // Redirect to the PHP file with the selected region as a parameter
      window.location.href = phpPath + "?region=" + region;
    });
  });

  // Event listener for burial records search form submission
  $('#searchForm').submit(function(event) {
    event.preventDefault(); // Prevent form submission

    // Get the input value (full name or death code)
    var searchTerm = $('#searchInput').val();

    // AJAX call to fetch burial records based on the input
    $.ajax({
      url: 'burialrecords.php', // Adjust the URL accordingly
      type: 'GET',
      data: { search: searchTerm }, // Send the search term as a parameter
      dataType: 'json',
      success: function(response) {
        // Display burial records in a responsive table
        displayBurialRecords(response);
      },
      error: function(xhr, status, error) {
        console.error('Error fetching burial records:', error);
      }
    });
  });

  // Function to display burial records in a responsive table
  function displayBurialRecords(records) {
    var resultsDiv = $('.results');
    // Clear previous results
    resultsDiv.empty();

    // Check if any records were found
    if (records.length > 0) {
      // Create a table element with Bootstrap classes for responsiveness
      var table = $('<table>').addClass('table table-responsive');

      // Create table headers
      var headers = $('<thead>').append(
        $('<tr>').append(
          $('<th>').text('Region'),
          $('<th>').text('Town'),
          $('<th>').text('Cemetery'),
          $('<th>').text('Section'),
          $('<th>').text('Row ID'),
          $('<th>').text('Grave Number')
        )
      );
      table.append(headers);

      // Create table body
      var tbody = $('<tbody>');
      records.forEach(function(record) {
        var row = $('<tr>').append(
          $('<td>').text(record.region),
          $('<td>').text(record.town),
          $('<td>').text(record.cemetery),
          $('<td>').text(record.section),
          $('<td>').text(record.rowID),
          $('<td>').text(record.graveNumber)
        );
        tbody.append(row);
      });
      table.append(tbody);

      // Append the table to the results div
      resultsDiv.append(table);
    } else {
      // Display message if no records were found
      resultsDiv.text('No burial records found.');
    }
  }
});
