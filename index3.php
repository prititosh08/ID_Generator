<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID GENERATOR</title>
    <style>
        body {
            background-image: url('college.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        .content-wrapper {
            position: relative;
        }

        .content {
            background-color: #FFFFFF;
            border: 1px solid #000;
            padding: 20px;
            text-align: center;
            position: relative;
            max-width: 600px;
            margin: 0 auto;
            z-index: 1;
        }

        .green-line {
            border: 3px solid green;
            margin: 20px auto;
            width: 100%;
        }

        .upper-left-image {
            position: absolute;
            top: 15px;
            left: 20px;
            width: 80px;
            height: auto;
            z-index: 2;
        }

        .status {
            margin-top: 1px;
        }

        .fetched-data {
            margin-top: 40px;
            padding: 20px;
            border: 2px solid #ccc;
        }

        .fetched-data p {
            margin: 5px 0;
            text-align: left;
        }

        .download-box {
            margin-top: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            text-align: center;
        }

        #downloadBtn {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #downloadBtn:hover {
            background-color: #3e8e41;
        }

        .download-box {
            display: block;
        }

        @media print {
            .download-box {
                display: none;
            }

            @page {
                margin: 0;
            }

            body {
                margin: 0;
                padding: 0;
            }
        }
    </style>

</head>

<body>
    <div class="content-wrapper">
        <div class="content" style="height: 50%px;">
            <div class="container">
                <a href="https://www.dkte.ac.in" target="_blank">
                    <img src="logo.png" alt="Image" class="upper-left-image">
                </a>
                <p>D.K.T.E SOCIETY's</p>
                <p><b>TEXTILE & ENGINEERING INSTITUTE</b></p>
                <p>ICHALKARANJI</p>
                <hr class="green-line">
            </div>
            <div class="status">
                <p>AN AUTONOMOUS INSTITUTE</p>
                <hr class="green-line">
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "college_id_card";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql_fetch = "SELECT * FROM id ORDER BY sr_no DESC LIMIT 1"; // Assuming 'id' is your auto-increment primary key column
                    $result = $conn->query($sql_fetch);

                    if ($result === false) {
                        // Error handling
                        echo "Error: " . $sql_fetch . "<br>" . $conn->error;
                    } else {
                        if ($result->num_rows > 0) {
                            // Output data of the last inserted row
                            $row = $result->fetch_assoc();
                            echo "<div class='fetched-data'>";
                            echo "<p><img src=' " . $row["std_img"] ."' height='100px' width='75px'></p>";
                            echo "<p>Name: " . $row["name"] . "</p>";
                            echo "<p>Date: " . $row["Date"] . "</p>";
                            echo "<p>PRN: " . $row["PRN"] . "</p>";
                            echo "<p>Program: " . $row["Program"] . "</p>";
                            echo "<p>Email: " . $row["email"] . "</p>";
                            echo "<p>Phone: " . $row["phone"] . "</p>";
                            echo "<p>Blood Group: " . $row["Blood"] . "</p>";
                            echo "</div>";
                        } else {
                            echo "<p>No results found.</p>";
                        }
                    }

                    $conn->close();
                    ?>

            </div>
        </div>

        <div class="download-box">
            <button id="downloadBtn">Download ID</button>
        </div>
    </div>
    <script>
        document.getElementById('downloadBtn').addEventListener('click', function () {
            window.print();
        });
    </script>

</body>

</html>