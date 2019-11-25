<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $workouts = [];
    $sql = "SELECT id,  name, description, byTime   FROM workout";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $workouts[$cr]['id'] = $row['id'];

            $workouts[$cr]['description'] = $row['description'];
            $workouts[$cr]['byTime'] = $row['byTime'];
            $workouts[$cr]['name'] = $row['name'];

            $cr++;
        }

        echo json_encode(['data' => $workouts]);
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data) {
        $sql = "INSERT INTO workout (  name, description, byTime) values ( '$data->name', '$data->description', $data->byTime)";
        echo $sql;
        $result = mysqli_query($con, $sql);
        echo $result;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data->id > 0) {
        $sql = "UPDATE workout SET name = '$data->name', description = '$data->description', byTime=$data->byTime where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data->id > 0) {
        $sql = "DELETE FROM workout where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
