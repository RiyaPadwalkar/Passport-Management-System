document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('appointmentForm');
  let isSubmitting = false; // Flag to track manual submission

  form.addEventListener('submit', (e) => {
      if (isSubmitting) return; // If already submitting, don't run validation again
      e.preventDefault()
const name = document.getElementById("name").value;
const dob = document.getElementById("dob").value;
const address = document.getElementById("address").value;
const email = document.getElementById("email").value;
const appointmentDate = document.getElementById("appointment-date").value;
const time = document.getElementById("time").value;
const appointmentType = document.getElementById("appointment-type").value;
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;	

if (name == "" || name ==null) {
 alert("Please enter your name.");
 return false;
} else if (!/^[a-zA-Z\s]+$/.test(name)) {
  alert("Name should not be a number.");
  return false;
} else if (dob == "" || dob ==null) {
 alert("Please enter your date of birth.");
 return false;
} else if (new Date(dob) > new Date()) {
  alert("Date of birth should not be in the future.");
  return false;
} else if (address == "" || address == null) {
  alert("Please enter your address.");
  return false;
} else if (email == "") {
  alert("Please enter your email.");
  return false;
} else if (!emailRegex.test(email)) {
 alert("Invalid email format.");
 return false;
} else if (appointmentDate == "") {
 alert("Please enter your appointment date.");
 return false;
} else if (new Date(appointmentDate) < new Date()) {
 alert("Appointment date should not be in the past.");
 return false;
} else if (time == "") {
 alert("Please select your time.");
 return false;
} else if (appointmentType == "") {
 alert("Please select your appointment type.");
 return false;
} else {
  alert("Form submitted successfully!");
  isSubmitting = true;
  form.submit();
  return true;
  
}
});
});