<?php require_once 'config/config.php';

$id = $_SESSION['id'];
$email = $_SESSION['email'];


$query = "SELECT * FROM doctor WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

// $stmt->rowCount() 
$row = $stmt->fetch();

?>


<!DOCTYPE html>
<html lang="en">

<head>
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
    <style>
        .main-content {
            padding: 21px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar">
            <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'receptionist') { ?>

                <?php require_once 'sidepenal.php'; ?>
            <?php } else { ?>
                <?php require_once 'sidepenal_demo.php'; ?>
            <?php } ?>
        </div>
    </div>
    <main class="main-content">
        <?php require_once 'header.php'; ?>

        <button onclick="history.back()" style="background-color:#e91e63; padding:5px 15px 5px 15px"
            class="btn btn-dark"><i class=" fa-solid fa-arrow-left"></i></button>
        <!-- new button -->


        <div class="division-1">
            <div class="logo">
                <img src="assets\img\apple-icon.png" alt="image of medlac plus">
            </div>


            <div class="name-detail">
                <b>
                    <?php echo $row["first_name"]; ?>
                </b>
                <div class="regnumdegdiv">
                    <p style="font-weight:400; font-size:large;">
                        <?php echo $row["qualification"]; ?>
                    </p>
                    <p style="font-weight:400; font-size:large;">
                        <?php echo $row["license_number"]; ?>
                    </p>
                    <div class="clinicaddress">
                        <?php echo $row["address"]; ?>
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
                    <p>Divyabhai sheerwani</p>

                    <h2>HOPI(History Of Present Illness)</h2>
                    <p>regular medicine since 45 days</p>

                    <h2>Diagnosis</h2>
                    <input type="text" placeholder="eg: Fever" id="input_diagnosis">

                    <h2>Investigations</h2>
                    <select>
                        <option>None</option>
                        <option>CT Scans</option>
                        <option>X Rays</option>
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

                    <div id="medicineContainer" style="font-size:larger; font-weight:400;">
                        <!-- Display the medicine div at least once by default -->
                        <div class="medicine-div">
                            <h2>Medicine 1</h2>
                            <form>
                                <label>Medicine Name:</label>
                                <input type="text" name="medicineName">
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
                                            <input type="text" name="medicineName">
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



            <hr>
            <hr>


            <div name="division-preference-advice" style="margin-top: 20px;">
                <h2>Advice Given:</h2>
                <input type="text" placeholder="eg:Avoid oily and spicy food" id="adviceid">
            </div>

            <div class="division-4">
                <div class="signature-logo">
                    <?php
                    // Display the image using the appropriate content type
                    $imageData = $row['digital_signature'];
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px width=150px/>';
                    ?>
                </div>
            </div>

            <div class="div-disclaimer">
                <div class="div-dis-content">
                    <h3>Disclaimer:</h3>

                    <ol type="1">
                        <li>The information and advice provided here in provisional in nature
                            as it is based on the limited information made available by the<br>
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
                        style="margin-left: 550px; padding:10px; color:white; background-color:blue; margin-top:30px; border:none; border-radius:5px;">Save
                        Prescription</button>
                </div>
                <div class="editbutton" id="edit-button1">
                    <button
                        style="margin-left: 10px; padding:10px; color:white; background-color:red; margin-top:30px; border:none; border-radius:5px;">Edit
                        Prescription</button>
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