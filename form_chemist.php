<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        .error-message {
            color: red;
        }

        .submit-botton {
            margin-left: 430px;
            margin-top: 40px;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <div class="sidebar">
        <div class="sidebar">
            <?php require_once 'sidepenal.php'; ?>
        </div>
    </div>
    <main class="main-content border-radius-lg ">

        <?php require_once 'header.php'; ?>


        <div class="container-fluid py-4">
            <div class="row" style="display:inline;">
                <div class="col-lg-7 position-relative z-index-2">



                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <button onclick="history.back()"
                                style="background-color:#46a0f0fe; padding:5px 15px 5px 15px" class="btn btn-dark"><i
                                    class=" fa-solid fa-arrow-left"></i></button>
                            <div class="card">
                                <div class="card-header" style="background-color:#46a0f0fe; color:white;">Add Chemist
                                </div>
                                <div class="card-body">
                                    <form method="POST" id="chemist" action="add_chemist.php"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="new" value="1" />


                                        <!---profile Photo --->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">profile
                                                Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="profile" class="form-control" name="profile"
                                                    accept="image/*">
                                            </div>
                                        </div>
                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name">
                                                <span class="error-message" id="first_name-error"></span>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name">
                                            </div>
                                        </div>

                                        <!-- Age -->
                                        <div class="form-group row">
                                            <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
                                            <div class="col-md-6">
                                                <input type="number" id="age" class="form-control" name="age">
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-md-4 col-form-label text-md-right">Phone</label>
                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control" name="phone">
                                            </div>
                                        </div>
                                        <!-- State-->
                                        <div class="form-group row">
                                            <label for="state"
                                                class="col-md-4 col-form-label text-md-right">State</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="inputState" name="state"
                                                    style="background-color:white ;">
                                                    <option value="" disabled selected>Select State</option>
                                                    <option value="Andra Pradesh">Andra Pradesh</option>
                                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                    <option value="Assam">Assam</option>
                                                    <option value="Bihar">Bihar</option>
                                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                                    <option value="Goa">Goa</option>
                                                    <option value="Gujarat">Gujarat</option>
                                                    <option value="Haryana">Haryana</option>
                                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                    <option value="Jharkhand">Jharkhand</option>
                                                    <option value="Karnataka">Karnataka</option>
                                                    <option value="Kerala">Kerala</option>
                                                    <option value="Madya Pradesh">Madya Pradesh</option>
                                                    <option value="Maharashtra">Maharashtra</option>
                                                    <option value="Manipur">Manipur</option>
                                                    <option value="Meghalaya">Meghalaya</option>
                                                    <option value="Mizoram">Mizoram</option>
                                                    <option value="Nagaland">Nagaland</option>
                                                    <option value="Orissa">Orissa</option>
                                                    <option value="Punjab">Punjab</option>
                                                    <option value="Rajasthan">Rajasthan</option>
                                                    <option value="Sikkim">Sikkim</option>
                                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                                    <option value="Telangana">Telangana</option>
                                                    <option value="Tripura">Tripura</option>
                                                    <option value="Uttaranchal">Uttaranchal</option>
                                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    <option value="West Bengal">West Bengal</option>
                                                    <option disabled style="background-color:#aaa; color:#fff">UNION
                                                        Territories</option>
                                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                        Islands</option>
                                                    <option value="Chandigarh">Chandigarh</option>
                                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli
                                                    </option>
                                                    <option value="Daman and Diu">Daman and Diu</option>
                                                    <option value="Delhi">Delhi</option>
                                                    <option value="Lakshadeep">Lakshadeep</option>
                                                    <option value="Pondicherry">Pondicherry</option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- City -->
                                        <div class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="inputDistrict" name="city"
                                                    style="background-color:white ;">
                                                    <option value="" disabled selected>-- select one -- </option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label for="address"
                                                class="col-md-4 col-form-label text-md-right">Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="address" class="form-control" name="address">
                                            </div>
                                        </div>

                                        <!-- License Number -->
                                        <div class="form-group row">
                                            <label for="license_number"
                                                class="col-md-4 col-form-label text-md-right">License Number</label>
                                            <div class="col-md-6">
                                                <input type="text" id="license_number" class="form-control"
                                                    name="license_number">
                                            </div>
                                        </div>

                                        <!---License Photo --->
                                        <div class="form-group row">
                                            <label for="license_photo"
                                                class="col-md-4 col-form-label text-md-right">License Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="license_photo" class="form-control"
                                                    name="license_photo" accept="image/*">
                                            </div>
                                        </div>

                                        <!-- Aadhar -->
                                        <div class="form-group row">
                                            <label for="aadhar"
                                                class="col-md-4 col-form-label text-md-right">Aadhar</label>
                                            <div class="col-md-6">
                                                <input type="number" id="aadhar" class="form-control" name="aadhar">
                                            </div>
                                        </div>



                                        <!---Signature Photo --->
                                        <div class="form-group row">
                                            <label for="signature"
                                                class="col-md-4 col-form-label text-md-right">Signature</label>
                                            <div class="col-md-6">
                                                <input type="file" id="signature" class="form-control" name="signature"
                                                    accept="image/*">
                                            </div>
                                        </div>


                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail
                                                Address</label>
                                            <div class="col-md-6">
                                                <input type="email" id="email" class="form-control" name="email">
                                            </div>
                                        </div>


                                        <div class="submit-botton">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <?php require_once 'js_links.php'; ?>
    <script src="assets/js/chemist_validation.js"></script>
    <script src="assets/js/statencity.js"></script>

</body>

</html>