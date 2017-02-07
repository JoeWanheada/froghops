<?php
include 'userdata.php';

try {

    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    $query = "DELETE FROM uploads WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);

    if($stmt->execute()){
        // redirect to read records page and
        // tell the user record was deleted
        header('Location: read.php?action=deleted');
    }else{
        die('Nicht möglich die Datei zu löschen');
    }
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>