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
    $state = $_POST['state'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $passport_type = $_POST['passport-type'];

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

	$stmt = "INSERT INTO fresh (user_id,name, dob, address, state, email, phone, gender, passport_type, photo, aadhar_card, address_proof)
            VALUES ('$user_id','$name', '$dob', '$address', '$state', '$email', '$phone', '$gender', '$passport_type', '$photo', '$aadhar_card', '$address_proof')";
    // if ($stmt->execute()) {
    //     echo "Application submitted successfully.";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

	if ($conn->query($stmt) === TRUE) {
        // Get the ID of the last inserted record
        $last_id = $conn->insert_id;

        // Redirect to profile.php to display the recently inserted data
        header("Location: profilenew.php?id=$last_id");
        exit();
    } else {
        echo "Error: " . $stmt . "<br>" . $conn->error;
    }

	$id = $_POST['id'] ?? $user_id; // Use user_id if id is not set
$sql = "SELECT * FROM fresh WHERE id = ?";
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
	<title>Fresh Passport</title>
	<link rel="stylesheet" type="text/css" href="fresh_passport.css">
    <script src="fresh_passport.js"></script>

</head>
<body>
	<div id="header">
		<h1>Fresh Passport Application</h1>
		<p>Your User ID: <?php echo htmlspecialchars($user_id); ?></p>
		
	</div>

	<!-- Form -->
	<form id="freshform" action="fresh.php" method="post" enctype="multipart/form-data">
		<!-- Left Side -->
		<div class="left-side">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name"><br><br>
			<label for="dob">Date of Birth:</label>
			<input type="date" id="dob" name="dob"><br><br>
			<label for="address">Address:</label>
			<input type="text" id="address" name="address"><br><br>
			<label for="state">State:</label>
			<select id="state" name="state">
				<option value="Andhra Pradesh">Andhra Pradesh</option>
				<option value="Arunachal Pradesh">Arunachal Pradesh</option>
				<option value="Assam">Assam</option>
				<option value="Bihar">Bihar</option>
				<option value="Chhattisgarh">Chhattisgarh</option>
				<option value="Goa">Goa</option>
				<option value="Gujarat">Gujarat</option>
				<option value="Haryana">Haryana</option>
				<option value="Himachal Pradesh">Himachal Pradesh</option>
				<option value="Jharkhand">Jharkhand</option>
				<option value="Karnataka">Karnataka</option>
				<option value="Kerala">Kerala</option>
				<option value="Madhya Pradesh">Madhya Pradesh</option>
				<option value="Maharashtra">Maharashtra</option>
				<option value="Manipur">Manipur</option>
				<option value="Meghalaya">Meghalaya</option>
				<option value="Mizoram">Mizoram</option>
				<option value="Nagaland">Nagaland</option>
				<option value="Odisha">Odisha</option>
				<option value="Punjab">Punjab</option>
				<option value="Rjasthan">Rjasthan</option>
				<option value="Sikkim">Sikkim</option>
				<option value="Tamil Nadu">Tamil Nadu</option>
				<option value="Telangana">Telangana</option>
				<option value="Tripura">Tripura</option>
				<option value="Uttar Pradesh">Uttar Pradesh</option>
				<option value="uttarakhand">uttarakhand</option>
				<option value="West Bengal">West Bengal</option>
			</select><br><br>
			<label for="email">Email:</label>
			<input type="email" id="email" name="email"><br><br>
		</div>
		<!-- Right Side -->
		<div class="right-side">
			<label for="phone">Phone Number:</label>
			<input type="tel" id="phone" name="phone"><br><br>
			
            <label for="gender">Gender:</label>
			<input type="radio" id="male" name="gender" value="male"> Male
		    <input type="radio" id="female" name="gender" value="female"> female
			<input type="radio" id="others" name="others" value="others"> Others <br><br>
			<label for="passport-type">Type of Passport:</label>
			<select id="passport-type" name="passport-type" oninput="ptype(this)">
				<option value="">Select Type</option>
				<option value="ordinary">Ordinary</option>
				<option value="diplomatic">Diplomatic</option>
				<option value="official">Official</option>
				<option value="tatkal">Tatkal</option>
				<option value="child">Child</option>
				<option value="seniorcitizen">Senior Citizen</option>
			</select>
			<label for="photo">Photo:</label>
			<input type="file" id="photo" name="photo"><br><br>
			<label for="aadhar-card">Aadhar Card:</label>
			<input type="file" id="aadhar-card" name="aadhar-card"><br><br>
			<label for="address-proof">Address Proof:</label>
			<input type="file" id="address-proof" name="address-proof">
		</div>
		<!-- Submit Button -->
		<input type="submit" id="submitbutton" value="Submit" >
	</form>
	
</body>
</html>
