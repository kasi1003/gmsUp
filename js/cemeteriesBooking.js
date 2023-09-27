function calculateTotal() {
  // Get the user input value (quantity) and convert it to a number
  const graveNum = document.getElementById('graveNum');
  const quantity = parseInt(graveNum.value);

  // Check if the quantity is a valid number and greater than zero
  if (Number.isNaN(quantity) || quantity <= 0) {
    // Clear the button text if the quantity is invalid
    const checkoutBtn = document.getElementById('checkoutBtn');
    checkoutBtn.textContent = 'Checkout';
    return;
  }

  // Calculate the total amount
  const productCost = 1000;
  const totalAmount = quantity * productCost;

  // Update the checkout button's text with the total amount
  const checkoutBtn = document.getElementById('checkoutBtn');
  checkoutBtn.textContent = `Checkout - Total: $${totalAmount}`;

  // Optionally, you can enable or disable the button based on the validity of the quantity
  checkoutBtn.disabled = false;
}

var modal = document.getElementById('myModal');
var spanClose = document.getElementsByClassName("close")[0];
var requiredFields = document.getElementsByClassName("required").required;


btnSubmit.onclick = function() {
modal.style.display = "block";

}


spanClose.onclick = function() {
modal.style.display = "none";
}

window.onclick = function(event) {
   if (event.target == modal) {
    modal.style.display = "none";
  }
}