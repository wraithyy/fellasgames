<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $points = [];
    $sql = "SELECT position, points   FROM points";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $points[$cr]['position'] = $row['position'];
            $points[$cr]['points'] = $row['points'];


            $cr++;
        }

        echo json_encode(['data' => $points]);
    } else {
        http_response_code(404);
    }

}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data->id > 0) {
        $sql = "UPDATE points SET  points=$data->points where position = $data->position";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
