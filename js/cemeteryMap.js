document.addEventListener("DOMContentLoaded", function () {
    console.log('Script is running...');
  
    // Get all rows with the class "redirect-row"
    const redirectRows = document.querySelectorAll('.redirect-row');
  
    // Add click event listener to each row
    redirectRows.forEach(row => {
      row.addEventListener('click', function () {
        // Extract CemeteryID and SectionID from the row's data attributes
        const cemeteryID = this.getAttribute('data-cemetery-id');
        const sectionID = this.getAttribute('data-section-id');
  
        // Construct the URL with CemeteryID and SectionID
        const redirectURL = `../php/cemeteriesBooking.php?cemetery_id=${cemeteryID}&section_id=${sectionID}`;
  
        // Redirect to the specified URL
        window.location.href = redirectURL;
      });
    });
  });
  