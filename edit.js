// Fetch user details from the server based on User ID
function fetchDetails() {
	let userid = document.getElementById("userid").value;

	if (userid) {
		// AJAX request to fetch data
		let xhr = new XMLHttpRequest();
		xhr.open("POST", "fetch_user.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		xhr.onload = function () {
			if (this.status === 200) {
				let data = JSON.parse(this.responseText);
				
				// Fill fields with data from server
				document.getElementById("name").value = data.name;
				document.getElementById("dob").value = data.dob;
				document.getElementById("address").value = data.address;
				document.getElementById("state").value = data.state;
				document.getElementById("email").value = data.email;
				document.getElementById("phone").value = data.phone;
			} else {
				alert("Failed to fetch data. Please check the User ID.");
			}
		};

		xhr.send(`userid=${userid}`);
	}
}

// Enable specific field for editing
function enableField(fieldId) {
	let field = document.getElementById(fieldId);
	if (field) {
		field.removeAttribute("readonly");
		field.removeAttribute("disabled");
		field.focus();
	}
}

// Validation functions
function validateName() {
	let nameField = document.getElementById("name");
	let regex = /^[A-Za-z\s]+$/;

	if (!regex.test(nameField.value)) {
		alert("Name should contain only alphabets and spaces.");
		nameField.focus();
		return false;
	}
	return true;
}

function validateDOB() {
	let dobField = document.getElementById("dob");
	let dob = new Date(dobField.value);
	let today = new Date();

	if (dob > today) {
		alert("Date of birth cannot be in the future.");
		dobField.focus();
		return false;
	}
	return true;
}

function validateEmail() {
	let emailField = document.getElementById("email");
	let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	if (!regex.test(emailField.value)) {
		alert("Please enter a valid email address.");
		emailField.focus();
		return false;
	}
	return true;
}

function validatePhone() {
	let phoneField = document.getElementById("phone");
	let regex = /^\d{10}$/;

	if (!regex.test(phoneField.value)) {
		alert("Phone number must be 10 digits.");
		phoneField.focus();
		return false;
	}
	return true;
}

// Save changes after validation
document.getElementById("editform").onsubmit = function () {
	return validateName() && validateDOB() && validateEmail() && validatePhone();
};
