<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $passport_type = $_POST['passport-type'];
	$expiry_date = $_POST['expiry_date'];
    $issue_date = $_POST['issue_date'];

    // Handle file uploads (implement file handling as needed)
	// File handling for photo, aadhar, and address proof
    $photo = $_FILES['photo']['name'];
    $aadhar_card = $_FILES['aadhar-card']['name'];
    $address_proof = $_FILES['address-proof']['name'];
    
    // File upload destination
    $target_dir = "uploads/";
    
    // Move uploaded files to the uploads directory
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $photo);
    move_uploaded_file($_FILES["aadhar-card"]["tmp_name"], $target_dir . $aadhar_card);
    move_uploaded_file($_FILES["address-proof"]["tmp_name"], $target_dir . $address_proof);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "your_database");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	$profileData = null; // Initialize profile data

    // $stmt = $conn->prepare("INSERT INTO fresh (user_id, name, dob, address, state, email, phone, gender, passport_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("sssssssss", $user_id, $name, $dob, $address, $state, $email, $phone, $gender, $passport_type);

	$stmt = "INSERT INTO renewal (user_id,name, dob, address, email, phone, gender, passport_type, expiry_date, issue_date, photo, aadhar_card, address_proof)
            VALUES ('$user_id','$name', '$dob', '$address', '$email', '$phone', '$gender', '$passport_type','$expiry_date', '$issue_date', '$photo', '$aadhar_card', '$address_proof')";
    // if ($stmt->execute()) {
    //     echo "Application submitted successfully.";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

	if ($conn->query($stmt) === TRUE) {
        // Get the ID of the last inserted record
        $last_id = $conn->insert_id;

        // Redirect to profile.php to display the recently inserted data
        header("Location: profilenew1.php?id=$last_id");
        exit();
    } else {
        echo "Error: " . $stmt . "<br>" . $conn->error;
    }

	$id = $_POST['id'] ?? $user_id; // Use user_id if id is not set
$sql = "SELECT * FROM renewal WHERE id = ?";
$sql = $conn->prepare($sql);
$sql->bind_param("s", $id);
$sql->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "No data found!";
}
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>    
    <title>Renewal Passport</title>
    <link rel="stylesheet" type="text/css" href="renewal.css">
    <script src="renewal.js"></script>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('renewalform');
            //let isSubmitting = false; // Flag to track manual submission

            form.addEventListener('submit', (e) => {
              //  if (isSubmitting) return; // If already submitting, don't run validation again
                e.preventDefault();

                var name = document.getElementById("name").value;
                var dob = document.getElementById("dob").value; 
                let address = document.getElementById("address").value;
                let email = document.getElementById("email").value;
                const phone = document.querySelector('#phone').value.trim();
                const genderElements = document.getElementsByName('gender');
                const passportNumber = document.getElementById("passport-number").value;
                const expirydate = document.getElementById("expiry-date").value.trim();
                const issueDate = document.getElementById("issue-date").value.trim();
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

                if (name === "" || name === null) {
                    alert("Please enter name.");
                    return false;
                } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                    alert("Name should not be a number.");
                    return false;
                } else if (dob === "" || dob === null) {
                    alert("Please enter date of birth.");
                    return false;
                } else if (new Date(dob) > new Date()) {
                    alert("Date of birth should not be in the future.");
                    return false;
                } else if (address === "" || address === null) {
                    alert("Please enter your address.");
                    return false;
                } else if (email === "" || email === null) {
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
                } else if (passportNumber === "") {
                    alert("Please enter your passport number.");
                    return false;
                } else if (expirydate === "") {
                    alert("Please enter expiry date.");
                    return false;
                } else if (new Date(expirydate) < new Date()) {
                    alert("Expiry date should not be in the future.");
                    return false;
                } else if (issueDate === "" || issueDate === null) {
                    alert("Please enter your issue date.");
                    return false;
                } else if (new Date(issueDate) > new Date()) {
                    alert("Issue date should not be in the future.");
                    return false;
                } else if (new Date(expirydate) < new Date(issueDate)) {
                    alert("Expiry date should be after issue date.");
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
                    form.submit(); // Trigger form submission after validation
                    return true;
                }
            });
        });
    </script> -->





</head>
<body>
    <div id="header">
        <h1>Renewal Passport Application</h1>
        <p>Your User ID: <?php echo htmlspecialchars($user_id); ?></p>
    </div>

    <!-- Form -->
    <form id="renewalform" action="renewal.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <!-- Left Side -->
        <div class="left-side">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br>
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob"><br><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br><br>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone"><br><br>
            
            <label for="gender">Gender:</label>
            <input type="radio" id="male" name="gender" value="male"> Male
            <input type="radio" id="female" name="gender" value="female"> Female
            <input type="radio" id="others" name="gender" value="others"> Others <br><br>
        </div>

        <!-- Right Side -->
        <div class="right-side">
            <label for="passport-type">Type of Passport:</label>
            <select id="passport-type" name="passport-type">
                <option value="">Select Type</option>
                <option value="ordinary">Ordinary</option>
                <option value="diplomatic">Diplomatic</option>
                <option value="official">Official</option>
                <option value="tatkal">Tatkal</option>
                <option value="child">Child</option>
                <option value="seniorcitizen">Senior Citizen</option>
            </select>
            <label for="expiry-date">Expiry Date:</label>
            <input type="date" id="expiry-date" name="expiry_date" ><br><br>

            <label for="issue-date">Issue Date:</label>
            <input type="date" id="issue-date" name="issue_date" ><br><br>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo"><br><br>
            <label for="aadhar-card">Aadhar Card:</label>
            <input type="file" id="aadhar-card" name="aadhar-card"><br><br>
            <label for="address-proof">Address Proof:</label>
            <input type="file" id="address-proof" name="address-proof">
        </div>

        <!-- Submit Button -->
        <input type="submit" id="submitbutton" value="Submit">
    </form>



    <!-- <script>
        function validateForm() {
            const name = document.getElementById("name").value.trim();
            const dob = document.getElementById("dob").value;
            const address = document.getElementById("address").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const genderElements = document.getElementsByName('gender');
            const passportType = document.getElementById("passport-type").value;
            const expiryDate = document.getElementById("expiry-date").value;
            const issueDate = document.getElementById("issue-date").value;
            const photo = document.getElementById("photo").value;
            const aadharCard = document.getElementById("aadhar-card").value;
            const addressProof = document.getElementById("address-proof").value;
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            let genderSelected = false;
            for (let i = 0; i < genderElements.length; i++) {
                if (genderElements[i].checked) {
                    genderSelected = true;
                    break;
                }
            }

            if (name === "") {
                alert("Please enter name.");
                return false;
            } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                alert("Name should not contain numbers or special characters.");
                return false;
            } else if (dob === "") {
                alert("Please enter date of birth.");
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
                alert("Please select a gender.");
                return false;
            } else if (passportType === "") {
                alert("Please select a passport type.");
                return false;
            } else if (expiryDate === "") {
                alert("Please enter expiry date.");
                return false;
            } else if (new Date(expiryDate) < new Date()) {
                alert("Expiry date should not be in the past.");
                return false;
            } else if (issueDate === "") {
                alert("Please enter your issue date.");
                return false;
            } else if (new Date(issueDate) > new Date()) {
                alert("Issue date should not be in the future.");
                return false;
            } else if (new Date(expiryDate) < new Date(issueDate)) {
                alert("Expiry date should be after the issue date.");
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
            }
            return true;
        }
    </script> -->


</body>
</html>
