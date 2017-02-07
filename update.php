<!DOCTYPE HTML>
<html>
<head>
    <title>Update</title>
</head>
<body>
<div class="container">

    <div class="page-header">
        <h1>Dateien aktualisieren</h1>
    </div>
    <?php
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    include 'userdata.php';
    try {

        $query = "SELECT  id, original_name, groesse, datei_typ FROM uploads WHERE id = ? LIMIT 0,1";
        $stmt = $pdo->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $typ = $row['typ'];
        $größe = $row['größe'];
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
    ?>
</div>
</body>
</html>

<?php

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
if($_POST){

    try{
        $query = "UPDATE uploads 
                    SET name=:name, typ=:typ, größe=:größe
                    WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $typ=htmlspecialchars(strip_tags($_POST['typ']));
        $größe=htmlspecialchars(strip_tags($_POST['größe']));
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':typ', $typ);
        $stmt->bindParam(':größe', $größe);
        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            echo "<div class='alert alert-success'>Datei wurde verändert.</div>";
        }else{
            echo "<div class='alert alert-danger'>Da ist etwas schiefgelaufen. Bitte versuche es erneut.</div>";
        }

    }

    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Typ</td>
            <td><textarea name='typ' class='form-control'><?php echo htmlspecialchars($typ, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td>Größe</td>
            <td><input type='größe' name='größe' value="<?php echo htmlspecialchars($größe, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='read.php' class='btn btn-danger'>Dateien lesen</a>
            </td>
        </tr>
    </table>
</form>

