<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $judges = [];
    $sql = "SELECT id, firstname, lastname, nick  FROM judges";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $judges[$cr]['id'] = $row['id'];
            $judges[$cr]['firstname'] = $row['firstname'];
            $judges[$cr]['lastname'] = $row['lastname'];
            $judges[$cr]['nick'] = $row['nick'];


            $cr++;
        }

        echo json_encode(['data' => $judges]);
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data) {
        $sql = "INSERT INTO judges ( firstname, lastname, nick) values ('$data->firstname', '$data->lastname',  '$data->nick')";

    $result = mysqli_query($con, $sql);
    echo $result;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data->id > 0) {
        $sql = "UPDATE judges  SET firstname = '$data->firstname', lastname = '$data->lastname', nick=$data->age where id = $data->id";

    $result = mysqli_query($con, $sql);
    echo $result;
    }
} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data->id > 0) {
        $sql = "DELETE FROM judges  where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
