<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "htdb";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Close the database connection
$conn->close();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Heavenly Tomb|Home</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
</head>

<body>
    <?php
    include '../components/header.php'; // or include_once if you want to ensure it's included only once
    ?>

    <section class="main-image">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="card border-secondary bg-dark mt-5" style="min-height: 100px">
                        <div class="card-header border-secondary">
                            <h1 style="color: white; font-size: 3.5em">
                                Graveyard Management System
                            </h1>
                        </div>
                        <div class="card-body text-secondary">
                            <h1 class="find-a-cemetery-text">
                                Click a Region to view Cemeteries
                            </h1>
                            <div class="svg-container">
                                <svg baseprofile="tiny" fill="#7c7c7c" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" version="1.2" viewbox="0 0 1000 966" width="1000" xmlns="http://www.w3.org/2000/svg" id="svg-map">
                                    <path d="M610.1 687.8l0 17.3 0 9.2 0 18.4 0 4.6 0 23.1 0 9.2 0 18.5 0 4.6 0 23.2 0 9.3 0 28 0 4.7 0 32.7 0 9.4 0 17.4-0.1 2.5-2.3 0.5-0.7 0.1-2.4-0.3-0.8 0.1-2 1.1-3.3 3-2.1 0.6-3.6 0.3-1.7 0.6-1.4 1.1-1.3 0.7-7.4 0.6-0.6 0.2-0.8 0.5-0.9 1.2-0.7 0.9-0.4 0.6-0.6 1.6-0.5 0.3-0.7 0.3-0.4 0.7-2.1 6.7-0.8 1.3-1.3 1-1.5 0.7-6 1.5-1 0.5-0.8-0.1-1.8-1.5-1 0.1-1 0.8-0.8 1.2-1.3 2.4-0.3 1.7 0.5 1.9 2.8 4.8-0.1 1-0.8 0.5-2.5 0.2-0.4 0.3-0.8 1.4-0.6 0.6-4.2 2.2-3.1 1-2.8 0.2-1.3-1.6-0.3-0.4-0.8-0.3-2.6-0.3-0.5-0.2-0.8-0.9-1.8-2.9-1.3-1.2-15.4-2.3-14.1 2.1-2.7 1.5-1.6 0.5-0.3-0.2-0.9-0.8-0.3-0.2-0.4 0.1-0.7 0.4-0.4 0.1-1.4 0.3-0.8 0.2-0.6 0.4-1.4 0.6-1.8-0.3-3.1-1.2-1.7-0.1-6.4 1-2.7 0.9-1.3 0-6.2-2.2-2.9-1.5-4.4-3.8-2.5-1.6-2.7-1.1-12.3-2.7-2.4 0.2-0.8 0.3-1.4 1-0.8 0.4-0.9 0-2.4-0.6-1.6-0.8-0.3-1.7 0.1-2-0.4-1.8-1.2-0.8-1.2 0.3-1.4 0.6-1.5 0.4-3.1 0.4-3.2 0.8-2.8-0.5-0.1-2.5 0.9-3.5 0.5-3.3-0.8-1.8-2.7-1-0.6-1.5-0.4-1.9-2-2.6-0.6-1.5 0.3-1.2 0.9-1.1 1.3-0.9 1.3-0.3 1.1-0.8 0.6-2 0.2-2.3-0.1-1.8-0.4-1-1.2-1.5-0.5-0.9-0.3-1-0.1-0.9-0.2-0.8-0.6-1.1-0.3-0.8-0.1-1-0.3-1-0.9-0.3-1.9 0.1-4.6 1.1-2.4-0.5-1.6-1.9-0.3-3.9 0.2-1.9 0-1.9-0.7-1.5-1.8-0.5-1.5-0.7-0.9-1.5-0.9-1.7-1-1.3-0.8-0.3-0.8 0-1.4 0.3-0.9 0.5-2.4 1.8-2-0.5-0.8 0.2-1.1 1.1-0.9 0.4-0.7-0.1-0.8-1-0.5-0.1-0.5 0.4-1.2 1.4-0.3 0.2-0.5 6.7-0.6 0.8-0.3 0-0.4-0.3-1.2 0-0.6-0.4-0.5 0.4-0.1 0.5 0.2 0.4 1.3 1.7 0 0.6-1.1 0.3-1.6 0-0.4 0.3-0.3 0.8 0.2 0.5 0.6 0.9 0.4 1-0.1 1-0.7 0.6-0.8-0.3-0.7-0.5-0.6-0.3-1.4 0.6-0.3 1.5 0.3 1.7 0.5 1.3 1.6 2.4 0.5 1.5-0.7 0.7-1.1 0.8-0.4 1.6-0.1 1.9-0.2 1.5-0.8 1.4-1.3 1.8-1.5 1.2-1.2-0.1-0.3-0.8-0.3-1-0.3-1-0.6-0.4-0.8 0.3-5.6 5.6-2.8 0.9-2 1-2 1.4-1.3 0.6-1.4 1-0.7 1.3-1 0.9-1.9-0.3-0.8-0.6-4.5-3.7-2.3-2.7-1.1-1.7-8-8-1.3-0.5-0.5-0.6-4.5-6-4.7-5.6-9.8-7.2-1.9-1.9-3.8-4.9-5.3-4.3-1-1.1-2.3-3.7-2.4-2.6-0.4-0.6 0-0.9 0.4-1.7 0.1-0.8-0.9-2.6-2-2.8-7.3-7.4-1-1.5-0.3-2 0-4.3-0.2-0.7-0.4-1-7.1-11.4-1.2-2.7-0.9-1.3-1.2-0.6-0.6-0.7-2.2-4.4-3-3.9-0.4-0.9-1-6.6-0.4-0.8-1-1.2-0.2-1.1 0.6-3.4-1.1-5.3 0.5-1.2-1.4-3.1-0.5-1.6-0.1-1.8 0.1-3.5-0.5-1.6-1.1-1.5-0.5-0.2-1.4-0.1-0.6-0.2-0.7-1.3-0.5-0.7-0.3 0-0.2-1.8-0.5-1.6-2.4-5-0.4-1.4 0.4-2.2-0.8-1.6-1.1-1.7-0.6-1.4-0.1-1.9 0.2-1.7 0.6-1.1 1.1-0.5 0.7-0.2 0.8-0.3 0.5 0.1 0.2 0.8 0 3.1 0.5 0 0.3-1.6 1.5-4.3 0-0.9-0.4-1.1-1.5-5-1-5-1.7-3-2.5-2.6-2.7-1.9-4.4-1.8-0.7-0.8-0.5-6.4 0.2-6.2-1.4-2.3-0.3-0.5 0.3-1 0.4 0 0.6 0.2 0.7-0.3 1-2.7 0-3.5-0.8-3.5-1.2-2.7-3.3-5.6-0.4-2.6 1.2-3.1-0.6 0-3.7-4.5-1.3-2.2-0.2-1 0-0.6 0.2-1.2 0-6.5 0.3-1.6 2.2-4.3 0.2-1.3 0-1.9-0.3-1.6-1.6-1.6-0.5-2.1-0.3-3.7-1.8-5-0.4-3.8-0.8-3.1 0-1.6 2.2-6.1-0.2-0.9 1.5-5.8 0.3-3.4-0.8-3.1-1-2.1 0.3 0 68.2 0.5 1.8 6.6 5.9 40.2 0.2 0.8 0.3 0.7 0.7 0 0.9-0.1 2.7-0.9 0.9-0.2 1 0 0.8 0.6 0.8 0.8 14.9 20.4 0.9 0.8 1 0 1-0.4 0.9-0.6 1.5-0.2 1.8 0.1 3.3 1.2 1.1-0.1 0.5-0.5-3.9-20.4 0-0.8 0.1-0.7 0.6-0.4 0.7-0.4 3.7-1.1 1-0.1 0.8 0.3 0.8 0.5 0.7 0.6 0.5 0.5 0.1 0.4-0.6 1.1 0 0.8 1.1 3.9 3.1-2.3 1.2-1.7 2.7-6.1 0.9-1.4 0.6 0.2 0.7 0.8 1.8 3.4 0.5 0.8 0.6 0.3 1 0 1.3-0.1 13 2.7 0.5 0.4 1.3 0.5 1.8 1.4 3.2 0.4 3.3 1.1 2 1.3 0.8 0.8 0.2 1 0.1 1 0.2 0.9 0.5 0.5 1.4-0.2 5.5-1.7 2.2 0 3.9-1.4 1.1 0.1 12.2 5.3 0.3-14.3 1.7-1 2.1-0.9 1.3-0.7 0.5-0.2 0.5 0 0.8 0.5 1 0.3 14.1 1.4 9.7-0.8 35.6-8.5 16.5-1.5 5 2.7 1.6 1.4 5.6 2.8 32.2 2.9 1.1-0.4 6.7-3.5 1.6-1.6 0.6-0.5 0.7-0.3 0.6 0.4 0.5 0.4 6.4 9.9 0.7 0.8 0.6 0.2 0.9-0.4 2.3-1.8 0.6-0.3 2-0.4 3.5 0 4 0.7 1.9 0.6 1.8 1.4 1.1 0.5 1.1 0.4 7.1 1.4 3.2 1.4 0.9 0.1 1.5-0.5 8.3-4 1.1-0.2 1.4-0.2 1.1 0.9 3.4-0.5z" id="NAM1" name="Karas" class="map"></path>

                                    <path d="M496.7 516.3l-0.1 1 6.7 13.5 0.5 0.3 0.5-0.3 1.2-1.3 0.7-0.6 0.7-0.2 0.9 0.5 0.7 0.7 3.7 3.9 1.2 0.7 1.4 0.4 6.1 1.2 0.9-0.1 13.8-5.6 0.6-0.1 4 0.3 0.5 0.2 0 0.4-0.3 0.7-0.1 0.7 0.2 0.6 1.5 0.2 6.8 0.3 0.7-0.5 3.4-4.3 0.9-0.5 1.1 0 1.7 0.3 0.7 0.7 0.3 0.8 0.3 14.3 5.1 0.6 46.9 0.2 0.1 16.2 0 13.9 0 13.9 0 13.9 0 14 0 1 0 13.7 0 9.1 0 27.4 0.1 4.6 0 14.8-3.4 0.5-1.1-0.9-1.4 0.2-1.1 0.2-8.3 4-1.5 0.5-0.9-0.1-3.2-1.4-7.1-1.4-1.1-0.4-1.1-0.5-1.8-1.4-1.9-0.6-4-0.7-3.5 0-2 0.4-0.6 0.3-2.3 1.8-0.9 0.4-0.6-0.2-0.7-0.8-6.4-9.9-0.5-0.4-0.6-0.4-0.7 0.3-0.6 0.5-1.6 1.6-6.7 3.5-1.1 0.4-32.2-2.9-5.6-2.8-1.6-1.4-5-2.7-16.5 1.5-35.6 8.5-9.7 0.8-14.1-1.4-1-0.3-0.8-0.5-0.5 0-0.5 0.2-1.3 0.7-2.1 0.9-1.7 1-0.3 14.3-12.2-5.3-1.1-0.1-3.9 1.4-2.2 0-5.5 1.7-1.4 0.2-0.5-0.5-0.2-0.9-0.1-1-0.2-1-0.8-0.8-2-1.3-3.3-1.1-3.2-0.4-1.8-1.4-1.3-0.5-0.5-0.4-13-2.7-1.3 0.1-1 0-0.6-0.3-0.5-0.8-1.8-3.4-0.7-0.8-0.6-0.2-0.9 1.4-2.7 6.1-1.2 1.7-3.1 2.3-1.1-3.9 0-0.8 0.6-1.1-0.1-0.4-0.5-0.5-0.7-0.6-0.8-0.5-0.8-0.3-1 0.1-3.7 1.1-0.7 0.4-0.6 0.4-0.1 0.7 0 0.8 3.9 20.4-0.5 0.5-1.1 0.1-3.3-1.2-1.8-0.1-1.5 0.2-0.9 0.6-1 0.4-1 0-0.9-0.8-14.9-20.4-0.8-0.8-0.8-0.6-1 0-0.9 0.2-2.7 0.9-0.9 0.1-0.7 0-0.3-0.7-0.2-0.8-5.9-40.2-1.8-6.6-68.2-0.5-0.3 0-1.5-3.2-0.9-3.1-0.3-6.6-0.9-3.1-4.2-8.1-1.8-2.5-3.6-3.6-1-2.4-2.5-2.9-0.5-2.1 0.3-0.8 1-1.3 0.3-0.4 0-3.4-0.4-1.5-1.6-3-1.6-4.1-4-7.8-1.6-5.6-1.4-2.7-0.5-3.7-0.6-1.2 0.4-1.6 0-2.7-0.3-2.8-0.6-1.8 0.5-1.1 0.5-2.2 0.6-1.1 0.4-0.2 0.7-0.1 0.6-0.3 0.3-0.8 1-1.9-0.6-1 0.1-4.5-1.3-3.9-0.2-1.4 1-11.6-0.4-2.9-0.8-2.2 41.4 4.1 1.9 2.8 0.5 0.6 0.6 0.5 1.5 0.3 1.6 0.2 5.4-0.5 7.4 1.3 1.6-0.2 1 0.1 8.4 2.3 21.4 9.6-0.6 6.4 0.4 2 0.8 2.2 4.5 2.3 2.1 0.1 5.4-0.2 0.7-0.2 0.4-0.5 0.6-1.5 0.7-0.6 0.9-0.5 3.4-0.1 9.5-3 0.5-0.1 2.3 0.3 0.9 0 0.8-0.4 4.5-2.5 0.5-0.1-0.2 0.6-0.8 1.5-0.2 1-0.2 1.1 0.3 1.5-0.3 0.6-0.6 0.4-1.4 0.2-0.9 0.5-0.1 0.8 0.5 1.2 4 3.2 4.2 0.9-0.8-2-1.3-5 0.8-2 2.8-2.9 0.7-0.4 0.5-0.1 2.4 0.7 6.6 0.4 0.7 0 0.4-0.2 0.3-0.5 0.4-1 0.1-0.6 0-0.5-0.6-1.8-0.3-0.5-0.5-0.4-0.6-0.3-5.6-1.6-0.8 0-1.2 0.7-0.7 0.1-6.3-1.5-0.6-0.4-0.1-0.5 0.1-0.8 1.3-4.6 3.5-7.2 0.4-0.6 0.5-0.4 1 0.7 0.7 0.7 0.1 0.5 0.3 4 0.2 0.6 0.5 0.2 4.9 0 0.8-0.2 0.7-0.4 7.6-7.6 0.3-0.7 0-0.8-0.6-2.4-0.2-0.8-0.4-0.4-5.1-2.8-0.6-0.6 0.3-1.2 8.5-17 1.1-1.5 0.9-0.1 1.7 0.9 1.3 1.2 1.6 0.4 1.4 0.1 1.7-0.3 2.7-0.1 3.3 0.9 5.9-1.5 3.7-1.6 4.4-3.3 5-0.9 3 0 3.3 1.1 1.2 0.6 0.7 1.1 0.3 2.1 0.1 3.4 1.2 1.9 2.6 0.5 6.6-1.1 5-0.3 4.2-0.9 1.2-0.1 0.1 0-2.6 2.7-0.5 0.7-0.2 0.6 0 0.8 0.4 4.1-0.2 0.7-0.3 0.3-2.7 0.8-0.3 0.5 0 0.8 0.9 4.8 0.7 0.6 1.2 0.4 0.6 0.2 0.2 0.4 0.2 0.6 0.6 7.2 0.4-0.4 12.4 0.2 0.7-0.1 0.7-0.2 0.2-0.7 0.7-0.8 1-0.6 14-0.4 3.8 1.1 0.7 0.3 0.6 0.5 2.6 3.4 0.6 0.5 0.7 0.1 2.9-1.3 0.7-0.2 0.6 0.5 1.3 0.3 1.1-0.1 1.4-0.4 5.7-2.5 3.1-0.8 0.9-0.5 0.2-0.8 0.1-1.7 0.2-0.7 0.7-0.6 6.3-2.9 5.1-3 1.6-0.1 2.2 3.3z" id="NAM2" name="Hardap" class="map"></path>

                                    <path d="M496.7 516.3l-2.2-3.3-1.6 0.1-5.1 3-6.3 2.9-0.7 0.6-0.2 0.7-0.1 1.7-0.2 0.8-0.9 0.5-3.1 0.8-5.7 2.5-1.4 0.4-1.1 0.1-1.3-0.3-0.6-0.5-0.7 0.2-2.9 1.3-0.7-0.1-0.6-0.5-2.6-3.4-0.6-0.5-0.7-0.3-3.8-1.1-14 0.4-1 0.6-0.7 0.8-0.2 0.7-0.7 0.2-0.7 0.1-12.4-0.2-0.4 0.4-0.6-7.2-0.2-0.6-0.2-0.4-0.6-0.2-1.2-0.4-0.7-0.6-0.9-4.8 0-0.8 0.3-0.5 2.7-0.8 0.3-0.3 0.2-0.7-0.4-4.1 0-0.8 0.2-0.6 0.5-0.7 2.6-2.7-0.1 0-1.2 0.1-4.2 0.9-5 0.3-6.6 1.1-2.6-0.5-1.2-1.9-0.1-3.4-0.3-2.1-0.7-1.1-1.2-0.6-3.3-1.1-3 0-5 0.9-4.4 3.3-3.7 1.6-5.9 1.5-3.3-0.9-2.7 0.1-1.7 0.3-1.4-0.1-1.6-0.4-1.3-1.2-1.7-0.9-0.9 0.1-1.1 1.5-8.5 17-0.3 1.2 0.6 0.6 5.1 2.8 0.4 0.4 0.2 0.8 0.6 2.4 0 0.8-0.3 0.7-7.6 7.6-0.7 0.4-0.8 0.2-4.9 0-0.5-0.2-0.2-0.6-0.3-4-0.1-0.5-0.7-0.7-1-0.7-0.5 0.4-0.4 0.6-3.5 7.2-1.3 4.6-0.1 0.8 0.1 0.5 0.6 0.4 6.3 1.5 0.7-0.1 1.2-0.7 0.8 0 5.6 1.6 0.6 0.3 0.5 0.4 0.3 0.5 0.6 1.8 0 0.5-0.1 0.6-0.4 1-0.3 0.5-0.4 0.2-0.7 0-6.6-0.4-2.4-0.7-0.5 0.1-0.7 0.4-2.8 2.9-0.8 2 1.3 5 0.8 2-4.2-0.9-4-3.2-0.5-1.2 0.1-0.8 0.9-0.5 1.4-0.2 0.6-0.4 0.3-0.6-0.3-1.5 0.2-1.1 0.2-1 0.8-1.5 0.2-0.6-0.5 0.1-4.5 2.5-0.8 0.4-0.9 0-2.3-0.3-0.5 0.1-9.5 3-3.4 0.1-0.9 0.5-0.7 0.6-0.6 1.5-0.4 0.5-0.7 0.2-5.4 0.2-2.1-0.1-4.5-2.3-0.8-2.2-0.4-2 0.6-6.4 6.2-0.6 1.5-1.4 0.4-3.1 0-0.5-0.8-3.2-0.1-0.6 0.9-11.6-0.1-0.8-0.1-0.6-0.6-0.4-5.6-2.7-0.6-0.3-0.4-0.5 0-0.7 0.2-0.7 2-4.8 0.4-0.7 0.5-0.6 0.7-0.2 2.4-0.5 1.1-0.4 0-0.9-1.8-9.7 6-2.1 0.7-0.3 0.5-0.4-0.2-0.6-3.4-4-0.3-0.8 0-0.7 0.2-0.8 1.3-4 0.2-0.9 0-0.8-0.2-1.8-0.3-1.6-0.3-1 0-0.4 0.9-7.3 0.5-1.1 0.8-1.1 2-1 1.1-0.9 1.3-0.2 0.9-0.2 4.4 0 0.8-0.2 0.3-0.8 0.2-0.9 0-8.3 0-0.7-0.2-0.6-0.5-0.2-0.7-0.1-5.5 0.1-0.6-0.6 1.3-1.7 5.8-6.1 1-0.6 1.1 0 4.5 1.3 0.9 0 1-0.4 1.1-0.6 2.1-1.9 1-1.5 2.6-2.2 0.7-0.8 0.8-0.2 1 0 1 0.2 1 0 0.8-0.2 0.4-0.9 0.1-3.5 0.4-1.3 0.7-1.3 3.5-2.6 3-1.3 5.9-1.4 0.8 0.5 1 0.4 0.5 0.5 0.4-0.3 0.6-0.6 1.1-1.5 0.6-0.7 0.6-0.4 0.7 0.3 1.5 1.1 0.8 0.4 1.4-0.6 0.7 0 2.2 0.3 2.2-0.2 0.8-0.6 0.3-0.7-0.3-0.8-0.3-0.5-0.7-0.1-2.5 0.4-0.6-0.1-0.3-0.5-0.1-0.6 0.1-0.5 0.4-0.5 2.1-3.7 0.6-0.7 0.7-0.3 0.7 0 0.4 0.1 0.4 0.7 0.5 1.6 0.7 0.8 0.9 0.6 2.1 0.1 0.8 0.5 1.1 0.9 0.7-0.1 3.4-1.3 0.9 0 0.9-0.5 0.7-0.6 1.5-1.5 0.8-0.6 0.8-0.5 0.7 0.4 0.5 0.7 0.5 0.8 0.4 0.7 0.4 0 0.6-0.4 4.9-4.2 0.8-0.5 0.7-0.3 0.5 0.5 0.5 0.7 0.4 0.9 0.5 0.8 0.5 0.4 0.8-0.2 7.1-3.3 1-0.9 0.4-0.9 0-2.5 0.1-0.8 0.5-0.7 1.2-1.5 0.6-0.7 0.7-0.5 0.3 0.4 0.3 0.7 0.4 1.6 0.3 0.7 0.3 0.3 0.7-0.1 3.5-1.5 0.8-0.4 0.5-0.5 0.1-0.8-0.1-1.5 0.1-0.4 0.5 0.1 3 1.3 0.7 0.1 0.4-0.5 0.3-0.6 0.8-2.2 0-0.5-0.2-0.7-1.5-4.3-0.1-0.7 0.5-0.2 1.5 0 0.8-0.1 0.8-0.5 0.7-0.5 0.6-0.7 0.3-0.5 0.5-1.4 0.7-0.9 0.8-0.6 2.5-1.4 0.3-0.4 0.9-2.2 0.5-0.9 0.8-0.4 0.8-0.3 3.4-0.9 0.8-0.2 0.7 0.1 0.7 0.6 1.2 1.2 0.4 0.2 0.5 0 2.2-0.8 3.5-0.7 2-1 0.8-0.6 1.6-1.6 2.5-2.1 3.5-1.6 3.1-0.6 1.6 0.2 7.8-2.2 0.6 4.7-1 1.9-1.8 2.2-1.2 2.1-0.3 0.9 0 0.7 0.6 0.9 1.2 1.1 0.4 0.6 0.9 1.3 0.6 0.4 0.3 0.4 0.2 0.7 0.2 1.7-0.4 0.8-1.1 0.7-0.6 0.6-0.6 1.3-2 3.1-0.3 0.7 0.6 1.2 0.2 0.7 0.1 1.3-0.4 0.7-0.8 0.5-2.5 1.1-0.8 0.1-1.8 0.1-0.6 0.2-0.3 0.7-0.8 7.1 0.2 1.2 0.4 1.3 2 4.1 2.4 3.3 0.9 0.8 0.9 0.2 3 0 0.6 0.4 0.4 0.5 2 3.2 1 1.1 1.4 1.2 0.6 0.6-0.3 0.5-2.5 1.3-0.6 0.5 0.3 0.6 0.6 0.5 1.9 1.5 0.2 0 2.3-1.9 0.6-0.4 0.3 0.2 0.3 0.6 2.1 10.3 0.9 8.4 0.3 1.6 2.1 6.3 0.3 2.3 0.1 8.5 0.5 0.5 0.8 0 5.2-2 0.6 0 0.1 0.5 0 0.7-0.1 1.6-0.1 0.7-0.3 0.4-0.6 0.4-3.3 1.4-0.9 0.7 0 0.7 0.1 0.8 0.3 0.8 0.3 0.6 1.2 0.7 1.5 2 0.8 0.3 0.7 0.2 1.6 0.2 0.7 0.2 0.4 0.2 0.4 0.7 0.7 1.8 0.5 2.6-0.4 0.6-0.7 0.3-4.1 0.3-0.7 0.2-0.7 0.5-0.4 0.9-0.4 1 0 1 0.5 0.8 10.3 8.6 0.7 0.8 0.1 0.7-0.3 1-4.3 11.1z" id="NAM3" name="Khomas" class="map"></path>

                                    <path d="M185.3 34.7l0 1.7-0.3 0.8 0.5 0.5-0.4 1.3-1.4 2.6-0.6 1.6-2.4 3.5-1.4 1.8 0.2 2.1 3.1 1.8 0.3 1.8-0.2 2-0.3 1.5-0.6 1.2-1.5 1.6 1 3.6 7.2 14.7 2.1 9.4 1.3 29-0.7 11 0.4 5.3 2.9 9.4 2.1 4.2 1.3 4.4-1.4 8-0.5 8 3.1 9.1 1.5 2.1 2.1 1.7 1.7 2.7 0.3 3.5-0.9 1.2-0.9 1.1-0.6 3.3 9.2 0.3 1.4-3 0.1-4.2-4.1 0.2-0.3-3.3 0.1-3.1 3.5-0.7 20.3-0.2 17-2.3 4.5 1 4.4 0.3 7.9-2.4-0.2 4.2 13.7-0.1 2.7-0.4 3 0.4 9.3 2.4 6.2 0.7 2.7-0.1 2.6 0.5 5.9 3.3 8.9 1.3 5.2 1.3 4.1 0.5 9.9 3 13.7 2 4.4 0.1 4.7 1.2 4.4 2.4 0.9 0.7 0.1 1.3 0.6 3.4-0.8 28.7 0.7 2.9-4.1 2.8-2.1 0.6-6.5 0-0.6 0.4-0.1 4.5 0.1 0.7 1.2 3.4 0.1 0.7-0.5 0.2-0.7 0.1-2.2-0.1-13.2 6.8-0.7 0.7-0.4 0.6 0.2 6.3 0.4 2.7 0 0.9-0.1 1-0.4 1-0.9 0.7-1 0.6-1.1 0.5-1.1 0.2-1.1-0.1-1.3-1-1.1-0.2-1.1-0.2-0.9 0.2-0.7 0.2-3.6 1.7-0.7 0.1-4.6 0.1-0.7 0.1-5.2 2.1-2.5 1.7-1 0.9-4.7 5.6-1.1 0.7-4.5 1.9-1.1 0.3-1.1 0-6.1-1.3-5-0.3-3.3-0.7-3.1-1.1-1.5-0.7-1.1-1-1.1-1.4-0.6-0.5-5.3-0.5-0.7 0.7-0.5 0.9-1.7 2-4.1 5.6-0.6 0.5-10.3 9.7-0.7 0.9-0.4 1.1-0.4 0.4-3.5 2.2-1.7 0.8-3.9 3.2-0.7 0.8-0.5 0.3-1.2 0.5-0.4 0.5-0.5 1-0.8 0.7-1.1 0.6-0.4 0.4-0.3 0.6-0.7 0.6-0.9 0.1-1.4 0.1-0.7 0.3-1.8 1.4-1.7 0.9-0.5 0.5-0.8 0.9-0.5 0.4-2.4 0.7-1.9 0.9-0.6 0.1-1.5 0.1-1.7 0.3-0.5 0-2.3-0.2-4.2 0-0.5-0.1-2.7-1.1-0.4-0.2-1.3 0.1-1 0.2-2.1 0.1-1.7 0.3-0.9-0.3-1.5-1.2-0.8-0.3-3.2-0.3-1.9 0.4-3.8 1.3-0.9 0.1-0.8-0.2-4.7-2.1-1.3-0.1-1.2 0.3-1.4 0.6-0.8 0.5-1.1 0.4-2 0.1-1.7 0.4-1 0.4-2 1.1-0.9 0.3-3.4 0.1-5.5 2-1.5 1.1-1 1.1-0.6 0.2-1.2 0.1-0.4 0.2-0.3 0.4-0.5 1.1-0.4 0.2-0.7 0.2-0.9 0.1-2.6 0.6-0.9 0.5-0.8 1.2-0.7 0.7-0.7 0.3-2.5 0.9-4.7 3-1.9-2.3-6.6-11.9-3-4.2-1-2.9-1-1.1-2-1.6-1.5-2.7-0.8-2.6-0.7-6.5-2-7.1-6.4-12.5-1.8-6.9-0.4-3.4-1.5-6.4-2.6-6.6-1.7-2.7-3-0.9-3.2-2.3-2.4-4.3-2.4-9.7-5.7-11-0.7-2.3-3.1-4.2-5.4-10-0.7-1.8-0.8-1.1-1.9-4-0.6-0.8-3.3-5.9-1-2.5-0.3-1.5-0.5-3.5-0.8-1.7-2.4-3.1-1.5-2.8-3.6-9-1.5-2.4-2.2-2.6-2.7-2.1-0.7-1-0.9-5.7-0.6-1.6-12-16.1-8.3-5.4-3.6-4.2-0.5-0.4-1.3-1.8-0.7-0.4-0.7-0.5-3.7-2.3-1.2-4.1-0.3-1.4-0.9-2.4-0.1-0.9-0.1-1.5 0.2-0.8-1.8-2.5-2.8-7.6-0.5-0.5-6-6.4-1.1-3.5-0.6-4.6-1.3-3.7-0.9-2.7-0.9-7.5-1.7-5.7-1.1-7.9-1.4-6.5-0.7-4.1 0.3-6.1 2.5-15.5 0.8-1.1 1 0.1 1.2 0.7 0.8 0.2 1.1-0.1 0.4-0.4 0.2-0.5 0.4-0.6 1.3-0.9 3.1-1.5 3.4-2.6 3.1-1.4 3.3-1 3.5-0.5 0.9-0.3 0.5 0 0.8 0.5 2.5 0.8 0.9-0.2 0.7-0.5 0.7 0.2 0.5 0.4 0.3 1.1 0.2 0.6 0.5 0.5 0.7 0.5 0.8 0.4 0.8 0.2 0.7 0.3 0.3 0.8 0.2 0.7 0.3 0.3 5.3-0.5 4.8 0.2 1-0.5 1-0.8 0.8 0 1.8 1 1.3 0.5 4.4 0.4 2.6 0.6 0.9-0.1 1.8-1 3.3-2.8 1.8-0.7 1.9-0.2 1.3-0.8 2.6-2.2 3.3-1.6 2.5-0.7 0.5-0.7 0.6-1.1 0.7-0.6 0.5-0.3 1.4-0.4 0.6-0.4 0.3-0.7 0.1-0.9 0.4-0.7 1.7-0.5 1.5-0.7 2.3-0.6 3.9-2.2 7.9-1.4 1.7-0.6 1.6-0.1 1.3 1 1-0.5 0.5 0.4 0.5 0.8 0.8 0.4 1.7 0.2 0.9 0.1 0.7-0.3 0 0.5 1.9-0.8 1.1-0.3 0.5 0.3 0.5 0 3.1-0.8 1.4 0.5 2.6 1.8 1.3 0.4 1.7 0.2 1.6 0.7 1.1 1 0.9 3.1 1.1 1 0.6 1.3-0.7 2.2 6.3 3.5 6.5 5.3 7.1 4 6.9 3.9 0.9 0.8 3.4 4.6 1.1 0.8 1.7 0.4 0.9-0.2 1.2-0.8 0.6-0.1 0.8 0.1 1.4 0.4 1.6 0.2 1.2 0.4 0.9 0 0.8-0.3 1.1-0.7 0.5-0.1 3.3 0.5 1.6-0.3 0.7-1.5 0.1-0.4 0.8 0z" id="NAM4" name="Kunene" class="map"></path>

                                    <path d="M287.2 282.3l-0.4 8.4 0.2 0.8 0.5 1.1 3.8 1.2 0.6 0 0.7 0 2.6-0.6 0.8-0.1 0.3 0.3 0.3 0.5 1.1 4 0.7 0.9 5.8 5.4 14.8 8 4.4 4.3 3.5 1.3 3.1 1.8 0.8 0.3 0.5-0.1 0.5-0.4 3.2-3.4 0.4-0.3 0.3 0.1 0.1 0.5 0.6 2.6 0.5 1 0.8 1 1.9 1.8 1 0.7 1.3 0.7 0.6 0.4 2.4 2.5 0.3 0.4 0.5 1.1 0.4 0.6 0.6 0.3 0.7 0.1 7.1 0.9 0 4.6-0.6 2.6 2.2 9.8-0.2 2.3-3 2.9-2.8 3.9-1 1.1-0.3 0.6-0.2 1-0.8 6.3-2.2 8.9 2.8 9.1 0.1 1.8 0.4 1.4 1 0.4 0.6 0.7 1.2 1.9 0.2 1.2-0.2 1-0.4 0.7-0.3 0.8 0 0.7 0.4 0.7 0.5 0.7 0.2 0.4-0.3 0.8-0.6 2.2-0.1 2.3-0.5 0.8-0.7 0.4-1.5-0.1-0.3 0.2 0.3 0.7 2.4 3.6 0.3 0.7-0.4 0.3-1.6 0.7-0.8 1-2.5 1.9-0.4 0.5 0.1 0.8 2.1 4.7 0 0.6-0.2 0.4-0.7 1.1-0.2 0.6 0.2 0.8 0.4 0.9 2.4 4-3 1.3-3.5 2.6-0.7 1.3-0.4 1.3-0.1 3.5-0.4 0.9-0.8 0.2-1 0-1-0.2-1 0-0.8 0.2-0.7 0.8-2.6 2.2-1 1.5-2.1 1.9-1.1 0.6-1 0.4-0.9 0-4.5-1.3-1.1 0-1 0.6-5.8 6.1-1.3 1.7 0.6 0.6 5.5-0.1 0.7 0.1 0.5 0.2 0.2 0.6 0 0.7 0 8.3-0.2 0.9-0.3 0.8-0.8 0.2-4.4 0-0.9 0.2-1.3 0.2-1.1 0.9-2 1-0.8 1.1-0.5 1.1-0.9 7.3 0 0.4 0.3 1 0.3 1.6 0.2 1.8 0 0.8-0.2 0.9-1.3 4-0.2 0.8 0 0.7 0.3 0.8 3.4 4 0.2 0.6-0.5 0.4-0.7 0.3-6 2.1 1.8 9.7 0 0.9-1.1 0.4-2.4 0.5-0.7 0.2-0.5 0.6-0.4 0.7-2 4.8-0.2 0.7 0 0.7 0.4 0.5 0.6 0.3 5.6 2.7 0.6 0.4 0.1 0.6 0.1 0.8-0.9 11.6 0.1 0.6 0.8 3.2 0 0.5-0.4 3.1-1.5 1.4-6.2 0.6-21.4-9.6-8.4-2.3-1-0.1-1.6 0.2-7.4-1.3-5.4 0.5-1.6-0.2-1.5-0.3-0.6-0.5-0.5-0.6-1.9-2.8-41.4-4.1-2.8-7.3-0.9-3.6 0.1-0.8 0.6-0.7 1.8-3.3 0.9-0.9-0.1 1.7 0.4 0.7 0.4-0.4 0.3-1.7-0.1-3.1-1.4-9.4-0.8-2.8-1.3-2.1-1-2.3-0.8-2.6-0.5-2.7-0.3-5.3 0.1-0.8 0.4-0.7 0.9-1.5 0.2-0.8 0-3.3 0.7-0.2 0.2 0.3-0.4 0.7 0.7 1.3 0.3 0.3-0.4 1.6-0.2 1.7 0.6 0.8 1.6-0.7-0.2 0.9-0.9 2.4 1.2-1.1 1.6-3.2 1-0.7 0.9-0.8 0.5-1.8 0.4-3.7-0.5-14-1.4-10.5-1.7-2.8-0.8-3.6-2.7-5.5-1.4-4.7-2.4-5-0.5-0.7-4.8-5.4-1.5-2.6-0.1-2-0.1-0.7-11.4-14.9-5.5-5.2-0.6-1.3-6.1-5.7-1.4-0.7 0-0.9 0.5-1.2 0.4-2 0.1-0.5-0.3-1-0.3-0.7-5.9-8.9-1.1-5.1-2.3-5.7-7.6-10-4.6-7.7-2.8-3.6 4.7-3 2.5-0.9 0.7-0.3 0.7-0.7 0.8-1.2 0.9-0.5 2.6-0.6 0.9-0.1 0.7-0.2 0.4-0.2 0.5-1.1 0.3-0.4 0.4-0.2 1.2-0.1 0.6-0.2 1-1.1 1.5-1.1 5.5-2 3.4-0.1 0.9-0.3 2-1.1 1-0.4 1.7-0.4 2-0.1 1.1-0.4 0.8-0.5 1.4-0.6 1.2-0.3 1.3 0.1 4.7 2.1 0.8 0.2 0.9-0.1 3.8-1.3 1.9-0.4 3.2 0.3 0.8 0.3 1.5 1.2 0.9 0.3 1.7-0.3 2.1-0.1 1-0.2 1.3-0.1 0.4 0.2 2.7 1.1 0.5 0.1 4.2 0 2.3 0.2 0.5 0 1.7-0.3 1.5-0.1 0.6-0.1 1.9-0.9 2.4-0.7 0.5-0.4 0.8-0.9 0.5-0.5 1.7-0.9 1.8-1.4 0.7-0.3 1.4-0.1 0.9-0.1 0.7-0.6 0.3-0.6 0.4-0.4 1.1-0.6 0.8-0.7 0.5-1 0.4-0.5 1.2-0.5 0.5-0.3 0.7-0.8 3.9-3.2 1.7-0.8 3.5-2.2 0.4-0.4 0.4-1.1 0.7-0.9 10.3-9.7 0.6-0.5 4.1-5.6 1.7-2 0.5-0.9 0.7-0.7 5.3 0.5 0.6 0.5 1.1 1.4 1.1 1 1.5 0.7 3.1 1.1 3.3 0.7z" id="NAM5" name="Erongo" class="map"></path>

                                    <path d="M683.3 173.3l0 6.1 0 9.8 0.1 19.5 0 9.8 0 9.8 0.1 9.8 0 19.7 0.1 7.8-1.9 0.2-1.3 0.6-1.1 0.2-4.7 0.3-4 1.2-1 0.2-5.1 0.2-2.8-0.2-3.8-1.1-7.9-1.1-3 0.1-2.6 0.4-1.4-0.1-3.4-0.6-1.5-0.5-1.8-0.9-1.3-0.4-59.8-6.7-2-0.3-4.4 0.1-2 0.3-1.5 0.7-2.4 2.2-2.2 1.2-35.4 13.5-0.8 0.4-2.6 2.2-2.1 2.3-13.2 22-0.4 1.1-2.3 10.9-0.5 1.6-1.9 4.1-0.6-0.9-0.5-0.6-0.8-0.5-1.1 0-5.4 1.2-1.4 0.9-0.8 3.1-0.3 2.4 0 0.6 0.3 0.2 0.6-0.1 2.4-0.5 0.7 0 0.2 0.3 0 0.6-0.2 1.6-0.2 0.8-0.4 0.8-0.9 0.7-2.7 1.6-0.6 0.6 0 0.8 0 0.7 0.3 0.8 1.1 2 0.2 0.6-0.4 0.1-7.8-2.2-0.7-0.1-1.5 0.4-0.7 0.5-0.7 0.7-0.2 1.5-0.1 3.6 0.1 0.6 0.4 0.2 0.7 0.1 1.5-0.2 1.3-0.3 0.3 0.2 0.2 0.6 0.6 2.4 0 0.9-0.1 0.7-1.1 1-0.2 0.7 0.1 0.8 0.4 3.4 0 0.8-0.2 0.6-1.9 1.1-0.1 0.8 0.2 0.9 0.2 1.2-0.2 2.3 0.6 3.3-0.1 1-0.2 1.1-2 2.5-1.6 1-4.7 2.2-0.8 0.8-7.8 2.2-1.6-0.2-3.1 0.6-3.5 1.6-2.5 2.1-1.6 1.6-0.8 0.6-2 1-3.5 0.7-2.2 0.8-0.5 0-0.4-0.2-1.2-1.2-0.7-0.6-0.7-0.1-0.8 0.2-3.4 0.9-0.8 0.3-0.8 0.4-0.5 0.9-0.9 2.2-0.3 0.4-2.5 1.4-0.8 0.6-0.7 0.9-0.5 1.4-0.3 0.5-0.6 0.7-0.7 0.5-0.8 0.5-0.8 0.1-1.5 0-0.5 0.2 0.1 0.7 1.5 4.3 0.2 0.7 0 0.5-0.8 2.2-0.3 0.6-0.4 0.5-0.7-0.1-3-1.3-0.5-0.1-0.1 0.4 0.1 1.5-0.1 0.8-0.5 0.5-0.8 0.4-3.5 1.5-0.7 0.1-0.3-0.3-0.3-0.7-0.4-1.6-0.3-0.7-0.3-0.4-0.7 0.5-0.6 0.7-1.2 1.5-0.5 0.7-0.1 0.8 0 2.5-0.4 0.9-1 0.9-7.1 3.3-0.8 0.2-0.5-0.4-0.5-0.8-0.4-0.9-0.5-0.7-0.5-0.5-0.7 0.3-0.8 0.5-4.9 4.2-0.6 0.4-0.4 0-0.4-0.7-0.5-0.8-0.5-0.7-0.7-0.4-0.8 0.5-0.8 0.6-1.5 1.5-0.7 0.6-0.9 0.5-0.9 0-3.4 1.3-0.7 0.1-1.1-0.9-0.8-0.5-2.1-0.1-0.9-0.6-0.7-0.8-0.5-1.6-0.4-0.7-0.4-0.1-0.7 0-0.7 0.3-0.6 0.7-2.1 3.7-0.4 0.5-0.1 0.5 0.1 0.6 0.3 0.5 0.6 0.1 2.5-0.4 0.7 0.1 0.3 0.5 0.3 0.8-0.3 0.7-0.8 0.6-2.2 0.2-2.2-0.3-0.7 0-1.4 0.6-0.8-0.4-1.5-1.1-0.7-0.3-0.6 0.4-0.6 0.7-1.1 1.5-0.6 0.6-0.4 0.3-0.5-0.5-1-0.4-0.8-0.5-5.9 1.4-2.4-4-0.4-0.9-0.2-0.8 0.2-0.6 0.7-1.1 0.2-0.4 0-0.6-2.1-4.7-0.1-0.8 0.4-0.5 2.5-1.9 0.8-1 1.6-0.7 0.4-0.3-0.3-0.7-2.4-3.6-0.3-0.7 0.3-0.2 1.5 0.1 0.7-0.4 0.5-0.8 0.1-2.3 0.6-2.2 0.3-0.8-0.2-0.4-0.5-0.7-0.4-0.7 0-0.7 0.3-0.8 0.4-0.7 0.2-1-0.2-1.2-1.2-1.9-0.6-0.7-1-0.4-0.4-1.4-0.1-1.8-2.8-9.1 2.2-8.9 0.8-6.3 0.2-1 0.3-0.6 1-1.1 2.8-3.9 3-2.9 0.2-2.3-2.2-9.8 0.6-2.6 0-4.6-7.1-0.9-0.7-0.1-0.6-0.3-0.4-0.6-0.5-1.1-0.3-0.4-2.4-2.5-0.6-0.4-1.3-0.7-1-0.7-1.9-1.8-0.8-1-0.5-1-0.6-2.6-0.1-0.5-0.3-0.1-0.4 0.3-3.2 3.4-0.5 0.4-0.5 0.1-0.8-0.3-3.1-1.8-3.5-1.3-4.4-4.3-14.8-8-5.8-5.4-0.7-0.9-1.1-4-0.3-0.5-0.3-0.3-0.8 0.1-2.6 0.6-0.7 0-0.6 0-3.8-1.2-0.5-1.1-0.2-0.8 0.4-8.4 5 0.3 6.1 1.3 1.1 0 1.1-0.3 4.5-1.9 1.1-0.7 4.7-5.6 1-0.9 2.5-1.7 5.2-2.1 0.7-0.1 4.6-0.1 0.7-0.1 3.6-1.7 0.7-0.2 0.9-0.2 1.1 0.2 1.1 0.2 1.3 1 1.1 0.1 1.1-0.2 1.1-0.5 1-0.6 0.9-0.7 0.4-1 0.1-1 0-0.9-0.4-2.7-0.2-6.3 0.4-0.6 0.7-0.7 13.2-6.8 2.2 0.1 0.7-0.1 0.5-0.2-0.1-0.7-1.2-3.4-0.1-0.7 0.1-4.5 0.6-0.4 6.5 0 2.1-0.6 4.1-2.8-0.7-2.9 0.8-28.7-0.6-3.4-0.1-1.3 0.4-0.8 0.6-0.5 20.1-10.4 7.1-8.8 3-4.9 5.3-1.4 1 0.4 1 0.5 0.3 0.8 0.7 0.7 1.1 0.5 2.5-0.2 1.2 0.6 1 0.6 0.9 1.7 0.3 0.5-0.1 0.7-0.3 2.3 0.1 0.6 0.5 0.2 0.7 0.1 0.7-0.1 0.4-0.2 0.1-0.6 0-0.7 0.2-0.7 0.3-0.5 1.9-0.5 1.6-0.3 0.4 0.1 0.3 0.6 0.3 2.4 0 0.7-0.1 0.6-0.5 0.2-1.4 0.3-0.3 0.2-0.2 0.6 0.2 3.2 0.1 0.7 0.2 0.4 0.6 0.5 0.8 0.4 1 0.3 1.6-0.3 1.1 0.2 0.9 0.3 2.5 1.6 0.4 0.4 0.3 0.4 0.1 1.3 0.5 0.6 1.4 1.1 0.9 0.3 1.1 0.3 1.8-0.1 1.3 0.5 1.2 0.7 2.6 2.3 0.8 0.4 4.6 0.3 1-0.4 2.3-1 1.9-0.4 0.9 0 0.4 0.5 0.4 0.6 0.5 1.4 0.3 0.6 0.7 0 0.9-0.4 3.4-2 0.8-0.6 0.5-0.7-0.4-1-2.6-3.2-0.7-1.1-0.1-0.9-0.1-1.1 0.3-1.7 0.7-1.1 0.5-1 2.7-1.4 0.3-0.8 0.1-1 0.3-0.8 0.7-0.4 1-0.3 0.9-0.2 0.7-0.3 0.5-0.6 0.4-1.4 0.3-2.3 0-2.8 0.1-1 0.3-0.9 0.5-0.6 0.2-1.1 0-1-0.7-5.4 0.1-0.8 0.5-0.3 0.9-0.1 1 0 1.2-0.4 1.4-0.8 1.8-2.2 1.3-0.9 2.2-1.1 0.8-0.9 0.6-8.1 1.1-6.8 76.8 4.3-0.1 29.2 128.3-1.3z" id="NAM6" name="Otjozondjupa" class="map"></path>

                                    <path d="M284.1 34.8l0.1 5.1 2.2 4.6 1.8 2.6 0.8 1.4 1 2.4 0.6 6.3-26.5 26.8-0.1 1.2 1.3 0.6 8.5 5 3.2 1.2 2.7 1.8 0.9 3.8 0.1 4 3.7 28.9-1.4 4.3-2.4 3.6 0.5 4.3 3.2 8.4-0.5 4.5-3.1 2.9 1.3 2.4 1.8 2.2 1.9 0.6 1.6 1.1-2.4 1.2-2.8 0.4-3.1 1.5-2.8 1.8-2.7 0.9-2.7 0.6-2.2 0.9-2.3 0.5-0.1 1.1 0.1 1.1-7.9 2.4-4.4-0.3-4.5-1-17 2.3-20.3 0.2-3.5 0.7-0.1 3.1 0.3 3.3 4.1-0.2-0.1 4.2-1.4 3-9.2-0.3 0.6-3.3 0.9-1.1 0.9-1.2-0.3-3.5-1.7-2.7-2.1-1.7-1.5-2.1-3.1-9.1 0.5-8 1.4-8-1.3-4.4-2.1-4.2-2.9-9.4-0.4-5.3 0.7-11-1.3-29-2.1-9.4-7.2-14.7-1-3.6 1.5-1.6 0.6-1.2 0.3-1.5 0.2-2-0.3-1.8-3.1-1.8-0.2-2.1 1.4-1.8 2.4-3.5 0.6-1.6 1.4-2.6 0.4-1.3-0.5-0.5 0.3-0.8 0-1.7 5.1 0 37.8 0 18.9 0 37 0.1z" id="NAM7" name="Omusati" class="map"></path>

                                    <path d="M316.5 58.5l0 25.3 1 0.2 1.1 1.2 0.4 1.6 0.4 6.2-0.6 4.5-0.8 2.1-3.4 4.7-1.3 0.8-0.9 1.3 0.1 3.5 0.8 3.4-0.5 5.7 0.7 2 0.9 1.8 1.2 4 3.3 3.9 0.3 2.1-1.5 1.2-1.5 0-1.6 0.6-2.3 2.8-3.2 3.3-2.8 3.8-1 2.4-0.4 2.5 0.1 4.9 0.4 0.9 0.2 2.2 2.4 5.3 1.3 2.3 0.8 2.1 1.3 1.5 2.4 1.6-0.6 2.4-1.5 0.7-1.1 1 0.1 2.1 0.8 5.6 0.7 1.8 0 1.9-5.9-3.3-2.6-0.5-2.7 0.1-6.2-0.7-9.3-2.4-3-0.4-2.7 0.4-13.7 0.1 0.2-4.2-0.1-1.1 0.1-1.1 2.3-0.5 2.2-0.9 2.7-0.6 2.7-0.9 2.8-1.8 3.1-1.5 2.8-0.4 2.4-1.2-1.6-1.1-1.9-0.6-1.8-2.2-1.3-2.4 3.1-2.9 0.5-4.5-3.2-8.4-0.5-4.3 2.4-3.6 1.4-4.3-3.7-28.9-0.1-4-0.9-3.8-2.7-1.8-3.2-1.2-8.5-5-1.3-0.6 0.1-1.2 26.5-26.8 0 0.5 1.4 4.2 11.1-1.5 13.4-1.9z" id="NAM8" name="Oshana" class="map"></path>

                                    <path d="M464 34.8l0 29.2-92.2 0.2-26.5 11.3-6-2.4-22.8-14.6-13.4 1.9-11.1 1.5-1.4-4.2 0-0.5-0.6-6.3-1-2.4-0.8-1.4-1.8-2.6-2.2-4.6-0.1-5.1 19.7 0 37.8 0 18.9 0 18.9 0 37.9 0 18.9 0 27.8 0z" id="NAM9" name="Ohangwena" class="map"></path>

                                    <path d="M683.6 265.6l0.1 51.3 0 4.5 0.1 9.1 0 4.6 0.1 54.8 0.1 3.3-1 2.9-73.2 0 0 30.8 0 12 0 12 0 13.8 0.1 13.8 0 13.8 0 13.8 0 39.2-46.9-0.2-5.1-0.6-0.3-14.3-0.3-0.8-0.7-0.7-1.7-0.3-1.1 0-0.9 0.5-3.4 4.3-0.7 0.5-6.8-0.3-1.5-0.2-0.2-0.6 0.1-0.7 0.3-0.7 0-0.4-0.5-0.2-4-0.3-0.6 0.1-13.8 5.6-0.9 0.1-6.1-1.2-1.4-0.4-1.2-0.7-3.7-3.9-0.7-0.7-0.9-0.5-0.7 0.2-0.7 0.6-1.2 1.3-0.5 0.3-0.5-0.3-6.7-13.5 0.1-1 4.3-11.1 0.3-1-0.1-0.7-0.7-0.8-10.3-8.6-0.5-0.8 0-1 0.4-1 0.4-0.9 0.7-0.5 0.7-0.2 4.1-0.3 0.7-0.3 0.4-0.6-0.5-2.6-0.7-1.8-0.4-0.7-0.4-0.2-0.7-0.2-1.6-0.2-0.7-0.2-0.8-0.3-1.5-2-1.2-0.7-0.3-0.6-0.3-0.8-0.1-0.8 0-0.7 0.9-0.7 3.3-1.4 0.6-0.4 0.3-0.4 0.1-0.7 0.1-1.6 0-0.7-0.1-0.5-0.6 0-5.2 2-0.8 0-0.5-0.5-0.1-8.5-0.3-2.3-2.1-6.3-0.3-1.6-0.9-8.4-2.1-10.3-0.3-0.6-0.3-0.2-0.6 0.4-2.3 1.9-0.2 0-1.9-1.5-0.6-0.5-0.3-0.6 0.6-0.5 2.5-1.3 0.3-0.5-0.6-0.6-1.4-1.2-1-1.1-2-3.2-0.4-0.5-0.6-0.4-3 0-0.9-0.2-0.9-0.8-2.4-3.3-2-4.1-0.4-1.3-0.2-1.2 0.8-7.1 0.3-0.7 0.6-0.2 1.8-0.1 0.8-0.1 2.5-1.1 0.8-0.5 0.4-0.7-0.1-1.3-0.2-0.7-0.6-1.2 0.3-0.7 2-3.1 0.6-1.3 0.6-0.6 1.1-0.7 0.4-0.8-0.2-1.7-0.2-0.7-0.3-0.4-0.6-0.4-0.9-1.3-0.4-0.6-1.2-1.1-0.6-0.9 0-0.7 0.3-0.9 1.2-2.1 1.8-2.2 1-1.9-0.6-4.7 0.8-0.8 4.7-2.2 1.6-1 2-2.5 0.2-1.1 0.1-1-0.6-3.3 0.2-2.3-0.2-1.2-0.2-0.9 0.1-0.8 1.9-1.1 0.2-0.6 0-0.8-0.4-3.4-0.1-0.8 0.2-0.7 1.1-1 0.1-0.7 0-0.9-0.6-2.4-0.2-0.6-0.3-0.2-1.3 0.3-1.5 0.2-0.7-0.1-0.4-0.2-0.1-0.6 0.1-3.6 0.2-1.5 0.7-0.7 0.7-0.5 1.5-0.4 0.7 0.1 7.8 2.2 0.4-0.1-0.2-0.6-1.1-2-0.3-0.8 0-0.7 0-0.8 0.6-0.6 2.7-1.6 0.9-0.7 0.4-0.8 0.2-0.8 0.2-1.6 0-0.6-0.2-0.3-0.7 0-2.4 0.5-0.6 0.1-0.3-0.2 0-0.6 0.3-2.4 0.8-3.1 1.4-0.9 5.4-1.2 1.1 0 0.8 0.5 0.5 0.6 0.6 0.9 1.9-4.1 0.5-1.6 2.3-10.9 0.4-1.1 13.2-22 2.1-2.3 2.6-2.2 0.8-0.4 35.4-13.5 2.2-1.2 2.4-2.2 1.5-0.7 2-0.3 4.4-0.1 2 0.3 59.8 6.7 1.3 0.4 1.8 0.9 1.5 0.5 3.4 0.6 1.4 0.1 2.6-0.4 3-0.1 7.9 1.1 3.8 1.1 2.8 0.2 5.1-0.2 1-0.2 4-1.2 4.7-0.3 1.1-0.2 1.3-0.6 1.9-0.2z" id="NAM10" name="Omaheke" class="map"></path>

                                    <path d="M684.1 79.4l0.5 27.4-1.4 0.1 0 53 0.1 13.4-128.3 1.3 0.1-29.2-76.8-4.3-13.6-0.8-0.7-76.3 0-29.2 32.8 0 0.6 0.1 0.4 1.2 0.9 0.7 1.3 2.9 0.1 0.8 0.2 0.1 1.8 0.6 2.5 4.9 0.2 0.9 1 0.5 3.9 3.2 0.2 0.6 0.4 1.3 0.4 0.8 0.7 0.7 1.3 0.6 0.7 0.5 4.3 4.5 1.4 2 1 0.8 2.9 0.7 6.6 3.3 9.6 1.8 6.2-0.3 2.5-1 1.6-0.3 0.9 0 2.2 0.4 3.3-0.2 1.1 0.8 11.7 3.5 12.7-0.2 4.2-0.9 1.7-0.2 1.5 0.4 0.6 1.4 0.7 0.5 1.5 0.7 1.7 0.6 1.2 0.1 0.4-0.4 0.8-1.5 0.5-0.3 11.6 0 2.8 1.6 2.6 0.9 0.7 0.1 4.3-0.4 2 0 1-0.1 1-0.5 0.6 0.6 1-1 1.8-0.4 2 0.1 1.7 0.7 2.6-2.2 0.8 0.6 1-0.1 2.4-0.5 0.9 0.4 2.9 2.4 1.9-0.5 1.8 0.8 1.7 1.5 1.4 1.6 0.8 0.6 2.5 1.3 2.1 1.6 1 0.4 1.8-0.5 2.9-0.1 2.7 0.3 1.2 0.6 0.5 0.7 1.2 0.5 1.2 0.2 0.6-0.3 0.5-0.7 1.3 0.3 2.2 1.2 1.6 1.4 1.9-0.1 2.2-0.9 2.4-0.4 1-2.1 5.8-1.6z" id="NAM11" name="Kavango" class="map"></path>

                                    <path d="M464 64l0.7 76.3 13.6 0.8-1.1 6.8-0.6 8.1-0.8 0.9-2.2 1.1-1.3 0.9-1.8 2.2-1.4 0.8-1.2 0.4-1 0-0.9 0.1-0.5 0.3-0.1 0.8 0.7 5.4 0 1-0.2 1.1-0.5 0.6-0.3 0.9-0.1 1 0 2.8-0.3 2.3-0.4 1.4-0.5 0.6-0.7 0.3-0.9 0.2-1 0.3-0.7 0.4-0.3 0.8-0.1 1-0.3 0.8-2.7 1.4-0.5 1-0.7 1.1-0.3 1.7 0.1 1.1 0.1 0.9 0.7 1.1 2.6 3.2 0.4 1-0.5 0.7-0.8 0.6-3.4 2-0.9 0.4-0.7 0-0.3-0.6-0.5-1.4-0.4-0.6-0.4-0.5-0.9 0-1.9 0.4-2.3 1-1 0.4-4.6-0.3-0.8-0.4-2.6-2.3-1.2-0.7-1.3-0.5-1.8 0.1-1.1-0.3-0.9-0.3-1.4-1.1-0.5-0.6-0.1-1.3-0.3-0.4-0.4-0.4-2.5-1.6-0.9-0.3-1.1-0.2-1.6 0.3-1-0.3-0.8-0.4-0.6-0.5-0.2-0.4-0.1-0.7-0.2-3.2 0.2-0.6 0.3-0.2 1.4-0.3 0.5-0.2 0.1-0.6 0-0.7-0.3-2.4-0.3-0.6-0.4-0.1-1.6 0.3-1.9 0.5-0.3 0.5-0.2 0.7 0 0.7-0.1 0.6-0.4 0.2-0.7 0.1-0.7-0.1-0.5-0.2-0.1-0.6 0.3-2.3 0.1-0.7-0.3-0.5-0.9-1.7-1-0.6-1.2-0.6-2.5 0.2-1.1-0.5-0.7-0.7-0.3-0.8-1-0.5-1-0.4-5.3 1.4-3 4.9-7.1 8.8-20.1 10.4-0.6 0.5-0.4 0.8-0.9-0.7-4.4-2.4-4.7-1.2-4.4-0.1-13.7-2-9.9-3-4.1-0.5-5.2-1.3-8.9-1.3 0-1.9-0.7-1.8-0.8-5.6-0.1-2.1 1.1-1 1.5-0.7 0.6-2.4-2.4-1.6-1.3-1.5-0.8-2.1-1.3-2.3-2.4-5.3-0.2-2.2-0.4-0.9-0.1-4.9 0.4-2.5 1-2.4 2.8-3.8 3.2-3.3 2.3-2.8 1.6-0.6 1.5 0 1.5-1.2-0.3-2.1-3.3-3.9-1.2-4-0.9-1.8-0.7-2 0.5-5.7-0.8-3.4-0.1-3.5 0.9-1.3 1.3-0.8 3.4-4.7 0.8-2.1 0.6-4.5-0.4-6.2-0.4-1.6-1.1-1.2-1-0.2 0-25.3 22.8 14.6 6 2.4 26.5-11.3 92.2-0.2z" id="NAM12" name="Oshikoto" class="map"></path>

                                    <path d="M684.6 106.8l-0.5-27.4 7.8-2.1 1.2 0.5 1.3-0.3 1.2-0.5 1.4-0.3 1 0.2 3-0.2 1.2 0.3 3.4 1.9 4.2 1.5 2.2 1.1 1.2 1.6 0.4 0.1 1.4-0.4 23.8-4.6 18.5-3.6 36.9-7.1 15.1-3 15-3 15.1-3 15-3 9.2-1.8 2.6-0.5 1.4 0 21.1-4.4 12.6-2.6 21.1-4.4 1.4-0.1 1.3 0.2 3.9 0.1 0.8 0.5 0.6-0.3 3.1-0.9 1.3-0.1 1.4 0.2 3.1 1.1 2.2 0.5 1.4 0.6 1.8 0.4 0.6 0.4 0.5 0.6 0.6 0.4 1.2 0.5 0.7 0.1 0.7-0.1 0.7-0.3 1.2-1 0.8-0.5 0.9-1.1 0.7-0.2 3.3 0 6.3 1 0.4 0.2 0.8 0.7 0.8 0.2 2.4-0.1 5.1 1 1.9 0.9 1 1.4 1.5-0.7 0.9 0.7 0.9 1.2 1.1 0.9 0.7 0 1.4-0.4 0.8-0.1 0.2 0.2-0.5 1.3 0 0.6 0.5 0.6 0.4 0.3 0.5 0.1 0.9 0 0.2 0.3 1.3 1.2 0.3 0.1 0.6 2.3 0.1 0.4 0.7 0.1 0.5 0.4 0.4 0.6 0.2 0.5 0.6-0.9 0.6 0 1.1 1.1 0.2 0.5-0.1 1 0.1 0.4 0.3 0.3 1.3 0.8 0.9 1.2 0.6 0.3 1.2 0 1 0.3 1 0.6 0.8 0.9 0.5 0.9-4.8-0.9-3 0-2.4 2.4-2.5 1.1-2.2 0-0.7-1.6-2.1 1.3-0.9 0.2-0.7-0.9-1.1 0.5-0.6-0.3-0.5-0.7-0.7-0.5 0.4-1.1-0.8 0.1-0.3 0.4-0.3 0.5-0.5 0.5-0.5 0.3-5.5 1.8-1.4 0.1-1.2 0.3-1.8 1.5-1.5 0.3-0.4 0.3-0.5 1.1-0.6 0.2-0.7 0.1-0.6 0.3-1 0.6-2 2.6-2.5 1.6-1.1 1-3.7 4.5-1.6 1.8-0.2 0.5-0.7 0.2-3.4 0.3-1 0.3-2.5-2.4-0.1-1.2-0.4-0.4-0.5-0.3-0.5-0.5-1.3-2.5-0.9-0.8-1.6-0.3-2.5-0.1-1.1 0.4-1.2 1.2-2.1 3.7-0.7 0.5-0.7-0.1-1.2-0.7-0.8-0.2-1.6-0.2-1.5 0.2-2.6 1.3-3.5 4.3-2.5 1.8-2.6 0.5-0.6 0.3-2.2 2.1-0.5 0.4-2.1 1-0.9 0.6-0.4 0.4-0.3 0.6-0.6-0.5-0.9 0-2.5 1.8-0.3 2.7-1.1 1.1-2.2 1.5-0.9 0.8-1.3 2-0.9 0.9-1.2 0.4-6.9 7.5-1.1 0.7-1.5 0.3-1.8 2.1-0.8 0.6-2.6 0.9-1.3 0-1-0.8-0.5-3.2-1.2-3.4-0.7-1 1.1-1.7-0.7-1.6-2.4-2.6 0.6-1.3-0.4-0.7-0.8-0.6-0.4-0.9-0.3-0.9-0.7-0.3-1-0.2-1-0.4-0.4-0.6-1.1-1.3-1.1-1-0.8 0.8-0.6-0.1-1.1-0.5-0.1-0.4 0.2-1.3-0.1-0.4-0.4-0.8-2.2-2.7-0.9-1.9-0.8-1.2-0.3-0.9 0.1-1.9-0.3-0.2-1.1-0.2-0.2-0.6 0-1-0.1-0.6-0.4-0.3-1-0.5-2.7-0.1-20.2 1.7-6.4 1.3-24.9 4.9-12.5 2.4-6.2 1.2-24.8 4.9-6.3 1.2-12.4 2.4-17.5 3.4-2.8 0.2-32.7 1.3z" id="NAM13" name="Zambezi" class="map"></path>

                                    <circle cx="401.1" cy="454.9" id="0"></circle>
                                    <circle cx="941.8" cy="47.2" id="1"></circle>
                                    <circle cx="956.5" cy="62.7" id="2"></circle>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="card custom-card-style border-secondary bg-dark mt-5">
                        <div class="card-header border-secondary">
                            <h1 style="font-size: 2em; color: white">Find a Loved One</h1>
                        </div>
                        <div class="card-body text-secondary">
                            <form class="search-form" id="searchForm">
                                <div class="form-group">
                                    <label for="fullName">Full Name:</label>
                                    <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Enter full name" required />
                                </div>
                                <div class="form-group">
                                    <label for="deathNumber">Death Number:</label>
                                    <input type="text" id="deathNumber" name="deathNumber" class="form-control" placeholder="Enter death number" required />
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%">
                                    Search
                                </button>
                                <div class="results mt-3"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    document.getElementById('searchForm').addEventListener('submit', function(event) {
                        event.preventDefault();
                        searchGrave();
                    });

                    function searchGrave() {
                        var fullName = document.getElementById('fullName').value;
                        var deathNumber = document.getElementById('deathNumber').value;

                        fetch('../php/search_grave.php?fullName=' + fullName + '&deathNumber=' + deathNumber)
                            .then(response => response.text())
                            .then(data => {
                                document.querySelector('.results').innerHTML = data;
                            });
                    }
                </script>
            </div>
        </div>
    </section>
    
    <!-- Remove the container if you want to extend the Footer to full width. -->
    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div>
        <!-- Footer -->
        <?php
        include '../components/footer.php'; // or include_once if you want to ensure it's included only once
        ?>
        <!-- Footer -->
    </div>
    <!-- End of .container -->

    <script src="../js/index.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>