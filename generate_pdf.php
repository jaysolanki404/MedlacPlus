<?php
require_once 'config/config.php';
require_once 'vendor/autoload.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get prescription data from the form (make sure to adjust field names accordingly)
    $patientName = isset($_POST['patient_name']) ? $_POST['patient_name'] : '';
    $diagnosis = isset($_POST['diagnosis']) ? $_POST['diagnosis'] : '';
    $medicines = isset($_POST['medicines']) ? $_POST['medicines'] : '';
    $advice = isset($_POST['advice']) ? $_POST['advice'] : '';

    // Convert $medicines array to a formatted string
    $medicinesString = implode(', ', $medicines);

    // File name for download
    $filename = $patientName . "_Prescription_" . date("YmdHis") . ".pdf";

    // HTML content for PDF
    $html_content = "
        <html>
        <head>
            <title>Prescription</title>
            <!-- Add any necessary styles here -->
        </head>
        <body>
            <!-- Your prescription content goes here, use PHP variables to inject data -->
            <h2>Prescription</h2>
            <p><strong>Patient Name:</strong> {$patientName}</p>
            <p><strong>Diagnosis:</strong> {$diagnosis}</p>
            <p><strong>Medicines:</strong> {$medicinesString}</p>
            <p><strong>Advice:</strong> {$advice}</p>

            <!-- Add any additional prescription details here -->

            <p>Thank you for using our prescription service. Wishing you good health.</p>
            <p>Doctor's Name</p>
        </body>
        </html>
    ";

    // Clear any previously buffered output
    ob_clean();

    // Generate PDF
    $pdf = new TCPDF();
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->AddPage();
    $pdf->writeHTML($html_content, true, false, true, false, '');

    // Output PDF as attachment
    $pdf->Output($filename, 'D');

    // Close the database connection if needed
} else {
    echo "Invalid request method.";
}
?>