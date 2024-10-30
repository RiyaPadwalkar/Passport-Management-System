// Get all input fields
var inputs = document.querySelectorAll('input');

// Add event listener to each input field
inputs.forEach(function(input) {
	input.addEventListener('blur', function() {
		// Check if input field is empty
		if (input.value === '') {
			input.classList.add('error');
			input.nextElementSibling.textContent = 'This field is required';
		} else {
			input.classList.remove('error');
			input.nextElementSibling.textContent = '';
		}
	});
});

// Get all select fields
var selects = document.querySelectorAll('select');

// Add event listener to each select field
selects.forEach(function(select) {
	select.addEventListener('change', function() {
		// Check if select field is empty
		if (select.value === '') {
			select.classList.add('error');
			select.nextElementSibling.textContent = 'This field is required';
		} else {
			select.classList.remove('error');
			select.nextElementSibling.textContent = '';
		}
	});
});

// Get all radio buttons
var radios = document.querySelectorAll('input[type="radio"]');

// Add event listener to each radio button
radios.forEach(function(radio) {
	radio.addEventListener('change', function() {
		// Check if radio button is selected
		if (radio.checked) {
			radio.parentNode.classList.remove('error');
			radio.parentNode.nextElementSibling.textContent = '';
		} else {
			radio.parentNode.classList.add('error');
			radio.parentNode.nextElementSibling.textContent = 'This field is required';
		}
	});
});

// Get all file inputs
var files = document.querySelectorAll('input[type="file"]');

// Add event listener to each file input
files.forEach(function(file) {
	file.addEventListener('change', function() {
		// Check if file input is empty
		if (file.value === '') {
			file.classList.add('error');
			file.nextElementSibling.textContent = 'This field is required';
		} else {
			file.classList.remove('error');
			file.nextElementSibling.textContent = '';
		}
	});
});

// Get submit button
var submitButton = document.querySelector('input[type="submit"]');

// Add event listener to submit button
submitButton.addEventListener('click', function(event) {
	// Prevent default form submission
	event.preventDefault();

	// Check if all fields are filled
	if (document.querySelectorAll('.error').length === 0) {
		// Submit form
		document.querySelector('form').submit();
	} else {
		// Show error message
		alert('Please fill all required fields');
	}
});