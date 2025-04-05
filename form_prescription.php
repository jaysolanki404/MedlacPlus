<?php require_once 'config/config.php';
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$query = "SELECT * FROM doctor WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch();
$patient_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
if ($patient_id !== null) {
    $query1 = "SELECT * FROM patient WHERE id = :id";
    $stmt = $conn->prepare($query1);
    $stmt->bindParam(':id', $patient_id);
    $stmt->execute();
    $row1 = $stmt->fetch();
} else {
    echo "Patient ID is not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@0.5.3/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to save and download the prescription
        function saveAndDownloadPrescription() {
            // Capture the content of the prescription container
            html2canvas(document.querySelector('.container')).then(function (canvas) {
                // Convert the canvas content to a data URL
                var canvasDataURL = canvas.toDataURL('image/png');
                // Send the data URL to the server for saving
                $.ajax({
                    type: 'POST',
                    url: 'save_prescription.php', // Replace with the actual server-side endpoint
                    data: {
                        image: canvasDataURL
                        // Include other data you want to save, e.g., patient ID, doctor ID, etc.
                    },
                    success: function (response) {
                        // Handle the server response (if needed)
                        response = JSON.parse(response);
                        if (response.status === 'success') {
                            // Show a success message using Swal (SweetAlert)
                            Swal.fire({
                                icon: 'success',
                                title: 'Prescription Saved',
                                text: 'Prescription has been saved successfully!',
                            });
                        } else {
                            // Show an error message using Swal (SweetAlert)
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Failed to save prescription. Please try again.',
                            });
                        }
                    },
                    error: function (error) {
                        // Handle the error (if needed)
                        // Show an error message using Swal (SweetAlert)
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to save prescription. Please try again.',
                        });
                    }
                });
            });
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css" />
    <?php require_once 'css_links.php'; ?>
    <link rel="stylesheet" href="assets/css/prescription.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/72c602bb8f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/display.css">
</head>

<body>
    <div class="sidebar">
        <div class="sidebar">
            <?php require_once 'sidepenal.php'; ?>
        </div>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>
        <div class="container">
            <hr>
            <div class="division-1">
                <div class="logo">
                    <img src="assets/img/apple-icon.png" alt="image of medlac plus">
                </div>
                <div class="name-detail">
                    <b style="font-color:black;">
                        <?php echo $row['first_name'] . $row['last_name']; ?>
                    </b>
                    <div class="regnumdegdiv">
                        <?php echo $row['qualification']; ?>
                        Registeration no:103846
                        <div class="clinicaddress" style="font-size:large;">
                            <p style="font-size:large;">
                                <?php echo $row['address']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <hr>
            <div class="division-2">
                <div class="div-2-part1">
                    <div class="div-2-date">
                        <h2>02 Dec 2022 11:01:01</h2>
                    </div>
                    <div class="div-patient-column">
                        <h2>Patient's Name:</h2>
                        <?php echo $row1['first_name'] . $row1['last_name']; ?>
                        <h2>HOPI(History Of Present Illness)</h2>
                        <p>regular medicine since 45 days</p>
                        <h2>Diagnosis</h2>
                        <input type="text" placeholder="eg: Fever" id="input_diagnosis">
                        <h2>Investigations</h2>
                        <select id="report" name="reports[]">
                            <?php
                            $reportQuery = "SELECT id, name FROM report"; // Include 'id' in the SELECT statement
                            $reportResult = $conn->query($reportQuery);
                            while ($reportRow = $reportResult->fetch(PDO::FETCH_ASSOC)) {
                                $selected = ($reportRow['id'] == $row['report_id']) ? 'selected' : '';
                                echo "<option value='" . $reportRow['id'] . "' $selected>" . $reportRow['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="div-2-part2">
                    <div class="div-2-refno">
                        <h2>Ref no. ECHBFH4668</h2>
                    </div>
                </div>
            </div>
            <hr>
            <hr>
            <div class="division-3">
                <div class="logo2">
                    <img src="IMG/rxlogo.jpg" alt="rx logo">
                </div>
                <div class="div-patient-column">
                    <h1>Prescribed Medicines</h1>
                    <div name="prescription-button">
                        <button id="addButton">Add Medicine</button>
                        <div id="medicineContainer">
                            <!-- Display the medicine div at least once by default -->
                            <div class="medicine-div">
                                <h2>Medicine 1</h2>
                                <form>
                                    <label>Medicine Name:</label>
                                    <select id="medicine" name="medicines[]">
                                        <?php
                                        $medicineQuery = "SELECT id, name FROM medicine"; // Include 'id' in the SELECT statement
                                        $medicineResult = $conn->query($medicineQuery);
                                        while ($medicineRow = $medicineResult->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($medicineRow['id'] == $row['medicine_id']) ? 'selected' : '';
                                            echo "<option value='" . $medicineRow['id'] . "' $selected>" . $medicineRow['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </form>
                                <form>
                                    <label>Feeding Time:</label>
                                    <select>
                                        <option>0+1+1+1</option>
                                        <option>0+0+1+1</option>
                                        <option>0+0+0+1</option>
                                        <option>0+1+1+0</option>
                                        <option>1+0+0+1</option>
                                        <option>1+1+0+0</option>
                                        <option>1+0+0+0</option>
                                        <option>1+0+1+0</option>

                                    </select>
                                </form>
                                <form>
                                    <label>Feeding Rules:</label>
                                    <select>
                                        <option>Before Meal</option>
                                        <option>After Meal</option>
                                        <option>Anytime</option>
                                    </select>
                                </form>
                                <form>
                                    <label>Feeding Days:</label>
                                    <select>
                                        <option>1 day</option>
                                        <option>2 days</option>
                                        <option>3 days</option>
                                        <option>4 days</option>
                                        <option>5 days</option>
                                        <option>6 days</option>
                                        <option>7 days</option>
                                        <option>15 days</option>
                                        <option>30 days</option>
                                    </select>
                                    <br>
                                    <label>Provisional Diagnosis:</label>
                                    <select>
                                        <option>Regular Medicine</option>
                                        <option>Tentative Medicine</option>
                                    </select>
                                </form>
                                <button class="remove-button" onclick="removeMedicineDiv(this)"><span> Remove
                                        Medicine</span></button>
                            </div>
                        </div>
                        <script>
                            const addButton = document.getElementById("addButton");
                            const medicineContainer = document.getElementById("medicineContainer");
                            let divCount = 1; // Initialize to 1 to display at least one medicine div by default
                            // Function to create a new medicine div
                            function createMedicineDiv() {
                                divCount++;
                                const newMedicineDiv = document.createElement("div");
                                newMedicineDiv.className = "medicine-div";
                                newMedicineDiv.innerHTML = `
                                        <h2>Medicine ${divCount}</h2>
                                        <form>
                                            <label>Medicine Name:</label>
                                                                               <select id="medicine" name="medicines[]">
                                        <?php
                                        $medicineQuery = "SELECT id, name FROM medicine"; // Include 'id' in the SELECT statement
                                        $medicineResult = $conn->query($medicineQuery);
                                        while ($medicineRow = $medicineResult->fetch(PDO::FETCH_ASSOC)) {
                                            $selected = ($medicineRow['id'] == $row['medicine_id']) ? 'selected' : '';
                                            echo "<option value='" . $medicineRow['id'] . "' $selected>" . $medicineRow['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                        </form>
                                        <form>
                                            <label>Feeding Time:</label>
                                            <select>
                                                <option>0+1+1+1</option>
                                                <option>0+0+1+1</option>
                                                <option>0+0+0+1</option>
                                                <option>0+1+1+0</option>
                                                <option>1+0+0+1</option>
                                                <option>1+1+0+0</option>
                                                <option>1+0+0+0</option>
                                                <option>1+0+1+0</option>
                                            </select>
                                        </form>
                                        <form>
                                            <label>Feeding Rules:</label>
                                            <select>
                                                <option>Before Meal</option>
                                                <option>After Meal</option>
                                                <option>Anytime</option>
                                            </select>
                                        </form>
                                        <form>
                                            <label>Feeding Days:</label>
                                            <select>
                                                <option>1 day</option>
                                                <option>2 days</option>
                                                <option>3 days</option>
                                                <option>4 days</option>
                                                <option>5 days</option>
                                                <option>6 days</option>
                                                <option>7 days</option>
                                                <option>15 days</option>
                                                <option>30 days</option>
                                            </select>
                                            <br>
                                        <label>Provisional Diagnosis:</label>
                                <select>
                                    <option>Regular Medicine</option>
                                    <option>Tentative Medicine</option>
                                </select>
                                        </form>
                                        <button class="remove-button" onclick="removeMedicineDiv(this)">Remove Medicine</button>
                                    `;
                                return newMedicineDiv;
                            }
                            // Function to add a new medicine div
                            function addMedicineDiv() {
                                const newMedicineDiv = createMedicineDiv();
                                medicineContainer.appendChild(newMedicineDiv);
                            }
                            // Function to remove a medicine div
                            function removeMedicineDiv(buttonElement) {
                                const medicineDiv = buttonElement.parentElement;
                                if (divCount > 1) {
                                    medicineContainer.removeChild(medicineDiv);
                                    divCount--;
                                    // Update medicine numbers for existing medicine divs
                                    const medicineDivs = document.querySelectorAll(".medicine-div");
                                    for (let i = 0; i < medicineDivs.length; i++) {
                                        medicineDivs[i].querySelector("h2").textContent = `Medicine ${i + 1}`;
                                    }
                                }
                            }
                            // Attach click event handler to the "Add Medicine" button
                            addButton.addEventListener("click", addMedicineDiv);
                        </script>
                    </div>
                </div>
                <hr id="hr_advice">
                <hr id="hr_advice">
                <div name="division-preference-advice" style="margin-top: 20px;">
                    <h2>Advice Given:</h2>
                    <input type="text" placeholder="eg:Avoid oily and spicy food" id="adviceid">
                </div>
                <div class="division-4">
                    <div class="signature-logo">
                        <?php
                        $imageData_profile = $row['digital_signature'];
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData_profile) . '" alt="Profile Photo"  width="85" height="75" />';
                        ?>
                        <p class="doctorname">
                            <?php echo $row['first_name'] . $row['last_name']; ?>
                        </p>
                        <p class="degree">
                            <?php echo $row['qualification']; ?>
                        </p>
                    </div>
                </div>
                <div class="div-disclaimer">
                    <div class="div-dis-content">
                        <h3>Disclaimer:</h3>
                        <ol type="1">
                            <li>The information and advice provided here in provisional in nature
                                as it is based on the limited information made available by the
                                patient.
                            </li>
                            <li>
                                The patient is advised to visit in person for through examination at
                                the earliest.
                            </li>
                            <li>
                                The information is confidential in nature and for recipient's use only.
                            </li>
                            <li>
                                The Prescription is generated on the basis of patient's examination.
                            </li>
                            <li>
                                Not valid for medico-legal purpose.
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="save__printprescription_buttons">
                    <div class="savebutton" id="save-button1">
                        <button
                            style="margin-left: 450px; padding:10px; color:white; background-color:blue; margin-top:30px; border:none; border-radius:5px;">Save
                            Prescription</button>
                    </div>
                    <div class="editbutton" id="edit-button1">
                        <button
                            style="margin-left: 10px; padding:10px; color:white; background-color:red; margin-top:30px; border:none; border-radius:5px;">Edit
                            Prescription</button>
                    </div>
                </div>
            </div>
    </main>
    <script>
        new DataTable('#example');
    </script>
    <script src="assets/js/delete.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>