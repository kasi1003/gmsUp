<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration | Heavenly Tomb</title>
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-c4fC/3pycE3xDni8eqNJD4E+Mhc7j9xjA3RxDDpoXq3v5fT5Og4iP3X3dxU4Kj/q" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Registration Form</h2>
        <form action="register_process.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
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
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#user_type').change(function () {
                var userType = $(this).val();
                var additionalFields = '';

                if (userType === 'service_provider') {
                    additionalFields = `
                        <div class="form-group">
                            <label for="services">Services Provided:</label>
                            <input type="text" class="form-control" id="services" name="services" required>
                        </div>
                        <div class="form-group">
                            <label for="Description">Description of services Provided:</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="motto">Motto:</label>
                            <input type="text" class="form-control" id="motto" name="motto" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number:</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                        </div>
                        <div class="form-group">
                            <label for="company_email">Company Email:</label>
                            <input type="email" class="form-control" id="company_email" name="company_email" required>
                        </div>
                    `;
                } else if (userType === 'local_authority') {
                    additionalFields = `
                        <div class="form-group">
                            <label for="region">Region:</label>
                            <input type="text" class="form-control" id="region" name="region" required>
                        </div>
                        <div class="form-group">
                            <label for="constituency">Constituency:</label>
                            <input type="text" class="form-control" id="constituency" name="constituency" required>
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
                            <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                        </div>
                    `;
                }

                $('#additional_fields').html(additionalFields);
            });
        });
    </script>
</body>

</html>
