<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>popup</title>
        <link rel="stylesheet" href="pop.css">
    </head>
    <body>
        <div class="container">
            <h1>CONFORM YOUR SUBMISSION</h1>
            <style>
                h1{
                    margin-bottom:290px;
                    margin-right:60px;
                    position:fixed;
                    font-size: 1.2rem;
                    font-weight: bold;
                    background-color: transparent;
                    border: 1px solid #F1F8E9;
                    padding: 10px 40px;
                    border-radius: 25px;
                    cursor: pointer;
                    transition: 0.3s;
                    background-color: #8BC34A;
                    border-color: #8BC34A;
                    box-shadow: 0 0 50px #8BC34A;
                }
            </style>
            <button type="submit" class="btn" onclick="openpopup()">Submit</button>
            <button type="submit" class="btn" onclick="openpopup()"><a href="index.html">Cancel</button></a>
            <style>
                button {
                    margin-right:50px ;
                    text-decoration:none;

                }
            </style>

            
            <div class="popup" id="popup">
                <img src="404-tick.png" alt="tick">
                    <h2>Thank you!</h2>
                    <p>Your submission has been received.</p>
                    <button type="button" onclick="closepopup()"><a href="index.html">OK</button></a>
                </div>
        </div>
        <script>
            let popup = document.getElementById('popup');
            function openpopup(){
                popup.classList.add("open-popup");
            }
            function closepopup(){
                popup.classList.remove("open-popup");
            }
        </script>
    </body>
</html>


<?php
$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "feedback_db";   
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
