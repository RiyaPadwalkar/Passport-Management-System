document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('freshform');
    let isSubmitting = false; // Flag to track manual submission
  
    form.addEventListener('submit', (e) => {
        if (isSubmitting) return; // If already submitting, don't run validation again
        e.preventDefault()
        const name = document.getElementById("name").value.trim();
        const dob = document.getElementById("dob").value;
        const address = document.getElementById("address").value.trim();
        const email = document.getElementById("email").value.trim();
        const phone = document.querySelector('#phone').value.trim();
        const genderElements = document.getElementsByName('gender');
        const state = document.querySelector('#state');
        const passportType = document.querySelector('#passport-type').value;
        const photo = document.querySelector('#photo').value.trim();
        const aadharCard = document.querySelector('#aadhar-card').value.trim();
        const addressProof = document.querySelector('#address-proof').value.trim();
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        let genderSelected = false;
        for (let i = 0; i < genderElements.length; i++) {
            if (genderElements[i].checked) {
                genderSelected = true;
                break;
            }
        }

        // Validation logic
        if (name === "") {
            alert("Please enter your name.");
            return false;
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            alert("Name should only contain alphabets.");
            return false;
        } else if (dob === "") {
            alert("Please enter your date of birth.");
            return false;
        } else if (new Date(dob) > new Date()) {
            alert("Date of birth should not be in the future.");
            return false;
        } else if (address === "") {
            alert("Please enter your address.");
            return false;
        } else if (email === "") {
            alert("Please enter your email.");
            return false;
        } else if (!emailRegex.test(email)) {
            alert("Invalid email format.");
            return false;
        } else if (phone === "" || isNaN(phone) || phone.length !== 10) {
            alert("Invalid phone number. It should be 10 digits.");
            return false;
        } else if (!genderSelected) {
            alert('Please select a gender.');
            return false;
        } else if (state.value === '') {
            alert('Please select a state.');
            return false;
        } else if (passportType === "") {
            alert("Please select your passport type.");
            return false;
        } else if (photo === "") {
            alert("Please upload your photo.");
            return false;
        } else if (aadharCard === "") {
            alert("Please upload your Aadhar card.");
            return false;
        } else if (addressProof === "") {
            alert("Please upload your address proof.");
            return false;
        } else {
            alert("Form submitted successfully!");
            isSubmitting = true;
            form.submit();
            return true;// Trigger form submission after validation
        }
    });
});
