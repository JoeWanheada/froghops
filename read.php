<!DOCTYPE HTML>
<html>
<head>
    <title>Ihre Dateien</title>
</head>
<body>
<?php
include 'userdata.php';
?>
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
echo "<div class='alert alert-success'>Die Datei wurde gelöscht.</div>";
}

<div class="container">
    <div class="page-header">
        <h1>Ihre Dateien</h1>
    </div>
    <?php

    //Auswählen aller Daten
    $query = "SELECT id, original_name, groesse, datei_typ FROM uploads ORDER BY DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    //Anzahl der enthaltenen Spalten
    $num = $stmt->rowCount();

    //gibt alle Spalten in Form einer Tabelle aus
    if($num>0){

        echo "<table class='table table-hover table-responsive table-bordered'>";//start table

        //Tabelle
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Größe</th>";
        echo "<th>Dateityp</th>";
        echo "</tr>";
        //gibt Daten in Form von Zeilen zurück
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            // Datei lesen
            echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";

            // Datei verändern
            echo "<a href='update.php?id={$id}' class='btn btn-primary m-r-1em'>Edit</a>";

            // Datei löschen
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        // end table
        echo "</table>";

    }

// wenn nichts gefunden wird
    else{
        echo "<div class='alert alert-danger'>Keine Dateien vorhanden</div>";
    }
    ?>
</div> <!-- end .container -->

<script type='text/javascript'>
    function delete_user( id ){

        var answer = confirm('Are you sure?');
        if (answer){
            // if user clicked ok,
            // pass the id to delete.php and execute the delete query
            window.location = 'delete.php?id=' + id;
        }
    }
</script>
</body>
</html>