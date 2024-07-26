<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration | Heavenly Tomb</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <style>
        body, html {
            background-color: #2c2c2c;
            color: white;
            font-family: "Poppins", sans-serif;
        }

        .container {
            max-width: 600px;
            background: #343a40;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #444444;
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #bbbbbb;
        }

        .btn-primary {
            background-color: rgb(74, 144, 255);
            border-color: rgb(74, 144, 255);
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: rgb(0, 98, 255);
        }

        #additional_fields {
            margin-top: 20px;
        }

        .text-center.text-muted {
            color: #bbbbbb;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Registration Form</h2>
        <p class="text-center text-muted">Join us to manage your cemetery services effortlessly.</p>
        
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select class="form-control" id="user_type" name="user_type" required>
                    <option value="" disabled selected>Select your type</option>
                    <option value="service_provider">Service Provider</option>
                    <option value="local_authority">Local Authority</option>
                </select>
            </div>
            <div id="additional_fields"></div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_type').change(function () {
                var userType = $(this).val();
                var additionalFields = '';

                if (userType === 'service_provider') {
                    additionalFields = `
                        <div class="form-group">
                            <label for="services">Services Provided:</label>
                            <input type="text" class="form-control" id="services" name="services" placeholder="Enter services provided" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description of Services Provided:</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter description of services" required>
                        </div>
                        <div class="form-group">
                            <label for="motto">Motto:</label>
                            <input type="text" class="form-control" id="motto" name="motto" placeholder="Enter your motto" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your contact number" required>
                        </div>
                        <div class="form-group">
                            <label for="company_email">Company Email:</label>
                            <input type="email" class="form-control" id="company_email" name="company_email" placeholder="Enter your company email" required>
                        </div>
                    `;
                } else if (userType === 'local_authority') {
                    additionalFields = `
                        <div class="form-group">
                            <label for="region">Region:</label>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Enter your region" required>
                        </div>
                        <div class="form-group">
                            <label for="constituency">Constituency:</label>
                            <input type="text" class="form-control" id="constituency" name="constituency" placeholder="Enter your constituency" required>
                        </div>
                        <div class="form-group">
                            <label for="classification">Classification:</label>
                            <select class="form-control" id="classification" name="classification" required>
                                <option value="" disabled selected>Select classification</option>
                                <option value="municipality">Municipality</option>
                                <option value="town">Town</option>
                                <option value="village">Village</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Enter your contact number" required>
                        </div>
                    `;
                }

                $('#additional_fields').html(additionalFields);
            });
        });
    </script>
</body>

</html>
