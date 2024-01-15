document.addEventListener("DOMContentLoaded", function () {
  // Add this script to your existing JavaScript or in a separate script tag

  // Get all paths and table rows
  const paths = document.querySelectorAll(".cem-section");
  const rows = document.querySelectorAll("tbody tr");

  // Attach hover events to paths
  paths.forEach((path, index) => {
    path.addEventListener("mouseover", () => {
      // Highlight the associated row
      rows[index].classList.add("highlighted-row");
    });

    path.addEventListener("mouseout", () => {
      // Remove the highlight from the associated row
      rows[index].classList.remove("highlighted-row");
    });
  });

  // Attach hover events to table rows
  rows.forEach((row, index) => {
    row.addEventListener("mouseover", () => {
      // Highlight the associated path
      paths[index].classList.add("highlighted-path");
    });

    row.addEventListener("mouseout", () => {
      // Remove the highlight from the associated path
      paths[index].classList.remove("highlighted-path");
    });
  });

  function fetchGraveSections() {
    // Retrieve CemeteryID from the URL
    const cemeteryID = getCemeteryID();

    // Construct the URL for fetching grave_sections data
    const sectionsUrl = `../php/cemeteryMap.php?cemetery_id=${cemeteryID}`;

    // Fetch grave_sections data in JSON format from the PHP script
    fetch(sectionsUrl)
      .then((response) => {
        console.log("Response status:", response.status);
        return response.text();
      })
      .then((data) => {
        console.log("Raw response data:", data); // Log the raw data

        // Parse the JSON data
        try {
          const jsonData = JSON.parse(data);

          // Get the table body element
          const tableBody = document.getElementById("table-div");
          tableBody.innerHTML = ""; // Clear previous content

          // Populate the table body with grave_sections data
          jsonData.forEach((section) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                  <td>${section.SectionCode}</td>
                  <td>${section.AvailableGraves}</td>
                `;
            tableBody.appendChild(row);
          });
        } catch (error) {
          console.error("Error parsing JSON data:", error);
        }
      })
      .catch((error) => {
        console.error("Error fetching grave_sections data:", error);
      });
  }

  // Function to retrieve the cemetery ID from the URL
  function getCemeteryID() {
    // Your code for retrieving the cemetery ID goes here
    // For example, you can use the URLSearchParams to get the "cemetery_id" parameter
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get("cemetery_id");
  }

  // Call the fetchGraveSections function to fetch and display the data
  fetchGraveSections();

  // Rest of your JavaScript code...

  // Rest of your JavaScript code...

  // Function to update the available graves on the SVG
  async function updateGraveCount() {
    const graveData = await fetchGraveDataFromPHP();
    // Loop through the grave data and update the corresponding SVG elements
    graveData.forEach((grave) => {
      // Assuming each grave has a "section_code" field
      const sectionId = grave.section_code;
      // Access the SVG element directly by the sectionId (path ID)
      const sectionElement = document.getElementById(sectionId);

      // Only update the available graves for sections that have a matching ID
      if (sectionElement) {
        // Create a new SVG text element for the available graves count
        const textElement = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "text"
        );
        // Set the position and style of the text element
        textElement.setAttribute("x", "50"); // Adjust the x-coordinate as needed
        textElement.setAttribute("y", "50"); // Adjust the y-coordinate as needed
        textElement.setAttribute("fill", "white"); // Set the text color to white
        textElement.textContent = `Available: ${grave.available_graves}/${grave.total_graves}`;

        // Append the text element to the SVG path
        sectionElement.appendChild(textElement);
      }
    });
  }

  // Function to periodically update the grave count (every 10 seconds in this example)
  function startAutoUpdate() {
    // Initial update
    updateGraveCount();

    // Set up a timer to update the data every 10 seconds
    setInterval(updateGraveCount, 10000); // Update every 10 seconds (adjust as needed)
  }

  // Add an event listener to trigger the updateGraveCount function when the page is loaded
  document.addEventListener("DOMContentLoaded", () => {
    startAutoUpdate();
  });

  // Toggle between SVG and Google Maps
  document.getElementById("mapToggle").addEventListener("change", function () {
    const svgMap = document.getElementById("svgMap");
    const googleMap = document.getElementById("googleMap");

    if (this.checked) {
      // Show Google Maps and hide SVG
      svgMap.style.display = "none";
      googleMap.style.display = "block";
    } else {
      // Show SVG and hide Google Maps
      svgMap.style.display = "block";
      googleMap.style.display = "none";
    }
  });
  // Toggle between SVG and Google Maps
  document.getElementById("mapToggle").addEventListener("change", function () {
    const svgMap = document.getElementById("svgMap");
    const googleMap = document.getElementById("googleMap");

    if (this.checked) {
      // Hide SVG and show Google Maps
      svgMap.style.display = "none";
      googleMap.style.display = "block";
      updateToggleLabel("Switch to Simple Map");
    } else {
      // Show SVG and hide Google Maps
      svgMap.style.display = "block";
      googleMap.style.display = "none";
      updateToggleLabel("Switch to Google Maps");
    }
  });

  // Change text on the radio button click
  document.getElementById("mapToggle").addEventListener("change", function () {
    if (this.checked) {
      updateToggleLabel("Switch to Simple Map");
    } else {
      updateToggleLabel("Switch to Google Maps");
    }
  });

  // Function to update the toggle switch label
  function updateToggleLabel(text) {
    const toggleLabel = document.querySelector('label[for="mapToggle"]');
    toggleLabel.textContent = text;
  }
  //google maps
  let map;

  async function initMap() {
    const { Map } = await google.maps.importLibrary("maps");

    map = new Map(document.getElementById("googleMap"), {
      center: { lat: -34.397, lng: 150.644 },
      zoom: 20,
    });
  }

  initMap();
});
