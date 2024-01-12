<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <style>
        .error-message {
            color: red;
        }

        form {
            padding: 50px;
        }

        .drop {
            width: 103.5%;
        }

        .submit-botton {
            margin-left: 370px;
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
                                style="background-color:#e91e63; padding:5px 15px 5px 15px;" class="btn btn-dark"><i
                                    class=" fa-solid fa-arrow-left"></i></button>
                            <div class="card">
                                <div class="card-header">Add Doctor</div>
                                <div class="card-body">
                                    <form method="POST" id="doctor" action="add_doctor.php"
                                        enctype="multipart/form-data">

                                        <!---profile Photo --->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">profile
                                                Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="profile" class="form-control" name="profile"
                                                    accept="image/*" style="background-color:white ;">
                                            </div>
                                        </div>

                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name" style="background-color:white ;">
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name"
                                                    style="background-color:white ;">
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="form-group row">
                                            <label for="gender"
                                                class="col-md-4 col-form-label text-md-right">Gender</label>
                                            <div class="col-md-6">
                                                <select id="gender" class="form-control" name="gender"
                                                    style="background-color:white ;">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="form-group row">
                                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of
                                                Birth</label>
                                            <div class="col-md-6">
                                                <input type="date" id="dob" class="form-control" name="dob">
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

                                        <!-- Hospital -->
                                        <div class="form-group row">
                                            <label for="hospital"
                                                class="col-md-4 col-form-label text-md-right">Hospital</label>
                                            <div class="col-md-6">
                                                <select id="hospital" class="form-control" name="hospital"
                                                    style="background-color:white ;">
                                                    <option value="" disabled selected>Select Hospital</option>
                                                    <option>All India Institute of Medical Sciences (AIIMS) - New Delhi
                                                    </option>
                                                    <option>Christian Medical College (CMC) - Vellore</option>
                                                    <option>Tata Memorial Hospital - Mumbai</option>
                                                    <option>Apollo Hospitals - Chennai</option>
                                                    <option>Fortis Hospital - Gurgaon</option>
                                                    <option>Lilavati Hospital and Research Centre - Mumbai</option>
                                                    <option>Medanta - The Medicity - Gurgaon</option>
                                                    <option>Sir Ganga Ram Hospital - New Delhi</option>
                                                    <option>Max Super Speciality Hospital - Saket, New Delhi</option>
                                                    <option>Post Graduate Institute of Medical Education and Research
                                                        (PGIMER) - Chandigarh</option>
                                                    <option>Narayana Health (formerly Narayana Hrudayalaya) - Bangalore
                                                    </option>
                                                    <option>Kokilaben Dhirubhai Ambani Hospital - Mumbai</option>
                                                    <option>Artemis Hospital - Gurgaon</option>
                                                    <option>Sankara Nethralaya - Chennai</option>
                                                    <option>Manipal Hospital - Bangalore</option>
                                                    <option>P. D. Hinduja Hospital - Mumbai</option>
                                                    <option>Rajiv Gandhi Cancer Institute and Research Centre - New
                                                        Delhi</option>
                                                    <option>G. Kuppuswamy Naidu Memorial Hospital - Coimbatore</option>
                                                    <option>Jaslok Hospital - Mumbai</option>
                                                    <option>AIIMS - Jodhpur</option>
                                                    <option>Asian Heart Institute - Mumbai</option>
                                                    <option>Amrita Institute of Medical Sciences - Kochi</option>
                                                    <option>Indraprastha Apollo Hospitals - New Delhi</option>
                                                    <option>Nizam's Institute of Medical Sciences (NIMS) - Hyderabad
                                                    </option>
                                                    <option>Breach Candy Hospital - Mumbai</option>
                                                    <option>KEM Hospital - Mumbai</option>
                                                    <option>Bombay Hospital and Medical Research Centre - Mumbai
                                                    </option>
                                                    <option>Global Hospitals - Chennai</option>
                                                    <option>URO Health</option>
                                                    <option>Apex Heart Institute</option>
                                                    <option>Livo Skin Care Hospital</option>
                                                    <option>Escorts Heart Institute and Research Centre - New Delhi
                                                    </option>
                                                    <option>Ruby Hall Clinic - Pune</option>
                                                    <option>Sri Ramachandra Medical Centre - Chennai</option>
                                                    <option>Yashoda Hospitals - Hyderabad</option>
                                                    <option>Shree Cement Company's Hospital - Beawar</option>
                                                    <option>BLK Super Speciality Hospital - New Delhi</option>
                                                    <option>Sree Chitra Tirunal Institute for Medical Sciences and
                                                        Technology (SCTIMST) - Thiruvananthapuram</option>
                                                    <option>St. John's Medical College Hospital - Bangalore</option>
                                                    <option>Tata Main Hospital - Jamshedpur</option>
                                                    <option>Sir H. N. Reliance Foundation Hospital and Research Centre -
                                                        Mumbai</option>
                                                    <option>Dr. L. H. Hiranandani Hospital - Mumbai</option>
                                                    <option>Kokilaben Dhirubhai Ambani Hospital - Mumbai</option>
                                                    <option>Fortis Memorial Research Institute - Gurgaon</option>
                                                    <option>Jehangir Hospital - Pune</option>
                                                    <option>Army Hospital Research and Referral - New Delhi</option>
                                                    <option>Kasturba Medical College (KMC) Hospital - Manipal</option>
                                                    <option>PGIMER Dr. RML Hospital - New Delhi</option>
                                                    <option>Deenanath Mangeshkar Hospital - Pune</option>
                                                    <option>Columbia Asia Referral Hospital - Bangalore</option>
                                                    <option>Ganga Ram Hospital - New Delhi</option>
                                                    <option>M. S. Ramaiah Memorial Hospital - Bangalore</option>
                                                    <option>Bombay Hospital - Indore</option>
                                                    <option>Zydus Hospital - Ahmedabad</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Specialist -->
                                        <div class="form-group row">
                                            <label for="specialist"
                                                class="col-md-4 col-form-label text-md-right">Specialist</label>
                                            <div class="col-md-6">
                                                <select id="specialist" class="form-control" name="specialist"
                                                    style="background-color:white ;">
                                                    <option value="" disabled selected>Select Specialist</option>
                                                    <option value="General medicine">General medicine</option>
                                                    <option value="Urology">Urology</option>
                                                    <option value="Ophthalmology">Ophthalmology</option>
                                                    <option value="Pediatrics">Pediatrics</option>
                                                    <option value="Neurology">Neurology</option>
                                                    <option value="Pathology">Pathology</option>
                                                    <option value="Radiology">Radiology</option>
                                                    <option value="Orthopedics">Orthopedics</option>
                                                    <option value="Nephrology">Nephrology</option>
                                                    <option value="Cardiology">Cardiology</option>
                                                    <option value="Hematology">Hematology</option>
                                                    <option value="Oncology">Oncology</option>
                                                    <option value="Surgery">Surgery</option>
                                                    <option value="General surgery">General surgery</option>
                                                    <option value="Obstetrics and gynaecology">Obstetrics and
                                                        gynaecology</option>
                                                    <option value="Rheumatology">Rheumatology</option>
                                                    <option value="Otorhinolaryngology">Otorhinolaryngology</option>
                                                    <option value="Pulmonology">Pulmonology</option>
                                                    <option value="Dermatology">Dermatology</option>
                                                    <option value="Emergency medicine">Emergency medicine</option>
                                                    <option value="Nuclear medicine">Nuclear medicine</option>
                                                    <option value="Gastroenterology">Gastroenterology</option>
                                                    <option value="Endocrinology">Endocrinology</option>
                                                    <option value="Intensive care medicine">Intensive care medicine
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!---qualification--->
                                        <div class="form-group row">
                                            <label for="qualifitaion"
                                                class="col-md-4 col-form-label text-md-right">Qualifications</label>
                                            <div class="col-md-6">
                                                <select class="drop" name="qualifications[]" id="qualification" multiple
                                                    multiselect-search="true" multiselect-select-all="true"
                                                    multiselect-max-items="7"
                                                    onchange="console.log(this.selectedOptions)">
                                                    <option value="BOptom">BOptom</option>
                                                    <option value="MOptom">MOptom</option>
                                                    <option value="BSc MLT">BSc MLT</option>
                                                    <option value="MSc MLT">MSc MLT</option>
                                                    <option value="BRT">BRT</option>
                                                    <option value="MRT">MRT</option>
                                                    <option value="BMIT">BMIT</option>
                                                    <option value="MMIT">MMIT</option>
                                                    <option value="BSc Nursing">BSc Nursing</option>
                                                    <option value="MSc Nursing">MSc Nursing</option>
                                                    <option value="DPT">DPT</option>
                                                    <option value="MPT">MPT</option>
                                                    <option value="DC">DC</option>
                                                    <option value="ND">ND</option>
                                                    <option value="BSc PA">BSc PA</option>
                                                    <option value="MSc PA">MSc PA</option>
                                                    <option value="BSc RT">BSc RT</option>
                                                    <option value="MSc RT">MSc RT</option>
                                                    <option value="BSc CVT">BSc CVT</option>
                                                    <option value="MSc CVT">MSc CVT</option>
                                                    <option value="BSc RT">BSc RT</option>
                                                    <option value="MSc RT">MSc RT</option>
                                                    <option value="BSc Perfusion">BSc Perfusion</option>
                                                    <option value="MSc Perfusion">MSc Perfusion</option>
                                                    <option value="BSc Dialysis">BSc Dialysis</option>
                                                    <option value="MSc Dialysis">MSc Dialysis</option>
                                                    <option value="BSc MRT">BSc MRT</option>
                                                    <option value="MSc MRT">MSc MRT</option>
                                                    <option value="BSc OT">BSc OT</option>
                                                    <option value="MSc OT">MSc OT</option>
                                                    <option value="BSc ASLP">BSc ASLP</option>
                                                    <option value="MSc ASLP">MSc ASLP</option>
                                                    <option value="BSc PO">BSc PO</option>
                                                    <option value="MBBS">MBBS</option>
                                                    <option value="MD">MD</option>
                                                    <option value="MS">MS</option>
                                                    <option value="DM">DM</option>
                                                    <option value="MCh">MCh</option>
                                                    <option value="DNB">DNB</option>
                                                    <option value="BAMS">BAMS</option>
                                                    <option value="BHMS">BHMS</option>
                                                    <option value="BNYS">BNYS</option>
                                                    <option value="BUMS">BUMS</option>
                                                    <option value="BDS">BDS</option>
                                                    <option value="BPT">BPT</option>
                                                    <option value="B.Sc Nursing">B.Sc Nursing</option>
                                                    <option value="GNM">GNM</option>
                                                    <option value="ANM">ANM</option>
                                                    <option value="MPharm">MPharm</option>
                                                    <option value="MD (Ayurveda)">MD (Ayurveda)</option>
                                                    <option value="MS (Ayurveda)">MS (Ayurveda)</option>
                                                    <option value="MD (Homeopathy)">MD (Homeopathy)</option>
                                                    <option value="MS (Homeopathy)">MS (Homeopathy)</option>
                                                    <option value="DMRD">DMRD</option>
                                                    <option value="DCH">DCH</option>
                                                    <option value="DGO">DGO</option>
                                                    <option value="DA">DA</option>
                                                    <option value="D.Ortho">D.Ortho</option>
                                                    <option value="PG Diploma in Ophthalmology DO">PG Diploma in
                                                        Ophthalmology DO</option>
                                                    <option value="DDVL">DDVL</option>
                                                    <option value="DPM">DPM</option>
                                                    <option value="DTC">DTC</option>
                                                    <option value="DPH">DPH</option>
                                                    <option value="DHA">DHA</option>
                                                    <option value="PGDFM">PGDFM</option>
                                                    <option value="BOT">BOT</option>
                                                    <option value="MOT">MOT</option>
                                                    <option value="BASLP">BASLP</option>
                                                    <option value="MASLP">MASLP</option>
                                                    <option value="BPO">BPO</option>
                                                    <option value="MPO">MPO</option>
                                                </select>
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
                                                    name="license_photo" accept="image/*"
                                                    style="background-color:white ;">
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
                                                    accept="image/*" style="background-color:white ;">
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

                                            <!-- <input type="submit" class="submit-botton"> -->
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

    <script src="assets/js/doctor_validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
    <script src="assets/js/multiselect-dropdown.js"></script>
    <script src="assets/js/statencity.js"></script>
    <?php require_once 'js_links.php'; ?>
</body>

</html>