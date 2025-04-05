<?php
require_once 'config/config.php';

$id = $_REQUEST['id'];
$query = "SELECT * FROM receptionist WHERE id=:id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['new']) && $_POST['new'] == 1) {
    $id = $_REQUEST['id'];
    $profile = $_FILES["profile"]["tmp_name"];

    // Check if a file has been uploaded
    if (is_uploaded_file($profile)) {
        $profileData = file_get_contents($profile);
    } else {
        // No file uploaded, keep the existing profile photo in the database
        $profileData = $row['profile_photo'];
    }

    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $gender = $_REQUEST['gender'];
    $age = $_REQUEST['age'];
    $phone = $_REQUEST['phone'];
    $state = $_REQUEST['state'];
    $city = $_REQUEST['city'];
    $address = $_REQUEST['address'];
    $aadhar = $_REQUEST['aadhar_number'];
    $pass = $_REQUEST['12_pass'];
    $email = $_REQUEST['email'];

    $update = "UPDATE receptionist SET profile_photo = :profile_photo, first_name = :first_name, last_name = :last_name, gender = :gender, age = :age, phone = :phone, state = :state, city = :city, address = :address, aadhar_number = :aadhar, 12_pass = :pass, email = :email WHERE id = :id ";

    $query = $conn->prepare($update);
    $query->bindParam(':id', $id);
    $query->bindParam(':profile_photo', $profileData, PDO::PARAM_LOB);
    $query->bindParam(':first_name', $first_name);
    $query->bindParam(':last_name', $last_name);
    $query->bindParam(':gender', $gender);
    $query->bindParam(':age', $age);
    $query->bindParam(':phone', $phone);
    $query->bindParam(':state', $state);
    $query->bindParam(':city', $city);
    $query->bindParam(':address', $address);
    $query->bindParam(':aadhar', $aadhar);
    $query->bindParam(':pass', $pass);
    $query->bindParam(':email', $email);

    $result = $query->execute();
    if ($result) {
        $_SESSION['update'] = 'true';
        echo '<script>window.location.href = "view_receptionist_profile.php?id=' . $id . '";</script>';
    } else {
        echo "Error updating record: ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/display.css">
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
                                <div class="card-header">Update receptionist</div>
                                <div class="card-body">
                                    <form action="#" method="POST" action="" enctype="multipart/form-data">
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
                                                    accept="image/*">
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
                                                <select id="gender" class="form-control" name="gender" required>
                                                    <option value="male" <?php echo $row['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                                    <option value="female" <?php echo $row['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Age -->
                                        <div class="form-group row">
                                            <label for="age" class="col-md-4 col-form-label text-md-right">Date of
                                                Birth</label>
                                            <div class="col-md-6">
                                                <input type="number" id="age" class="form-control" name="age"
                                                    value="<?php echo $row['age']; ?>" required>
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

                                        <!-- Pass -->
                                        <div class="form-group row">
                                            <label for="12_pass" class="col-md-4 col-form-label text-md-right">12th
                                                Pass</label>
                                            <div class="col-md-6">
                                                <input type="number" id="pass" class="form-control" name="12_pass"
                                                    value="<?php echo $row['12_pass']; ?>"
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
        </div>
    </main>

    <?php require_once 'js_links.php'; ?>
</body>

</html>