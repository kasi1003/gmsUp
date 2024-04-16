// burialRecords.js

// Sample burial records data (replace this with your actual data)
var burialRecordsData = [
    // Sample data goes here
];

// Function to populate burial records table
function populateBurialRecordsTable() {
    var burialRecordsTableBody = document.getElementById("burialRecordsTableBody");
    burialRecordsTableBody.innerHTML = ''; // Clear previous data
    burialRecordsData.forEach(function(record) {
        var newRow = document.createElement('tr');
        newRow.innerHTML = '<td>' + record.Region + '</td>' +
            '<td>' + record.Town + '</td>' +
            '<td>' + record.Cemetery + '</td>' +
            '<td>' + record.Section + '</td>' +
            '<td>' + record.RowID + '</td>' +
            '<td>' + record.GraveNumber + '</td>';
        burialRecordsTableBody.appendChild(newRow);
    });
}

// Function to search burial records based on input
function searchBurialRecords(inputValue) {
    var filteredRecords = [];
    // Loop through burial records data to find matches
    burialRecordsData.forEach(function(record) {
        // Check if the input value matches the name or death code
        if (record.Name === inputValue || record.DeathCode === inputValue) {
            filteredRecords.push(record);
        }
    });
    return filteredRecords;
}

// Event listener for input field
var searchInput = document.getElementById("searchInput");
searchInput.addEventListener('input', function() {
    var inputValue = this.value.trim();
    if (inputValue !== '') {
        // If input value is not empty, search burial records
        var filteredRecords = searchBurialRecords(inputValue);
        if (filteredRecords.length > 0) {
            // If matches found, populate the burial records table with the filtered records
            populateBurialRecordsTable(filteredRecords);
        } else {
            // If no matches found, clear the burial records table
            populateBurialRecordsTable([]);
        }
    } else {
        // If input value is empty, populate the burial records table with all records
        populateBurialRecordsTable();
    }
});
