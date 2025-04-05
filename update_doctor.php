<?php
require_once 'config/config.php';

$id = $_REQUEST['id'];
$query = "SELECT * FROM doctor WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $id = $_REQUEST['id'];
    $profile = $_FILES["profile"]["tmp_name"];
    $working_days = implode(", ", $_POST['working_days']);
    $qualifications = implode(", ", $_POST['qualifications']);
    // Check if a file has been uploaded
    if (!empty($profile) && is_uploaded_file($profile)) {
        $profileData = file_get_contents($profile);
    } else {
        // No file uploaded, keep the existing profile photo in the database
        $profileData = $row['profile_photo'];
    }

    $update = "UPDATE doctor SET profile_photo = :profile_photo, first_name = :first_name, last_name = :last_name, gender = :gender, dob = :dob, phone = :phone, state = :state, city = :city, address = :address, hospital = :hospital, specialist = :specialist, qualification = :qualification,   working_days = :working_days,  working_from = :working_from,  working_till = :working_till, license_number = :license_number, aadhar_number = :aadhar_number, email = :email WHERE id = :id ";

    $query = $conn->prepare($update);
    $query->bindParam(':id', $id);

    // Bind profile photo only if it exists
    $query->bindParam(':profile_photo', $profileData, PDO::PARAM_LOB);

    // Bind the rest of the parameters
    $query->bindParam(':first_name', $_REQUEST['first_name']);
    $query->bindParam(':last_name', $_REQUEST['last_name']);
    $query->bindParam(':gender', $_REQUEST['gender']);
    $query->bindParam(':dob', $_REQUEST['dob']);
    $query->bindParam(':phone', $_REQUEST['phone']);
    $query->bindParam(':state', $_REQUEST['state']);
    $query->bindParam(':city', $_REQUEST['city']);
    $query->bindParam(':address', $_REQUEST['address']);
    $query->bindParam(':hospital', $_REQUEST['hospital']);
    $query->bindParam(':working_days', $working_days);
    $query->bindParam(':specialist', $_REQUEST['specialist']);
    $query->bindParam(':qualification', $qualifications);
    $query->bindParam(':working_from', $_REQUEST['working_from']);
    $query->bindParam(':working_till', $_REQUEST['working_till']);
    $query->bindParam(':license_number', $_REQUEST['license_number']);
    $query->bindParam(':aadhar_number', $_REQUEST['aadhar_number']);
    $query->bindParam(':email', $_REQUEST['email']);

    $result = $query->execute();
    if ($result) {
        $_SESSION['update'] = 'true';
        echo '<script>window.location.href = "view_doctor_profile.php?id=' . $id . '";</script>';
    } else {
        echo "Error updating record: ";
    }
}
?>


<?php require_once 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>

<body class="g-sidenav-show  bg-gray-100">

    <div class="sidebar">
        <?php require_once 'sidepenal.php'; ?>
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
                                <div class="card-header">Update Doctor</div>
                                <div class="card-body">
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="new" value="1" />

                                        <!-- Profile Photo -->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">Profile
                                                Photo</label>
                                            <div class="col-md-6">
                                                <?php
                                                $imageData_profile = $row['profile_photo'];
                                                $base64_profile = 'data:image/jpeg;base64,' . base64_encode($imageData_profile);
                                                echo '<img src="' . $base64_profile . '" alt="Profile Photo" width="100" height="100" />';
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Change Profile Photo -->
                                        <div class="form-group row">
                                            <label for="profile" class="col-md-4 col-form-label text-md-right">Change
                                                Profile Photo</label>
                                            <div class="col-md-6">
                                                <input type="file" id="profile" class="form-control" name="profile"
                                                    accept="image/*" style="background-color: #FFFFFF;">
                                            </div>
                                        </div>



                                        <!-- First Name -->
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="first_name" class="form-control"
                                                    name="first_name" value="<?php echo $row['first_name']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last
                                                Name</label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_name" class="form-control" name="last_name"
                                                    value="<?php echo $row['last_name']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="form-group row">
                                            <label for="gender"
                                                class="col-md-4 col-form-label text-md-right">Gender</label>
                                            <div class="col-md-6">
                                                <select id="gender" class="form-control" name="gender" required
                                                    style="background-color: #FFFFFF;">
                                                    <option value="male" <?php echo $row['gender'] == 'male' ? 'selected'
                                                        : ''; ?>>Male</option>
                                                    <option value="female" <?php echo $row['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>




                                        <!-- Date of Birth -->
                                        <div class="form-group row">
                                            <label for="dob" class="col-md-4 col-form-label text-md-right">Date of
                                                Birth</label>
                                            <div class="col-md-6">
                                                <input type="date" id="dob" class="form-control" name="dob"
                                                    value="<?php echo $row['dob']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Phone -->
                                        <div class="form-group row">
                                            <label for="phone"
                                                class="col-md-4 col-form-label text-md-right">Phone</label>
                                            <div class="col-md-6">
                                                <input type="tel" id="phone" class="form-control" name="phone"
                                                    value="<?php echo $row['phone']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- State -->
                                        <div class="form-group row">
                                            <label for="state"
                                                class="col-md-4 col-form-label text-md-right">State</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="inputState" name="state"
                                                    style="background-color:white ;" required>
                                                    <option value="" disabled selected>Select State</option>
                                                    <?php
                                                    $states = ["Andra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka", "Kerala", "Madya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Orissa", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttaranchal", "Uttar Pradesh", "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", "Dadar and Nagar Haveli", "Daman and Diu", "Delhi", "Lakshadeep", "Pondicherry"];
                                                    foreach ($states as $state) {
                                                        echo "<option value=\"$state\"";
                                                        if ($state == $row['state']) {
                                                            echo " selected";
                                                        }
                                                        echo ">$state</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="form-group row">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="inputDistrict" name="city"
                                                    style="background-color:white ;" required>
                                                    <option value="" disabled selected>-- select one --</option>
                                                    <?php
                                                    $selectedState = $row['state'];
                                                    $cities = [];
                                                    switch ($selectedState) {
                                                        case "Andra Pradesh":
                                                            $cities = ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Kadapa", "Krishna", "Kurnool", "Prakasam", "Nellore", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari"];
                                                            break;
                                                        case "Arunachal Pradesh":
                                                            $cities = ["Anjaw", "Changlang", "Dibang Valley", "East Kameng", "East Siang", "Kra Daadi", "Kurung Kumey", "Lohit", "Longding", "Lower Dibang Valley", "Lower Subansiri", "Namsai", "Papum Pare", "Siang", "Tawang", "Tirap", "Upper Siang", "Upper Subansiri", "West Kameng", "West Siang", "Itanagar"];
                                                            break;
                                                        case "Assam":
                                                            $cities = ["Baksa", "Barpeta", "Biswanath", "Bongaigaon", "Cachar", "Charaideo", "Chirang", "Darrang", "Dhemaji", "Dhubri", "Dibrugarh", "Goalpara", "Golaghat", "Hailakandi", "Hojai", "Jorhat", "Kamrup Metropolitan", "Kamrup (Rural)", "Karbi Anglong", "Karimganj", "Kokrajhar", "Lakhimpur", "Majuli", "Morigaon", "Nagaon", "Nalbari", "Dima Hasao", "Sivasagar", "Sonitpur", "South Salmara Mankachar", "Tinsukia", "Udalguri", "West Karbi Anglong"];
                                                            break;
                                                        case "Bihar":
                                                            $cities = ["Araria", "Arwal", "Aurangabad", "Banka", "Begusarai", "Bhagalpur", "Bhojpur", "Buxar", "Darbhanga", "East Champaran", "Gaya", "Gopalganj", "Jamui", "Jehanabad", "Kaimur", "Katihar", "Khagaria", "Kishanganj", "Lakhisarai", "Madhepura", "Madhubani", "Munger", "Muzaffarpur", "Nalanda", "Nawada", "Patna", "Purnia", "Rohtas", "Saharsa", "Samastipur", "Saran", "Sheikhpura", "Sheohar", "Sitamarhi", "Siwan", "Supaul", "Vaishali", "West Champaran"];
                                                            break;
                                                        case "Chhattisgarh":
                                                            $cities = ["Balod", "Baloda Bazar", "Balrampur", "Bastar", "Bemetara", "Bijapur", "Bilaspur", "Dantewada", "Dhamtari", "Durg", "Gariaband", "Janjgir Champa", "Jashpur", "Kabirdham", "Kanker", "Kondagaon", "Korba", "Koriya", "Mahasamund", "Mungeli", "Narayanpur", "Raigarh", "Raipur", "Rajnandgaon", "Sukma", "Surajpur", "Surguja"];
                                                            break;
                                                        case "Goa":
                                                            $cities = ["North Goa", "South Goa"];
                                                            break;
                                                        case "Gujarat":
                                                            $cities = ["Ahmedabad", "Amreli", "Anand", "Aravalli", "Banaskantha", "Bharuch", "Bhavnagar", "Botad", "Chhota Udaipur", "Dahod", "Dang", "Devbhoomi Dwarka", "Gandhinagar", "Gir Somnath", "Jamnagar", "Junagadh", "Kheda", "Kutch", "Mahisagar", "Mehsana", "Morbi", "Narmada", "Navsari", "Panchmahal", "Patan", "Porbandar", "Rajkot", "Sabarkantha", "Surat", "Surendranagar", "Tapi", "Vadodara", "Valsad"];
                                                            break;
                                                        case "Haryana":
                                                            $cities = ["Ambala", "Bhiwani", "Charkhi Dadri", "Faridabad", "Fatehabad", "Gurugram", "Hisar", "Jhajjar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Mahendragarh", "Mewat", "Palwal", "Panchkula", "Panipat", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Yamunanagar"];
                                                            break;
                                                        case "Himachal Pradesh":
                                                            $cities = ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul Spiti", "Mandi", "Shimla", "Sirmaur", "Solan", "Una"];
                                                            break;
                                                        case "Jammu and Kashmir":
                                                            $cities = ["Anantnag", "Bandipora", "Baramulla", "Budgam", "Doda", "Ganderbal", "Jammu", "Kargil", "Kathua", "Kishtwar", "Kulgam", "Kupwara", "Leh", "Poonch", "Pulwama", "Rajouri", "Ramban", "Reasi", "Samba", "Shopian", "Srinagar", "Udhampur"];
                                                            break;
                                                        case "Jharkhand":
                                                            $cities = ["Bokaro", "Chatra", "Deoghar", "Dhanbad", "Dumka", "East Singhbhum", "Garhwa", "Giridih", "Godda", "Gumla", "Hazaribagh", "Jamtara", "Khunti", "Koderma", "Latehar", "Lohardaga", "Pakur", "Palamu", "Ramgarh", "Ranchi", "Sahebganj", "Seraikela Kharsawan", "Simdega", "West Singhbhum"];
                                                            break;
                                                        case "Karnataka":
                                                            $cities = ["Bagalkot", "Bangalore Rural", "Bangalore Urban", "Belgaum", "Bellary", "Bidar", "Vijayapura", "Chamarajanagar", "Chikkaballapur", "Chikkamagaluru", "Chitradurga", "Dakshina Kannada", "Davanagere", "Dharwad", "Gadag", "Gulbarga", "Hassan", "Haveri", "Kodagu", "Kolar", "Koppal", "Mandya", "Mysore", "Raichur", "Ramanagara", "Shimoga", "Tumkur", "Udupi", "Uttara Kannada", "Yadgir"];
                                                            break;
                                                        case "Kerala":
                                                            $cities = ["Alappuzha", "Ernakulam", "Idukki", "Kannur", "Kasaragod", "Kollam", "Kottayam", "Kozhikode", "Malappuram", "Palakkad", "Pathanamthitta", "Thiruvananthapuram", "Thrissur", "Wayanad"];
                                                            break;
                                                        case "Madhya Pradesh":
                                                            $cities = ["Agar Malwa", "Alirajpur", "Anuppur", "Ashoknagar", "Balaghat", "Barwani", "Betul", "Bhind", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara", "Damoh", "Datia", "Dewas", "Dhar", "Dindori", "Guna", "Gwalior", "Harda", "Hoshangabad", "Indore", "Jabalpur", "Jhabua", "Katni", "Khandwa", "Khargone", "Mandla", "Mandsaur", "Morena", "Narsinghpur", "Neemuch", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Satna", "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Sidhi", "Singrauli", "Tikamgarh", "Ujjain", "Umaria", "Vidisha"];
                                                            break;
                                                        case "Maharashtra":
                                                            $cities = ["Ahmednagar", "Akola", "Amravati", "Aurangabad", "Beed", "Bhandara", "Buldhana", "Chandrapur", "Dhule", "Gadchiroli", "Gondia", "Hingoli", "Jalgaon", "Jalna", "Kolhapur", "Latur", "Mumbai City", "Mumbai Suburban", "Nagpur", "Nanded", "Nandurbar", "Nashik", "Osmanabad", "Palghar", "Parbhani", "Pune", "Raigad", "Ratnagiri", "Sangli", "Satara", "Sindhudurg", "Solapur", "Thane", "Wardha", "Washim", "Yavatmal"];
                                                            break;
                                                        case "Manipur":
                                                            $cities = ["Bishnupur", "Chandel", "Churachandpur", "Imphal East", "Imphal West", "Jiribam", "Kakching", "Kamjong", "Kangpokpi", "Noney", "Pherzawl", "Senapati", "Tamenglong", "Tengnoupal", "Thoubal", "Ukhrul"];
                                                            break;
                                                        case "Meghalaya":
                                                            $cities = ["East Garo Hills", "East Jaintia Hills", "East Khasi Hills", "North Garo Hills", "Ri Bhoi", "South Garo Hills", "South West Garo Hills", "South West Khasi Hills", "West Garo Hills", "West Jaintia Hills", "West Khasi Hills"];
                                                            break;
                                                        case "Mizoram":
                                                            $cities = ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip", "Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"];
                                                            break;
                                                        case "Nagaland":
                                                            $cities = ["Dimapur", "Kiphire", "Kohima", "Longleng", "Mokokchung", "Mon", "Peren", "Phek", "Tuensang", "Wokha", "Zunheboto"];
                                                            break;
                                                        case "Odisha":
                                                            $cities = ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Debagarh", "Dhenkanal", "Gajapati", "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar", "Khordha", "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada", "Sambalpur", "Subarnapur", "Sundergarh"];
                                                            break;
                                                        case "Punjab":
                                                            $cities = ["Amritsar", "Barnala", "Bathinda", "Faridkot", "Fatehgarh Sahib", "Fazilka", "Firozpur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Mansa", "Moga", "Mohali", "Muktsar", "Pathankot", "Patiala", "Rupnagar", "Sangrur", "Shaheed Bhagat Singh Nagar", "Tarn Taran"];
                                                            break;
                                                        case "Rajasthan":
                                                            $cities = ["Ajmer", "Alwar", "Banswara", "Baran", "Barmer", "Bharatpur", "Bhilwara", "Bikaner", "Bundi", "Chittorgarh", "Churu", "Dausa", "Dholpur", "Dungarpur", "Ganganagar", "Hanumangarh", "Jaipur", "Jaisalmer", "Jalore", "Jhalawar", "Jhunjhunu", "Jodhpur", "Karauli", "Kota", "Nagaur", "Pali", "Pratapgarh", "Rajsamand", "Sawai Madhopur", "Sikar", "Sirohi", "Tonk", "Udaipur"];
                                                            break;
                                                        case "Sikkim":
                                                            $cities = ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"];
                                                            break;
                                                        case "Tamil Nadu":
                                                            $cities = ["Ariyalur", "Chennai", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Erode", "Kanchipuram", "Kanyakumari", "Karur", "Krishnagiri", "Madurai", "Nagapattinam", "Namakkal", "Nilgiris", "Perambalur", "Pudukkottai", "Ramanathapuram", "Salem", "Sivaganga", "Thanjavur", "Theni", "Thoothukudi", "Tiruchirappalli", "Tirunelveli", "Tiruppur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Vellore", "Viluppuram", "Virudhunagar"];
                                                            break;
                                                        case "Telangana":
                                                            $cities = ["Adilabad", "Bhadradri Kothagudem", "Hyderabad", "Jagtial", "Jangaon", "Jayashankar", "Jogulamba", "Kamareddy", "Karimnagar", "Khammam", "Komaram Bheem", "Mahabubabad", "Mahbubnagar", "Mancherial", "Medak", "Medchal", "Nagarkurnool", "Nalgonda", "Nirmal", "Nizamabad", "Peddapalli", "Rajanna Sircilla", "Ranga Reddy", "Sangareddy", "Siddipet", "Suryapet", "Vikarabad", "Wanaparthy", "Warangal Rural", "Warangal Urban", "Yadadri Bhuvanagiri"];
                                                            break;
                                                        case "Tripura":
                                                            $cities = ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unakoti", "West Tripura"];
                                                            break;
                                                        case "Uttar Pradesh":
                                                            $cities = ["Agra", "Aligarh", "Allahabad", "Ambedkar Nagar", "Amethi", "Amroha", "Auraiya", "Azamgarh", "Baghpat", "Bahraich", "Ballia", "Balrampur", "Banda", "Barabanki", "Bareilly", "Basti", "Bhadohi", "Bijnor", "Budaun", "Bulandshahr", "Chandauli", "Chitrakoot", "Deoria", "Etah", "Etawah", "Faizabad", "Farrukhabad", "Fatehpur", "Firozabad", "Gautam Buddha Nagar", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hapur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur Dehat", "Kanpur Nagar", "Kasganj", "Kaushambi", "Kheri", "Kushinagar", "Lalitpur", "Lucknow", "Maharajganj", "Mahoba", "Mainpuri", "Mathura", "Mau", "Meerut", "Mirzapur", "Moradabad", "Muzaffarnagar", "Pilibhit", "Pratapgarh", "Raebareli", "Rampur", "Saharanpur", "Sambhal", "Sant Kabir Nagar", "Shahjahanpur", "Shamli", "Shravasti", "Siddharthnagar", "Sitapur", "Sonbhadra", "Sultanpur", "Unnao", "Varanasi"];
                                                            break;
                                                        case "Uttarakhand":
                                                            $cities = ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital", "Pauri", "Pithoragarh", "Rudraprayag", "Tehri", "Udham Singh Nagar", "Uttarkashi"];
                                                            break;
                                                        case "West Bengal":
                                                            $cities = ["Alipurduar", "Bankura", "Birbhum", "Cooch Behar", "Dakshin Dinajpur", "Darjeeling", "Hooghly", "Howrah", "Jalpaiguri", "Jhargram", "Kalimpong", "Kolkata", "Malda", "Murshidabad", "Nadia", "North 24 Parganas", "Paschim Bardhaman", "Paschim Medinipur", "Purba Bardhaman", "Purba Medinipur", "Purulia", "South 24 Parganas", "Uttar Dinajpur"];
                                                            break;
                                                        case "Andaman and Nicobar Islands":
                                                            $cities = ["Nicobar", "North Middle Andaman", "South Andaman"];
                                                            break;
                                                        case "Chandigarh":
                                                            $cities = ["Chandigarh"];
                                                            break;
                                                        case "Dadra and Nagar Haveli":
                                                            $cities = ["Dadra Nagar Haveli"];
                                                            break;
                                                        case "Daman and Diu":
                                                            $cities = ["Daman", "Diu"];
                                                            break;
                                                        case "Delhi":
                                                            $cities = ["Central Delhi", "East Delhi", "New Delhi", "North Delhi", "North East Delhi", "North West Delhi", "Shahdara", "South Delhi", "South East Delhi", "South West Delhi", "West Delhi"];
                                                            break;
                                                        case "Lakshadweep":
                                                            $cities = ["Lakshadweep"];
                                                            break;
                                                        case "Puducherry":
                                                            $cities = ["Karaikal", "Mahe", "Puducherry", "Yanam"];
                                                            break;
                                                        default:
                                                            $cities = [];
                                                            break;
                                                    }

                                                    foreach ($cities as $city) {
                                                        echo "<option value=\"$city\"";
                                                        if ($city == $row['city']) {
                                                            echo " selected";
                                                        }
                                                        echo ">$city</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group row">
                                            <label for="address"
                                                class="col-md-4 col-form-label text-md-right">Address</label>
                                            <div class="col-md-6">
                                                <input type="text" id="address" class="form-control" name="address"
                                                    value="<?php echo $row['address']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Hospital -->
                                        <div class="form-group row">
                                            <label for="hospital"
                                                class="col-md-4 col-form-label text-md-right">Hospital</label>
                                            <div class="col-md-6">
                                                <select id="hospital" class="form-control" name="hospital"
                                                    style="background-color:white;">
                                                    <option value="<?php echo $row['hospital']; ?>" selected>
                                                        <?php echo $row['hospital']; ?>
                                                    </option>
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
                                                    <option value="General medicine" <?php echo $row['specialist'] == 'General medicine' ? 'selected' : ''; ?>>
                                                        General medicine</option>
                                                    <option value="Urology" <?php echo $row['specialist'] == 'Urology' ? 'selected' : ''; ?>>Urology</option>
                                                    <option value="Ophthalmology" <?php echo $row['specialist'] == 'Ophthalmology' ? 'selected' : ''; ?>>
                                                        Ophthalmology</option>
                                                    <option value="Pediatrics" <?php echo $row['specialist'] == 'Pediatrics' ? 'selected' : ''; ?>>
                                                        Pediatrics</option>
                                                    <option value="Neurology" <?php echo $row['specialist'] == 'Neurology' ? 'selected' : ''; ?>>Neurology</option>
                                                    <option value="Pathology" <?php echo $row['specialist'] == 'Pathology' ? 'selected' : ''; ?>>Pathology</option>
                                                    <option value="Radiology" <?php echo $row['specialist'] == 'Radiology' ? 'selected' : ''; ?>>Radiology</option>
                                                    <option value="Orthopedics" <?php echo $row['specialist'] == 'Orthopedics' ? 'selected' : ''; ?>>
                                                        Orthopedics</option>
                                                    <option value="Nephrology" <?php echo $row['specialist'] == 'Nephrology' ? 'selected' : ''; ?>>
                                                        Nephrology</option>
                                                    <option value="Cardiology" <?php echo $row['specialist'] == 'Cardiology' ? 'selected' : ''; ?>>
                                                        Cardiology</option>
                                                    <option value="Hematology" <?php echo $row['specialist'] == 'Hematology' ? 'selected' : ''; ?>>
                                                        Hematology</option>
                                                    <option value="Oncology" <?php echo $row['specialist'] == 'Oncology' ? 'selected' : ''; ?>>Oncology</option>
                                                    <option value="Surgery" <?php echo $row['specialist'] == 'Surgery' ? 'selected' : ''; ?>>Surgery</option>
                                                    <option value="General surgery" <?php echo $row['specialist'] == 'General surgery' ? 'selected' : ''; ?>>
                                                        General surgery</option>
                                                    <option value="Obstetrics and gynaecology" <?php echo $row['specialist'] == 'Obstetrics and gynaecology' ? 'selected' : ''; ?>>Obstetrics and gynaecology</option>
                                                    <option value="Rheumatology" <?php echo $row['specialist'] == 'Rheumatology' ? 'selected' : ''; ?>>
                                                        Rheumatology</option>
                                                    <option value="Otorhinolaryngology" <?php echo $row['specialist'] == 'Otorhinolaryngology' ? 'selected' : ''; ?>>
                                                        Otorhinolaryngology</option>
                                                    <option value="Pulmonology" <?php echo $row['specialist'] == 'Pulmonology' ? 'selected' : ''; ?>>
                                                        Pulmonology</option>
                                                    <option value="Dermatology" <?php echo $row['specialist'] == 'Dermatology' ? 'selected' : ''; ?>>
                                                        Dermatology</option>
                                                    <option value="Emergency medicine" <?php echo $row['specialist'] == 'Emergency medicine' ? 'selected' : ''; ?>>
                                                        Emergency medicine</option>
                                                    <option value="Nuclear medicine" <?php echo $row['specialist'] == 'Nuclear medicine' ? 'selected' : ''; ?>>
                                                        Nuclear medicine</option>
                                                    <option value="Gastroenterology" <?php echo $row['specialist'] == 'Gastroenterology' ? 'selected' : ''; ?>>
                                                        Gastroenterology</option>
                                                    <option value="Endocrinology" <?php echo $row['specialist'] == 'Endocrinology' ? 'selected' : ''; ?>>
                                                        Endocrinology</option>
                                                    <option value="Intensive care medicine" <?php echo $row['specialist'] == 'Intensive care medicine' ? 'selected' : ''; ?>>Intensive care medicine</option>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- qualification -->
                                        <div class="form-group row">
                                            <label for="qualification"
                                                class="col-md-4 col-form-label text-md-right">Qualifications</label>
                                            <div class="col-md-6">
                                                <select style="width: 103.5%;" class="drop" name="qualifications[]"
                                                    id="qualification" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="7"
                                                    onchange="console.log(this.selectedOptions)">
                                                    <option value="BOptom" <?php echo in_array('BOptom', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BOptom
                                                    </option>
                                                    <option value="MOptom" <?php echo in_array('MOptom', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MOptom
                                                    </option>
                                                    <option value="BSc MLT" <?php echo in_array('BSc MLT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc MLT
                                                    </option>
                                                    <option value="MSc MLT" <?php echo in_array('MSc MLT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc MLT
                                                    </option>
                                                    <option value="BRT" <?php echo in_array('BRT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BR
                                                        T</option>
                                                    <option value="MRT" <?php echo in_array('MRT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MRT
                                                    </option>
                                                    <option value="BMIT" <?php echo in_array('BMIT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BMIT
                                                    </option>
                                                    <option value="MMIT" <?php echo in_array('MMIT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MMIT
                                                    </option>
                                                    <option value="BSc Nursing" <?php echo in_array('BSc Nursing', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc Nursing</option>
                                                    <option value="MSc Nursing" <?php echo in_array('MSc Nursing', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc Nursing</option>
                                                    <option value="DPT" <?php echo in_array('DPT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DPT
                                                    </option>
                                                    <option value="MPT" <?php echo in_array('MPT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MPT
                                                    </option>
                                                    <option value="DC" <?php echo in_array('DC', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DC
                                                    </option>
                                                    <option value="ND" <?php echo in_array('ND', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>ND
                                                    </option>
                                                    <option value="BSc PA" <?php echo in_array('BSc PA', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc PA
                                                    </option>
                                                    <option value="MSc PA" <?php echo in_array('MSc PA', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc PA
                                                    </option>
                                                    <option value="BSc RT" <?php echo in_array('BSc RT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc RT
                                                    </option>
                                                    <option value="MSc RT" <?php echo in_array('MSc RT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc RT
                                                    </option>
                                                    <option value="BSc CVT" <?php echo in_array('BSc CVT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc CVT
                                                    </option>
                                                    <option value="MSc CVT" <?php echo in_array('MSc CVT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc CVT
                                                    </option>
                                                    <option value="BSc RT" <?php echo in_array('BSc RT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc RT
                                                    </option>
                                                    <option value="MSc RT" <?php echo in_array('MSc RT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc RT
                                                    </option>
                                                    <option value="BSc Perfusion" <?php echo in_array('BSc Perfusion', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc Perfusion</option>
                                                    <option value="MSc Perfusion" <?php echo in_array('MSc Perfusion', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc Perfusion</option>
                                                    <option value="BSc Dialysis" <?php echo in_array('BSc Dialysis', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc Dialysis</option>
                                                    <option value="MSc Dialysis" <?php echo in_array('MSc Dialysis', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc Dialysis</option>
                                                    <option value="BSc MRT" <?php echo in_array('BSc MRT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc MRT
                                                    </option>
                                                    <option value="MSc MRT" <?php echo in_array('MSc MRT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc MRT
                                                    </option>
                                                    <option value="BSc OT" <?php echo in_array('BSc OT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc OT
                                                    </option>
                                                    <option value="MSc OT" <?php echo in_array('MSc OT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc OT
                                                    </option>
                                                    <option value="BSc ASLP" <?php echo in_array('BSc ASLP', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc
                                                        ASLP</option>
                                                    <option value="MSc ASLP" <?php echo in_array('MSc ASLP', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MSc
                                                        ASLP</option>
                                                    <option value="BSc PO" <?php echo in_array('BSc PO', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BSc PO
                                                    </option>
                                                    <option value="MBBS" <?php echo in_array('MBBS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MBBS
                                                    </option>
                                                    <option value="MD" <?php echo in_array('MD', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MD
                                                    </option>
                                                    <option value="MS" <?php echo in_array('MS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MS
                                                    </option>
                                                    <option value="DM" <?php echo in_array('DM', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DM
                                                    </option>
                                                    <option value="MCh" <?php echo in_array('MCh', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MCh
                                                    </option>
                                                    <option value="DNB" <?php echo in_array('DNB', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DNB
                                                    </option>
                                                    <option value="BAMS" <?php echo in_array('BAMS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BAMS
                                                    </option>
                                                    <option value="BHMS" <?php echo in_array('BHMS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BHMS
                                                    </option>
                                                    <option value="BNYS" <?php echo in_array('BNYS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BNYS
                                                    </option>
                                                    <option value="BUMS" <?php echo in_array('BUMS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BUMS
                                                    </option>
                                                    <option value="BDS" <?php echo in_array('BDS', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BDS
                                                    </option>
                                                    <option value="BPT" <?php echo in_array('BPT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BPT
                                                    </option>
                                                    <option value="B.Sc Nursing" <?php echo in_array('B.Sc Nursing', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>B.Sc Nursing</option>
                                                    <option value="GNM" <?php echo in_array('GNM', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>GNM
                                                    </option>
                                                    <option value="ANM" <?php echo in_array('ANM', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>ANM
                                                    </option>
                                                    <option value="MPharm" <?php echo in_array('MPharm', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MPharm
                                                    </option>
                                                    <option value="MD (Ayurveda)" <?php echo in_array('MD (Ayurveda)', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MD (Ayurveda)</option>
                                                    <option value="MS (Ayurveda)" <?php echo in_array('MS (Ayurveda)', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MS (Ayurveda)</option>
                                                    <option value="MD (Homeopathy)" <?php echo in_array('MD (Homeopathy)', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MD (Homeopathy)</option>
                                                    <option value="MS (Homeopathy)" <?php echo in_array('MS (Homeopathy)', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MS (Homeopathy)</option>
                                                    <option value="DMRD" <?php echo in_array('DMRD', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DMRD
                                                    </option>
                                                    <option value="DCH" <?php echo in_array('DCH', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DCH
                                                    </option>
                                                    <option value="DGO" <?php echo in_array('DGO', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DGO
                                                    </option>
                                                    <option value="DA" <?php echo in_array('DA', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DA
                                                    </option>
                                                    <option value="D.Ortho" <?php echo in_array('D.Ortho', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>D.Ortho
                                                    </option>
                                                    <option value="PG Diploma in Ophthalmology DO" <?php echo in_array('PG Diploma in Ophthalmology DO', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>PG
                                                        Diploma in Ophthalmology DO</option>
                                                    <option value="DDVL" <?php echo in_array('DDVL', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DDVL
                                                    </option>
                                                    <option value="DPM" <?php echo in_array('DPM', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DPM
                                                    </option>
                                                    <option value="DTC" <?php echo in_array('DTC', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DTC
                                                    </option>
                                                    <option value="DPH" <?php echo in_array('DPH', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DPH
                                                    </option>
                                                    <option value="DHA" <?php echo in_array('DHA', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>DHA
                                                    </option>
                                                    <option value="PGDFM" <?php echo in_array('PGDFM', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>PGDFM
                                                    </option>
                                                    <option value="BOT" <?php echo in_array('BOT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BOT
                                                    </option>
                                                    <option value="MOT" <?php echo in_array('MOT', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MOT
                                                    </option>
                                                    <option value="BASLP" <?php echo in_array('BASLP', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BASLP
                                                    </option>
                                                    <option value="MASLP" <?php echo in_array('MASLP', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MASLP
                                                    </option>
                                                    <option value="BPO" <?php echo in_array('BPO', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>BPO
                                                    </option>
                                                    <option value="MPO" <?php echo in_array('MPO', explode(', ', $row['qualification'])) ? 'selected="selected"' : ''; ?>>MPO
                                                    </option>


                                                </select>

                                            </div>
                                        </div>


                                        <!-- working days -->
                                        <div class="form-group row">
                                            <label for="workingDays"
                                                class="col-md-4 col-form-label text-md-right">Working Days</label>
                                            <div class="col-md-6">
                                                <select style="width: 103.5%;" class="drop" name="working_days[]"
                                                    id="workingDays" multiple multiselect-search="true"
                                                    multiselect-select-all="true" multiselect-max-items="7"
                                                    onchange="console.log(this.selectedOptions)">
                                                    <option value="Monday" <?php echo in_array('Monday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>Monday
                                                    </option>
                                                    <option value="Tuesday" <?php echo in_array('Tuesday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>Tuesday
                                                    </option>
                                                    <option value="Wednesday" <?php echo in_array('Wednesday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>Wednesday
                                                    </option>
                                                    <option value="Thursday" <?php echo in_array('Thursday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>
                                                        Thursday
                                                    </option>
                                                    <option value="Friday" <?php echo in_array('Friday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>Friday
                                                    </option>
                                                    <option value="Saturday" <?php echo in_array('Saturday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>
                                                        Saturday
                                                    </option>
                                                    <option value="Sunday" <?php echo in_array('Sunday', explode(', ', $row['working_days'])) ? 'selected="selected"' : ''; ?>>Sunday
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="working_from"
                                                class="col-md-4 col-form-label text-md-right">Working From</label>
                                            <div class="col-md-6">
                                                <input type="time" id="working_from" class="form-control"
                                                    name="working_from" value="<?php echo $row['working_from']; ?>">
                                            </div>
                                        </div>

                                        <!-- working_till -->
                                        <div class="form-group row">
                                            <label for="working_till"
                                                class="col-md-4 col-form-label text-md-right">Working Till</label>
                                            <div class="col-md-6">
                                                <input type="time" id="working_till" class="form-control"
                                                    name="working_till" value="<?php echo $row['working_till']; ?>">
                                            </div>
                                        </div>



                                        <!-- License Number -->
                                        <div class="form-group row">
                                            <label for="license_number"
                                                class="col-md-4 col-form-label text-md-right">License Number</label>
                                            <div class="col-md-6">
                                                <input type="text" id="license_number" class="form-control"
                                                    name="license_number" value="<?php echo $row['license_number']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>
                                        <!-- 
                                        

                                        <!-- Aadhar -->
                                        <div class="form-group row">
                                            <label for="aadhar"
                                                class="col-md-4 col-form-label text-md-right">Aadhar</label>
                                            <div class="col-md-6">
                                                <input type="text" id="aadhar" class="form-control" name="aadhar_number"
                                                    value="<?php echo $row['aadhar_number']; ?>"
                                                    style="background-color:white ;" readonly>
                                            </div>
                                        </div>




                                        <!-- Email -->
                                        <div class="form-group row">
                                            <label for="email_address"
                                                class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                            <div class="col-md-6">
                                                <input type="email" id="email_address" class="form-control" name="email"
                                                    value="<?php echo $row['email']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>







                    </div>
                </div>
            </div>
            <!-- </div> -->





        </div>


    </main>

    <?php require_once 'js_links.php'; ?>
    <script src="assets/js/statencity.js"></script>
    <script src="assets/js/multiselect-dropdown.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
        crossorigin="anonymous"></script>
</body>

</html>