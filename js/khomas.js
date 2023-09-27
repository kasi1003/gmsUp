document.addEventListener("DOMContentLoaded", function () {
  

  // Get the region name from the query parameter
  const urlParams = new URLSearchParams(window.location.search);
  const regionName = urlParams.get("region");

  // Function to fetch and display cemeteries for the selected region
  function fetchCemeteriesByRegion() {
    // Construct the URL for the PHP script that generates JSON data
    const jsonUrl = `../php/khomas.php?region=${regionName}`;

    // Fetch cemetery data in JSON format directly from the PHP script
    fetch(jsonUrl)
      .then((response) => response.json())
      .then((data) => {
        // Get the table body element
        const tableBody = document.getElementById("display");
        tableBody.innerHTML = ""; // Clear previous content

        // Populate the table body with JSON data
        data.forEach((cemetery) => {
          const row = document.createElement("tr");
          row.innerHTML = `
          <td>${cemetery.CemeteryName}</td>
          <td>${cemetery.AvailableGraves}</td>
          <td>${cemetery.TotalGraves}</td>
          <td>${cemetery.Location}</td>
        `;
          tableBody.appendChild(row);
        });
      })
      .catch((error) => {
        console.error("Error fetching data:", error);
      });
  }

  // Call the fetchCemeteriesByRegion function to fetch and display the data
  fetchCemeteriesByRegion();

  $(document).ready(function () {
    // Add event listener for the search input field
    $("#searchInput").on("input", function () {
      // Get the search query value
      var query = $(this).val().toLowerCase();

      // Filter the table rows based on the query
      $("#display tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
      });
    });
  });


  // Add event listener for the clickable rows with the class "redirect-row"
  document.querySelectorAll(".redirect-row").forEach(function (row) {
    row.addEventListener("click", function () {
      //window.location.href = "../html/cemeteryMap.html"; // Replace with the actual target URL
      alert("Row clicked!"); // Test to see if the click event is fired
    });
  });
});
