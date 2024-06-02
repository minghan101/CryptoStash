<?php
    session_start();

    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
        <!-- Add the JavaScript code here -->
        <script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('/cryptocurrency') // Sends a GET request to the /cryptocurrency endpoint of the Flask backend
            .then(response => response.json()) // Converts the response to JSON format
            .then(data => { // Handles the JSON data
                const container = document.getElementById('crypto-container'); // Finds the HTML element with the id 'crypto-container'
                data.forEach(coin => { // Iterates over each cryptocurrency object in the data array
                    const coinElement = document.createElement('div'); // Creates a new <div> element
                    coinElement.innerHTML = `${coin.symbol}: $${coin.price}`; // Sets the inner HTML of the <div> element with the cryptocurrency symbol and price
                    container.appendChild(coinElement); // Appends the <div> element to the 'crypto-container'
                });
            })
            .catch(error => console.error('Error fetching data:', error)); // Logs any errors that occur during the fetch request
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">CryptoStash</a></p>
        </div>

        <div class="right-links">

        <?php
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_id = $result['Id'];
        }

        echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
        ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname ?></b>, Welcome!</p>
                </div>
                <!--
                <div class="box">
                    <p>Your email is <b>123@gmail.com</b>.</p>
                </div>
                -->
            </div>
            <!--
            <div class="bottom">
                <div class="box">
                    <p>And you are <b>20 years old</b>.</p>
                </div>
            </div>
            -->
        </div>
    </main>

    <div class="coin-list">
        <div class="coin">
            <img src="images/bitcoin.png">
            <div>
                <h3>$<span id="bitcoin"></span></h3>
                <p>BTC</p>
            </div>
        </div>

        <div class="coin">
            <img src="images/ethereum.png">
            <div>
                <h3>$<span id="ethereum"></span></h3>
                <p>ETH</p>
            </div>
        </div>

    </div>

<script src="script.js"></script>
</body>
</html>