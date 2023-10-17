// Function to fetch grave data from the PHP script
async function fetchGraveDataFromPHP() {
    try {
        const response = await fetch('../php/cemeteryMap.php'); // Update the URL to the correct path
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching grave data from PHP:', error);
        return [];
    }
}

// Function to update the available graves on the SVG
async function updateGraveCount() {
    const graveData = await fetchGraveDataFromPHP();
    // Loop through the grave data and update the corresponding SVG elements
    graveData.forEach(grave => {
        // Assuming each grave has a "section_code" field
        const sectionId =  grave.section_code;;
        // Access the SVG element directly by the sectionId (path ID)
        const sectionElement = document.getElementById(sectionId);

        // Only update the available graves for sections that have a matching ID
        if (sectionElement) {
            // Create a new SVG text element for the available graves count
            const textElement = document.createElementNS("http://www.w3.org/2000/svg", "text");
            // Set the position and style of the text element
            textElement.setAttribute('x', '50'); // Adjust the x-coordinate as needed
            textElement.setAttribute('y', '50'); // Adjust the y-coordinate as needed
            textElement.setAttribute('fill', 'white'); // Set the text color to white
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
document.addEventListener('DOMContentLoaded', () => {
    startAutoUpdate();
});

// Toggle between SVG and Google Maps
document.getElementById('mapToggle').addEventListener('change', function () {
    const svgMap = document.getElementById('svgMap');
    const googleMap = document.getElementById('googleMap');

    if (this.checked) {
        // Show Google Maps and hide SVG
        svgMap.style.display = 'none';
        googleMap.style.display = 'block';
    } else {
        // Show SVG and hide Google Maps
        svgMap.style.display = 'block';
        googleMap.style.display = 'none';
    }
});
  // Toggle between SVG and Google Maps
  document.getElementById('mapToggle').addEventListener('change', function () {
    const svgMap = document.getElementById('svgMap');
    const googleMap = document.getElementById('googleMap');

    if (this.checked) {
        // Hide SVG and show Google Maps
        svgMap.style.display = 'none';
        googleMap.style.display = 'block';
        updateToggleLabel('Switch to Simple Map');
    } else {
        // Show SVG and hide Google Maps
        svgMap.style.display = 'block';
        googleMap.style.display = 'none';
        updateToggleLabel('Switch to Google Maps');
    }
});

// Change text on the radio button click
document.getElementById('mapToggle').addEventListener('change', function () {
    if (this.checked) {
        updateToggleLabel('Switch to Simple Map');
    } else {
        updateToggleLabel('Switch to Google Maps');
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