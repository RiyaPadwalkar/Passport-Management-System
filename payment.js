document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('PaymentForm');
    let isSubmitting = false; // Flag to track manual submission

    form.addEventListener('submit', (e) => {
        if (isSubmitting) return; // If already submitting, don't run validation again
        e.preventDefault();

        var name = document.getElementById("name").value;
        var passportNumber = document.querySelector("#passport-number").value;
        const Type = document.getElementById("type").value;
        const cardNumber = document.querySelector("#card-number").value;
        const expirydate = document.getElementById("expiry-date").value.trim();
        const cvv = document.getElementById("cvv").value;

        function showAmountAlert() {
            let amount;
            if (Type === "Fresh_Passport") {
                amount = "100";
            } else if (Type === "Renewal") {
                amount = "50";
            } else {
                alert("Please select a valid type.");
                return false;
            }
            alert("The amount for the selected type is: " + amount);
        }

        if (name === "") {
            alert("Please enter your name.");
            return false;
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            alert("Name should not be a number.");
            return false;
        } else if (passportNumber === "") {
            alert("Please enter your passport number.");
            return false;
        } else if (passportNumber.length != 8) {
            alert("Invalid passport number.");
            return false;
        } else if (Type === "") {
            alert("Please select your type.");
            return false;
        } else if (cardNumber === "") {
            alert("Please enter your card number.");
            return false;
        } else if ((cardNumber.length) != 16) {
            alert("Card number should be 16 digits.");
            return false;
        } else if (expirydate === "") {
            alert("Please enter expiry date.");
            return false;
        } else if (new Date(expirydate) < new Date()) {
            alert("Expiry date should not be in the past.");
            return false;
        } else if (cvv === "") {
            alert("Please enter your CVV.");
            return false;
        } else if (cvv.length != 3) {
            alert("CVV should be 3 digits.");
            return false;
        } else {
            showAmountAlert();
            alert("Form submitted successfully!");
            isSubmitting = true;
            form.submit();
            return true;
        }
    });
});
