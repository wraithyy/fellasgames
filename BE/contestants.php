<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $contestants = [];
    $sql = "SELECT id, firstname, lastname, nick, gender   FROM contestant";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $contestants[$cr]['id'] = $row['id'];
            $contestants[$cr]['firstname'] = $row['firstname'];
            $contestants[$cr]['lastname'] = $row['lastname'];
            $contestants[$cr]['nick'] = $row['nick'];
            $contestants[$cr]['gender'] = $row['gender'];

            $cr++;
        }

        echo json_encode(['data' => $contestants]);
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data) {
        $sql = "INSERT INTO contestant ( firstname, lastname,  nick, gender) values ('$data->firstname', '$data->lastname',  '$data->nick', '$data->gender')";

    $result = mysqli_query($con, $sql);
    echo $result;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data->id > 0) {
        $sql = "UPDATE contestant SET firstname = '$data->firstname', lastname = '$data->lastname', nick='$data->nick', gender = '$data->gender' where id = $data->id";

    $result = mysqli_query($con, $sql);
    echo $result;
    }
} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if ($data->id > 0) {
        $sql = "DELETE FROM contestant where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
