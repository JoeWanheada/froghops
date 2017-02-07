<!DOCTYPE HTML>
<html>
<head>
    <title>Ihre Dateien</title>
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Dateien anzeigen</h1>
    </div>
    <?php
    // überprüft User ID und weißt die Variable zu
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    include 'userdata.php';
    try {

        $query = "SELECT  id, original_name, groesse, datei_typ FROM uploads WHERE id = ? LIMIT 0,1";
        $stmt = $pdo->prepare( $query );

        // bindet User ID an Fragezeichen im sql Statement
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $typ = $row['datei_typ'];
        $größe = $row['größe'];
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    ?>

</div>
</body>
</html>
<table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Name</td>
        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Dateityp</td>
        <td><?php echo htmlspecialchars($typ, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Größe</td>
        <td><?php echo htmlspecialchars($größe, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='read.php' class='btn btn-danger'>Dateien lesen</a>
        </td>
    </tr>
</table>