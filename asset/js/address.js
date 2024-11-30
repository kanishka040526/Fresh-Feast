document.addEventListener('DOMContentLoaded', function() {
    const existingAddressRadio = document.getElementById('use_existing_address');
    const newAddressRadio = document.getElementById('use_new_address');
    const billingDetails = document.getElementById('billing-details');
    const existingDetails = document.getElementById('existing_address_hide');

    existingAddressRadio?.addEventListener('click', function() {
        billingDetails.style.display = 'none';
        existingDetails.style.display = "block";
    });

    newAddressRadio?.addEventListener('click', function() {
        billingDetails.style.display = 'block';
        existingDetails.style.display = "none";
    });
});