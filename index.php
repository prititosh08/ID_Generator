<!DOCTYPE html>
<html>
<head>
    <!-- <title>Form Validation</title> -->
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var PRN = document.getElementById("PRN").value;
            var dob = document.getElementById("Date").value;

            if (PRN == "" || dob == "") {
                alert("PRN and Date Of Birth are required.");
                return false;
            }

            else{
                window.location.href = "index1.php";
            }

            return false;
        }
    </script>
</head>
<body>

<?php
$errors = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate PRN
    if (empty($_POST["name"])) {
        $errors[] = "PRN is required";
    } else {
        $name = test_input($_POST["name"]);
        // Check if PRN contains only uppercase letters, digits, and no white space
        if (!preg_match("/^[A-Z0-9]*$/", $name)) {
            $errors[] = "Only uppercase letters and digits are allowed, and no white space allowed";
        }
    }

    // Validate date
    if (empty($_POST["Date"])) {
        $errors[] = "Date is required";
    } else {
        $Date = test_input($_POST["Date"]);
        // Check if date is valid
        if (!validateDate($Date)) {
            $errors[] = "Invalid date format. Please use YYYY-MM-DD";
        }
    }

    // If no errors, verify data in the database
    if (empty($errors)) {
        // Connect to the database
        $servername = "localhost"; // Change this if your database is on a different server
        $username = "root"; // Change this to your database username
        $password = ""; // Change this to your database password
        $dbname = "college_id_card"; // Change this to your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL query
        $sql = "SELECT * FROM user WHERE name = '$name' AND Date = '$Date'";
        $result = $conn->query($sql);

        // Check if data exists in the database
        if ($result->num_rows > 0) {
            // Data exists in the database
            // Redirect to the next page
            header("Location: index1.php");
            exit();
        } else {
            // Data does not exist in the database
            $errors[] = "Data does not exist in the database";
        }

        // Close connection
        $conn->close();
    }

    // Display errors
    if (!empty($errors)) {
        echo "<h2>Form submission failed:</h2>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate date
function validateDate($Date) {
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $Date);
    return $d && $d->format($format) == $Date;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <p style="text-align:center;">Enter Your Information</p>
    PRN: <input type="text" name="name"><br><br>
    Date of Birth: <input type="date" name="Date"><br><br>
    <input type="submit" name="submit" value="Submit" onclick="validateForm()" class="link-button">
</form>

</body>
</html>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <!-- <form action="index.php" method="post" onsubmit="return validateForm()">
    <p style="text-align: center;">Enter your information</p>
    <br><br>
    <?php
        if($insert == true){
            echo "Thanks for submitting your information";
        }
    ?>
        <input type="text" style="text-align: center;" id="name" name="name" placeholder = "Enter PRN" required><br><br>
        <input type="date" style="text-align: center;" id="Date" name="Date" required><br>
        <input type="submit" value="Submit" onclick="validateForm()" class="link-button">
        <a href="index1.php">Submit</a>
    </form> -->
</body>
</html>