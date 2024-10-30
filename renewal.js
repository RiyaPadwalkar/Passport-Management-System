
        // function validateForm() {
        //     const name = document.getElementById("name").value.trim();
        //     const dob = document.getElementById("dob").value;
        //     const address = document.getElementById("address").value.trim();
        //     const email = document.getElementById("email").value.trim();
        //     const phone = document.getElementById("phone").value.trim();
        //     const genderElements = document.getElementsByName('gender');
        //     const passportType = document.getElementById("passport-type").value;
        //     const expiryDate = document.getElementById("expiry-date").value;
        //     const issueDate = document.getElementById("issue-date").value;
        //     const photo = document.getElementById("photo").value;
        //     const aadharCard = document.getElementById("aadhar-card").value;
        //     const addressProof = document.getElementById("address-proof").value;
        //     const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        //     let genderSelected = false;
        //     for (let i = 0; i < genderElements.length; i++) {
        //         if (genderElements[i].checked) {
        //             genderSelected = true;
        //             break;
        //         }
        //     }

        //     if (name === "") {
        //         alert("Please enter name.");
        //         return false;
        //     } else if (!/^[a-zA-Z\s]+$/.test(name)) {
        //         alert("Name should not contain numbers or special characters.");
        //         return false;
        //     } else if (dob === "") {
        //         alert("Please enter date of birth.");
        //         return false;
        //     } else if (new Date(dob) > new Date()) {
        //         alert("Date of birth should not be in the future.");
        //         return false;
        //     } else if (address === "") {
        //         alert("Please enter your address.");
        //         return false;
        //     } else if (email === "") {
        //         alert("Please enter your email.");
        //         return false;
        //     } else if (!emailRegex.test(email)) {
        //         alert("Invalid email format.");
        //         return false;
        //     } else if (phone === "" || isNaN(phone) || phone.length !== 10) {
        //         alert("Invalid phone number. It should be 10 digits.");
        //         return false;
        //     } else if (!genderSelected) {
        //         alert("Please select a gender.");
        //         return false;
        //     } else if (passportType === "") {
        //         alert("Please select a passport type.");
        //         return false;
        //     } else if (expiryDate === "") {
        //         alert("Please enter expiry date.");
        //         return false;
        //     } else if (new Date(expiryDate) < new Date()) {
        //         alert("Expiry date should not be in the past.");
        //         return false;
        //     } else if (issueDate === "") {
        //         alert("Please enter your issue date.");
        //         return false;
        //     } else if (new Date(issueDate) > new Date()) {
        //         alert("Issue date should not be in the future.");
        //         return false;
        //     } else if (new Date(expiryDate) < new Date(issueDate)) {
        //         alert("Expiry date should be after the issue date.");
        //         return false;
        //     } else if (photo === "") {
        //         alert("Please upload your photo.");
        //         return false;
        //     } else if (aadharCard === "") {
        //         alert("Please upload your Aadhar card.");
        //         return false;
        //     } else if (addressProof === "") {
        //         alert("Please upload your address proof.");
        //         return false;
        //     }
        //     return true;
        // }


        // document.addEventListener('DOMContentLoaded', function() {
        //     const form = document.getElementById('renewalform');
        //     //let isSubmitting = false; // Flag to track manual submission

        //     form.addEventListener('submit', (e) => {
        //       //  if (isSubmitting) return; // If already submitting, don't run validation again
        //         e.preventDefault();

        //         var name = document.getElementById("name").value;
        //         var dob = document.getElementById("dob").value; 
        //         let address = document.getElementById("address").value;
        //         let email = document.getElementById("email").value;
        //         const phone = document.querySelector('#phone').value.trim();
        //         const genderElements = document.getElementsByName('gender');
        //         const passportNumber = document.getElementById("passport-number").value;
        //         const expirydate = document.getElementById("expiry-date").value.trim();
        //         const issueDate = document.getElementById("issue-date").value.trim();
        //         const photo = document.querySelector('#photo').value.trim();
        //         const aadharCard = document.querySelector('#aadhar-card').value.trim();
        //         const addressProof = document.querySelector('#address-proof').value.trim();
        //         const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        //         let genderSelected = false;
        //         for (let i = 0; i < genderElements.length; i++) {
        //             if (genderElements[i].checked) {
        //                 genderSelected = true;
        //                 break;
        //             }
        //         }

        //         if (name === "" || name === null) {
        //             alert("Please enter name.");
        //             return false;
        //         } else if (!/^[a-zA-Z\s]+$/.test(name)) {
        //             alert("Name should not be a number.");
        //             return false;
        //         } else if (dob === "" || dob === null) {
        //             alert("Please enter date of birth.");
        //             return false;
        //         } else if (new Date(dob) > new Date()) {
        //             alert("Date of birth should not be in the future.");
        //             return false;
        //         } else if (address === "" || address === null) {
        //             alert("Please enter your address.");
        //             return false;
        //         } else if (email === "" || email === null) {
        //             alert("Please enter your email.");
        //             return false;
        //         } else if (!emailRegex.test(email)) {
        //             alert("Invalid email format.");
        //             return false;
        //         } else if (phone === "" || isNaN(phone) || phone.length !== 10) {
        //             alert("Invalid phone number. It should be 10 digits.");
        //             return false;
        //         } else if (!genderSelected) {
        //             alert('Please select a gender.');
        //             return false;
        //         } else if (passportNumber === "") {
        //             alert("Please enter your passport number.");
        //             return false;
        //         } else if (expirydate === "") {
        //             alert("Please enter expiry date.");
        //             return false;
        //         } else if (new Date(expirydate) < new Date()) {
        //             alert("Expiry date should not be in the future.");
        //             return false;
        //         } else if (issueDate === "" || issueDate === null) {
        //             alert("Please enter your issue date.");
        //             return false;
        //         } else if (new Date(issueDate) > new Date()) {
        //             alert("Issue date should not be in the future.");
        //             return false;
        //         } else if (new Date(expirydate) < new Date(issueDate)) {
        //             alert("Expiry date should be after issue date.");
        //             return false;
        //         } else if (photo === "") {
        //             alert("Please upload your photo.");
        //             return false;
        //         } else if (aadharCard === "") {
        //             alert("Please upload your Aadhar card.");
        //             return false;
        //         } else if (addressProof === "") {
        //             alert("Please upload your address proof.");
        //             return false;
        //         } else {
        //             alert("Form submitted successfully!");
        //             isSubmitting = true;
        //             form.submit(); // Trigger form submission after validation
        //             return true;
        //         }
        //     });
        // });
    
    


		document.getElementById("renewalform").onsubmit = function () {
			return validateForm();
		};
		
		function validateForm() {
			let isValid = true;
		
			// Get form fields
			const name = document.getElementById("name").value.trim();
			const dob = document.getElementById("dob").value;
			const address = document.getElementById("address").value.trim();
			const email = document.getElementById("email").value.trim();
			const phone = document.getElementById("phone").value.trim();
			const gender = document.querySelector("input[name='gender']:checked");
			const passportType = document.getElementById("passport-type").value;
			const expiryDate = document.getElementById("expiry-date").value;
			const issueDate = document.getElementById("issue-date").value;
			const photo = document.getElementById("photo").value;
			const aadharCard = document.getElementById("aadhar-card").value;
			const addressProof = document.getElementById("address-proof").value;
		
			// Helper function to display alert and mark form as invalid
			function displayAlert(message) {
				alert(message);
				isValid = false;
			}
		
			// Validate each field
			if (!name || !/^[a-zA-Z\s]+$/.test(name)) {
				displayAlert("Please enter a valid name without numbers or special characters.");
			}
			if (!dob) {
				displayAlert("Please enter your date of birth.");
			}
			if (!address) {
				displayAlert("Please enter your address.");
			}
			if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
				displayAlert("Please enter a valid email address.");
			}
			if (!phone || !/^\d{10}$/.test(phone)) {
				displayAlert("Please enter a valid 10-digit phone number.");
			}
			if (!gender) {
				displayAlert("Please select a gender.");
			}
			if (!passportType) {
				displayAlert("Please select a passport type.");
			}
			if (!expiryDate) {
				displayAlert("Please enter the expiry date of the passport.");
			}
			if (!issueDate) {
				displayAlert("Please enter the issue date of the passport.");
			}
			if (!photo) {
				displayAlert("Please upload a photo.");
			}
			if (!aadharCard) {
				displayAlert("Please upload an Aadhar card.");
			}
			if (!addressProof) {
				displayAlert("Please upload an address proof.");
			}
		
			return isValid;
		}
		