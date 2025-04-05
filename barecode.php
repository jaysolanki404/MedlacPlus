<?php

require_once 'config/config.php';
require_once 'vendor/autoload.php'; // Load the Composer autoloader

use Picqer\Barcode\BarcodeGeneratorPNG;



        // Generate barcode
        $barcodeNumber = $conn-> // Assuming patient ID is the last inserted ID

        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($barcodeNumber, $generator::TYPE_CODE_128);


        // Save barcode image to a file in the specified location
        $filePath = 'assets/img/barcode/' . $barcodeNumber . '.png';
        file_put_contents($filePath, $barcodeData);

        // Set headers to force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        readfile($filePath);

        // Now redirect to the form
        $_SESSION['add'] = 'true'; // Set the add session variable only on successful insert
        header("Location: form_patient.php");
        exit();
    }


