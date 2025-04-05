<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <!-- Include necessary CSS styles, if any -->
</head>
<body>
    <div class="container">
        <h1>Prescription</h1>

        <div class="division-1">
            <div class="logo">
                <img src="assets/img/apple-icon.png" alt="image of medlac plus">
            </div>

            <div class="division1-part2">
                <div class="name-detail" style="font-size:large; line-spacing:0.5px;">
                    <b><?php echo $row["first_name"]; ?></b>
                    <div class="regnumdegdiv">
                        <p style="font-size:large;">MBBS</p>
                        <p style="font-size:large;">Registeration no:103846 </p>
                        <div class="clinicaddress" style="margin-right: 100px; font-weight: 400; font-size: large;">
                            Address: Dr. Ladiki Jayaramulu's Clinic(Porumamilla, Cuddapah)
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-line"></div>

        <div class="division-2">
            <div class="div-2-part1">
                <div class="div-2-date">
                    <h2><?php echo date("Y-m-d H:i:s"); ?></h2>
                </div>
                <hr>
                <div class="div-patient-column">
                    <h2>Patient's Name:</h2>
                    <p><?php echo $row1["first_name"]; ?></p>

                    <!-- Include relevant content from your existing HTML code -->
                </div>
            </div>
            <div class="div-2-part2">
                <div class="div-2-refno" style="margin-left:-225px;">
                    <h2>Ref no. ECHBFH4668</h2>
                </div>
            </div>
        </div>

        <div class="custom-line"></div>

        <div class="division-3">
            <div class="logo2">
                <img src="assets/img/rx.jpg" alt="rx logo">
            </div>
            <form method="post" action="generate_pdf.php">
                <div class="div-patient-column">
                    <h1>Prescribed Medicines</h1>
                    <div name="prescription-button">
                        <!-- Include relevant content from your existing HTML code -->
                    </div>
                </div>
                <!-- Include relevant content from your existing HTML code -->
            </form>
        </div>
        <!-- Include relevant content from your existing HTML code -->

        <div class="custom-line"></div>

        <div name="division-preference-advice" style="margin-top: 20px;">
            <h2>Advice Given:</h2>
            <input type="text" placeholder="eg:Avoid oily and spicy food" id="adviceid">
        </div>

        <div class="division-4" style="margin-left:970px;">
            <div class="signature-logo">
                <?php
                $imageData = $row['digital_signature'];
                echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px width=150px/>';
                ?>
                <p class="doctorname"><?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?></p>
                <p class="degree">MBBS</p>
            </div>
        </div>

        <div class="div-disclaimer">
            <div class="div-dis-content">
                <h3>Disclaimer:</h3>
                <ol type="1">
                    <li>The information and advice provided here are provisional in nature
                        as it is based on the limited information made available by the
                        patient.
                    </li>
                    <!-- Include other disclaimer points as needed -->
                </ol>
            </div>
        </div>

        <div class="save__printprescription_buttons">
            <div class="savebutton" id="save-button1">
                <button style="margin-left: 500px; padding:10px; color:white; background-color:blue; margin-top:30px; border:none; border-radius:5px;">Save Prescription</button>
            </div>
            <div class="editbutton" id="edit-button1">
                <button style="margin-left: 10px; padding:10px; color:white; background-color:red; margin-top:30px; border:none; border-radius:5px;">Edit Prescription</button>
            </div>
        </div>
    </div>
</body>
</html>
