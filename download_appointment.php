<?php
require_once 'config/config.php';
require_once 'vendor/autoload.php'; // Include Composer autoload

// use TCPDF; // Import the TCPDF class namespace

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $appointment_id = $_GET['id'];

    $sql = "SELECT a.id as appointment_id, a.date, a.time, a.note, a.status, p.id as patient_id, p.first_name as patient_first_name, p.last_name as patient_last_name, p.email as patient_email, p.phone as patient_phone, d.first_name as doctor_first_name, d.last_name as doctor_last_name, d.specialist as doctor_specialist
                FROM appointment a
                JOIN patient p ON a.patient_id = p.id
                JOIN doctor d ON a.doctor_id = d.id
                WHERE a.id = :appointment_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':appointment_id', $appointment_id);
    $stmt->execute();

    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$appointment) {
        echo "Appointment not found.";
        exit();
    }

    // File name for download
    $filename = $appointment['patient_first_name'] . $appointment['patient_last_name'] . $appointment['date'] . ".pdf";

    // HTML content for PDF
    $html_content = "
            <html>
         <head>
        <title>Appointment Details</title>
        <style>
            body {
                width: 230mm;
                height: 100%;
                margin: 0 auto;
                padding: 0;
                font-size: 12pt;
                background: rgb(204,204,204);
            }
            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
            }
            .main-page {
                width: 210mm;
                min-height: 297mm;
                margin: 10mm auto;
                background: white;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
            }
            .sub-page {
                padding: 1cm;
                height: 297mm;
            }
            @page {
                size: A4;
                margin: 0;
            }
            @media print {
                html, body {
                    width: 210mm;
                    height: 297mm;
                }
                .main-page {
                    margin: 0;
                    border: initial;
                    border-radius: initial;
                    width: initial;
                    min-height: initial;
                    box-shadow: initial;
                    background: initial;
                    page-break-after: always;
                }
            }
        </style>
    </head>
            <body>
                <!-- Your HTML content goes here, use PHP variables to inject data -->
                <h2>Appointment Details</h2>
                <p><strong>Appointment ID:</strong> {$appointment['appointment_id']}</p>
                <p><strong>Date:</strong> {$appointment['date']}</p>
                <p><strong>Time:</strong> {$appointment['time']}</p>
                <p><strong>Note:</strong> {$appointment['note']}</p>
                <p><strong>Status:</strong> {$appointment['status']}</p>
                
                <h2>Patient Details</h2>
                <p><strong>Patient Name:</strong> {$appointment['patient_first_name']} {$appointment['patient_last_name']}</p>
                <p><strong>Email:</strong> {$appointment['patient_email']}</p>
                <p><strong>Phone Number:</strong> {$appointment['patient_phone']}</p>
                
                <h2>Doctor Details</h2>
                <p><strong>Doctor Name:</strong> {$appointment['doctor_first_name']} {$appointment['doctor_last_name']}</p>
                <p><strong>Specialist:</strong> {$appointment['doctor_specialist']}</p>
                
                <p>Thank you for using www.medlacplus.com. Wishing you good health.</p>
                <p>Administrator</p>
                
                <div class='divdisclaimer'>
                    <p><strong>Disclaimer:</strong> Medlac system will make all efforts to honor the appointment. However, in the
                    event of any unforeseen circumstances beyond our control, the appointment may be delayed or
                    rescheduled. A new appointment date and/or time, according to the patient's convenience, and
                    availability of slot with the same specialist,
                    or a new specialist, will be proposed.</p>
                </div>
            </body>
            </html>
        ";

    // Generate PDF
    require_once 'vendor/autoload.php'; // Assuming you are using a library like TCPDF or MPDF

    // Instantiate TCPDF or MPDF class
    $pdf = new TCPDF(); // Change this line based on the library you are using

    // Set margins, etc.
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->AddPage();

    // Add HTML content to PDF
    $pdf->writeHTML($html_content, true, false, true, false, '');

    // Output PDF as attachment
    $pdf->Output($filename, 'D');

    // Close the database connection if needed

} else {
    echo "Invalid appointment ID.";
}
?>