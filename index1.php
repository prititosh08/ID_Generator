<?php
$insert = false;
if(isset($_POST['name'])){
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);
    if(!$con){
        die("Connection to this database failed due to ".
        mysqli_connect_error());
    }
    // echo "Sucess connecting to DataBase";


    $filename =  $_FILES["uploadfile"]["name"];
    $tempname =  $_FILES["uploadfile"]["tmp_name"];
    $folder = "images/".$filename;
    // echo $folder;
    move_uploaded_file($tempname,$folder);




    $name = $_POST['name'];
    $Date = $_POST['Date'];
    $PRN = $_POST['PRN'];
    $Program = $_POST['Program'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $Blood = $_POST['Blood'];
    $sql = "INSERT INTO `college_id_card`.`id` (`std_img`,`name`, `Date`, `PRN`, `Program`, `email`, `phone`, `Blood`)
    VALUES ('$folder','$name', '$Date', '$PRN', '$Program','$email', '$phone', '$Blood');" ;
    // echo $sql;

    if($con->query($sql) == true){
        //  echo "Sucessfully inserted";
        $insert = true;
        header("location:index2.php");
    }
    else{
        echo "ERROR : $sql <br> $con->error";
    }
    $con->close();
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page for student ID</title>
    <link rel="stylesheet" href="style_home.css">

    <script>
        // function redirectToNextPage() {
        //     location.href = "page.html";
        // }

        function validateForm() {
            var First_Name = document.getElementById("Name").value;
            var PRN = document.getElementById("PRN").value;

            if (First_Name == "" || PRN == "") {
                alert("Name and PRN are required.");
                return false;
            }

            else{
                window.location.href = "index2.php";
            }

            return false;
        }
    </script>
</head>
<body>
    <div class="header">
        <div class="logoutclass">
            <a href="login.html" class="logout">Logout</a>
        </div>

        <div>
            <a href="settings.html" class="logout">Settings</a>
        </div>

    </div>
    
    <div>
        <form action="index1.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

            <div class="container">
            <p>Enter your information</p>
                <?php
                    if($insert == true){
                    echo "<p class = 'submitMsg'> Thanks for submitting your information </p>";
                    }
                ?>

                <p class="content">Image for ID:</p>
                <input type="file" id="name" name="uploadfile"><br>
                <!-- <label for="First Name" class="content">First Name :</label><br> -->
                <p class="content">Name :</p>
                <input type="text" id="name" name="name" required placeholder="Enter your Name"><br>

                <!-- <label for="date">Date Of Birth :</label><br> -->
                <p class="content">Date Of Birth :</p>
                <input type="date" id="Date Of Birth" name="Date" required><br>

                <!-- <label for="PRN">PRN :</label><br> -->
                <p class="content">PRN :</p>
                <input type="text" id="PRN" name="PRN" required><br>

                <!-- <label for="Program">Program :</label><br> -->
                <p class="content">Program :</p>
                <input type="text" id="Program" name="Program" required><br>

                <p class="content">Email Id :</p>
                <input type="email" name="email" id="email" required placeholder="Enter email "><br>
                <!-- <button type="reset" value="Reset" onclick="myFunction()" >Clear Form</button>  -->

                <p class="content">Phone No. :</p>
                <input type="phone" name="phone" id="phone" required><br>

                <!-- <label for="Blood Group">Blood Group :</label><br>
                <input type="" id="Blood Group" name="Blood Group" required><br> -->

                <!-- <label for="Blood Group">Blood Group :</label><br> -->
                <p class="content">Blood Group :</p>
                <select id="Blood Group" name="Blood" required>
                    <option value="">Select Blood Group</option>
                    <option value="A+ve">A+ve</option>
                    <option value="A-ve">A-ve</option>
                    <option value="B+ve">B+ve</option>
                    <option value="B-ve">B-ve</option>
                    <option value="AB+ve">AB+ve</option>
                    <option value="AB-ve">AB-ve</option>
                    <option value="O+ve">O+ve</option>
                    <option value="O-ve">O-ve</option>
                </select><br>

                <input type="submit" value="Submit" onclick="validateForm()">
            </div>
        </form>
        <!-- INSERT INTO `id` (`name`, `Date Of Birth`, `PRN`, `Program`, `email`, `phone`, `Blood Group`)
        VALUES ('Priti Santoshkumar Toshniwal', '2004-02-08', '21UCS138', 'Computer Science and Engineering',
        'prititoshniwal8@gmail.com', '9665060227', 'O+ve'), ('Piyusha Pravin Tomke', '2003-10-02', '21UCS137',
        'Computer Science and Engineering', 'tomkepiyusha@gmail.com', '1234567890', 'O+ve'); -->
    </div>
</body>
</html>