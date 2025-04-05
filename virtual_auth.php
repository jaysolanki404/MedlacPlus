<html>

<body>


    <?php require_once 'config/config.php';



    $row = $_SESSION['virtual_auth'];

    ?>







    <img src="" alt="licence">
    <?php $imageData = $row['license_photo'];
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px
        width=150px />'; ?>

    <img src="" alt="signature" </body>
    <?php $imageData = $row['digital_signature'];
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="License Photo" height=150px
        width=150px />';
    ?>

</html>