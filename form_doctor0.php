<?php require_once 'toaster.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once 'css_links.php';?>
 <style>

    .whitee{
        background-color:white;
    }








   .search-input {
            margin-top: 10%;
            width: 90%;
            margin-bottom: 10px;
            display: none;
            /* Hide the search input initially */
        }

        .search-input input {
            width: 100%;
            padding: 5px;
        }

        .checkbox-dropdown {
            width: 200px;
            border: 1px solid #aaa;
            padding: 10px;
            position: relative;
            margin: 0 auto;
            user-select: none;
            z-index: 1;
        }

        /* Display CSS arrow to the right of the dropdown text */
        .checkbox-dropdown:after {
            content: '';
            height: 0;
            position: absolute;
            width: 0;
            border: 6px solid transparent;
            border-top-color: #000;
            top: 50%;
            right: 10px;
            margin-top: -3px;
        }

        /* Reverse the CSS arrow when the dropdown is active */
        .checkbox-dropdown.is-active:after {
            border-bottom-color: #000;
            border-top-color: #fff;
            margin-top: -9px;
        }

        .checkbox-dropdown-list {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            top: 100%;
            border: inherit;
            border-top: none;
            left: -1px;
            right: -1px;
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
            max-height: 150px;
            overflow-y: auto;
            pointer-events: none;
        }

        .is-active .checkbox-dropdown-list {
            opacity: 1;
            pointer-events: auto;
            background-color: #ffffff;
        }

        .checkbox-dropdown-list li label {
            display: block;
            border-bottom: 1px solid silver;
            padding: 10px;
            transition: all 0.2s ease-out;
        }

        .checkbox-dropdown-list li label:hover {
            background-color: #0096FF;
            color: white;
        }
    .error-message {
        color: red;
    }
    .checkbox-dropdown {
    width: 200px;
    border: 1px solid #aaa;
    padding: 10px;
    position: relative;
    margin: 0 auto;
    
    user-select: none;
}

/* Display CSS arrow to the right of the dropdown text */
.checkbox-dropdown:after {
    content:'';
    height: 0;
    position: absolute;
    width: 0;
    border: 6px solid transparent;
    border-top-color: #000;
    top: 50%;
    right: 10px;
    margin-top: -3px;
}

/* Reverse the CSS arrow when the dropdown is active */
.checkbox-dropdown.is-active:after {
    border-bottom-color: #000;
    border-top-color: #fff;
    margin-top: -9px;
}

.checkbox-dropdown-list {
    list-style: none;
    margin: 0;
    padding: 0;
    position: absolute;
    top: 100%; /* align the dropdown right below the dropdown text */
    border: inherit;
    border-top: none;
    left: -1px; /* align the dropdown to the left */
    right: -1px; /* align the dropdown to the right */
    opacity: 0; /* hide the dropdown */
   
    transition: opacity 0.4s ease-in-out;
    height: 100px;
    overflow: scroll;
    overflow-x: hidden;
    pointer-events: none; /* avoid mouse click events inside the dropdown */
}
.is-active .checkbox-dropdown-list {
    opacity: 1; /* display the dropdown */
    pointer-events: auto; /* make sure that the user still can select checkboxes */
}

.checkbox-dropdown-list li label {
    display: block;
    border-bottom: 1px solid silver;
    padding: 10px;
   
    transition: all 0.2s ease-out;
}

.checkbox-dropdown-list li label:hover {
    background-color: #0096FF;
    color: white;
}

</style>
</head>
<body class="g-sidenav-show  bg-gray-100">

<div class="sidebar">
    <?php require_once 'sidepenal.php';?> 
</div>
<main class="main-content border-radius-lg ">
  <?php require_once 'header.php';?>
  
  <div class="container-fluid py-4">
    <div class="row" style="display:inline;">
      <div class="col-lg-7 position-relative z-index-2">
        <button onclick="history.back()">Back</button>
        
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Add Doctor</div>
              <div class="card-body">
                <form method="POST" id="doctor" action="add_doctor.php" enctype="multipart/form-data">


                                        <!---profile Photo --->
                                        <div class="form-group row" >
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">profile Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="profile" class="form-control" name="profile" accept="image/*" >
                                            </div>
                                        </div>


                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control" name="first_name">
                                                    <span class="error-message" id="first_name-error"></span>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name">
                                            </div>
                                        </div>

                                    <!-- Gender -->
                                        <div class="form-group row">
                                            <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                                            <div class="col-md-6">
                                                <select id="gender" class="form-control" name="gender" >
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Date of Birth -->
                                        <div class="form-group row">
                                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                                            <div class="col-md-6">
                                                <input type="date" id="dob" class="form-control" name="dob" >
                                            </div>
                                        </div> 

                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control" name="phone" >
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="address" class="form-control" name="address"  >
                                            </div>
                                        </div>

                                        <!-- Hospital -->
                                        <div class="form-group row">
                                            <label for="hospital" class="col-md-4 col-form-label text-md-right">Hospital</label>
                                            <div class="col-md-6">
                                                <input type="text" id="hospital" class="form-control" name="hospital" >
                                            </div>
                                        </div>

                                        <!-- Specialist -->
                                        <div class="form-group row">
                                            <label for="specialist" class="col-md-4 col-form-label text-md-right">Specialist</label>
                                            <div class="col-md-6">
                                                <select id="specialist" class="form-control" name="specialist" >
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
                                                    <option value="Obstetrics and gynaecology">Obstetrics and gynaecology</option>
                                                    <option value="Rheumatology">Rheumatology</option>
                                                    <option value="Otorhinolaryngology">Otorhinolaryngology</option>
                                                    <option value="Pulmonology">Pulmonology</option>
                                                    <option value="Dermatology">Dermatology</option>
                                                    <option value="Emergency medicine">Emergency medicine</option>
                                                    <option value="Nuclear medicine">Nuclear medicine</option>
                                                    <option value="Gastroenterology">Gastroenterology</option>
                                                    <option value="Endocrinology">Endocrinology</option>
                                                    <option value="Intensive care medicine">Intensive care medicine</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="qualification"
                                                class="col-md-4 col-form-label text-md-right">qualification</label>
                                            <div class="col-md-6">
                                                <div class="checkbox-dropdown" id="qualification-dropdown">
                                                    <div class="selected-items"
                                                        onclick="toggleDropdown('qualification-dropdown')">Select
                                                        qualification</div>
                                                    <div class="search-input">
                                                        <input type="text" placeholder="search..."
                                                            oninput="filterOptions()">
                                                    </div>
                                                    <ul class="checkbox-dropdown-list">
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="General medicine">General medicine</label>
                                                        </li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="Boptom">Boptom</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="Moptom">Moptom</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc MLT">BSc MLT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc MLT">MSc MLT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BRT">BRT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MRT">MRT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BMIT">BMIT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MMIT">MMIT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc Nursing">BSc Nursing</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc Nursing">MSc Nursing</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DPT">DPT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MPT">MPT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DC">DC</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="ND">ND</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc PA">BSc PA</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc PA">MSc PA</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc RT">BSc RT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="Moptom">Moptom</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc RT">MSc RT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc RT">BSc RT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc RT">MSc RT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc Perfusion">BSc Perfusion</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc Perfusion">MSc Perfusion</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc Dialysis">BSc Dialysis</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc Dialysis">MSc Dialysis</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc MRT">BSc MRT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc MRT">MSc MRT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc OT">BSc OT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc OT">MSc OT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]" value="BSc ASLP
                                                        ">BSc ASLP
                                                            </label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc ASLP">MSc ASLP</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc PO">BSc PO</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MBBS">MBBS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MD">MD</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MS">MS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DM">DM</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MCh">MCh</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DNB">DNB</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BAMS">BAMS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BHMS">BHMS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BNYS">BNYS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BUMS">BUMS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BDS">BDS</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BPT">BPT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="B.Sc Nursing">B.Sc Nursing</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="GNM">GNM</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BSc MLT">BSc MLT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc MLT">MSc MLT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="ANM">ANM</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MPharm">MPharm</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MD (Ayurveda)">MD (Ayurveda)</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MSc MLT">MSc MLT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MS (Ayurveda)">MS (Ayurveda)</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]" value="MD (Homeopathy)
                                                        ">MD (Homeopathy)
                                                            </label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MS (Homeopathy)">MS (Homeopathy)</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DMRD">DMRD</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DCH">DCH</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DGO">DGO</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DA">DA</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="D.Ortho">D.Ortho</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="PG Diploma in Ophthalmology DO">PG Diploma in
                                                                Ophthalmology DO</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DDVL">DDVL</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DPM">DPM</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DTC">DTC</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DPH">DPH</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="DHA">DHA</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="PGDFM">PGDFM</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BOT">BOT</label></li>

                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MOT">MOT</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BASLP">BASLP</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MASLP">MASLP</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="BPO">BPO</label></li>
                                                        <li><label><input type="checkbox" name="qualification[]"
                                                                    value="MPO">MPO</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- License Number -->
                                        <div class="form-group row">
                                            <label for="license_number" class="col-md-4 col-form-label text-md-right">License Number</label>
                                            <div class="col-md-6">
                                                <input type="text" id="license_number" class="form-control" name="license_number" >
                                            </div>
                                        </div>

                                        <!---License Photo --->
                                        <div class="form-group row">
                                            <label for="license_photo" class="col-md-4 col-form-label text-md-right">License Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="license_photo" class="form-control" name="license_photo" accept="image/*" >
                                            </div>
                                        </div>


                                        <!-- Aadhar -->
                                        <div class="form-group row">
                                            <label for="aadhar" class="col-md-4 col-form-label text-md-right">Aadhar</label>
                                            <div class="col-md-6">
                                                <input type="number" id="aadhar" class="form-control" name="aadhar">
                                            </div>
                                        </div>

<!---Signature Photo --->
<div class="form-group row">
    <label for="signature" class="col-md-4 col-form-label text-md-right">Signature</label>
    <div class="col-md-6">
        <input type="file" id="signature" class="form-control" name="signature" accept="image/*" >
    </div>
</div>



                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="email" id="email" class="form-control" name="email"  >
                                            </div>
                                        </div>


                  <!-- ... (remaining form fields) ... -->

                  <div class="col-md-6 offset-md-4">
                    <input type="submit">
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
 <script>
        function toggleDropdown(dropdownId) {
            var dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('is-active');
            var searchInput = dropdown.querySelector('.search-input');
            searchInput.style.display = dropdown.classList.contains('is-active') ? 'block' : 'none';
        }

        function filterOptions() {
            var input, filter, ul, li, label, i, txtValue;
            input = document.querySelector('.search-input input');
            filter = input.value.toUpperCase();
            ul = document.querySelector('.checkbox-dropdown-list');
            li = ul.querySelectorAll('li');

            for (i = 0; i < li.length; i++) {
                label = li[i].getElementsByTagName('label')[0];
                txtValue = label.textContent || label.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = '';
                } else {
                    li[i].style.display = 'none';
                }
            }
        }
    </script>
<?php require_once 'js_links.php';?>
</body>
</html>
