<?php
$dataPoints = array();
// Best practice is to create a separate file for handling connection to database
try {
    // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(
        'mysql:host=localhost;dbname=gym;charset=utf8mb4;port=3307','root','root',
        array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_PERSISTENT => false
        )
    );

    $handle = $link->prepare("SELECT Date, Amount FROM payment p LEFT JOIN member m ON p.MemberID = m.MemberID WHERE m.Status = 'activated'");
    $handle->execute();
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);

    foreach ($result as $row) {
        // Convert date to a timestamp
        $date = strtotime($row->Date) * 1000; // Convert to milliseconds
        array_push($dataPoints, array("x" => $date, "y" => $row->Amount));
    }
    $link = null;
} catch (\PDOException $ex) {
    print($ex->getMessage());
}
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "Earning statistics"
    },
    axisX: {
        valueFormatString: "DD MMM YYYY"
    },
    axisY: {
        title: "Amount",
        includeZero: true
    },
    data: [{
        type: "area", // change type to bar, line, area, pie, etc
        xValueType: "dateTime",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 200px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
