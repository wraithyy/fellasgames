<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $settings = [];
    $sql = "SELECT id, setting, value  FROM settings";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $settings[$cr]['id'] = $row['id'];
            $settings[$cr]['setting'] = $row['setting'];
            $settings[$cr]['value'] = $row['value'];


            $cr++;
        }

        echo json_encode(['data' => $settings]);
    } else {
        http_response_code(404);
    }

}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data->id > 0) {
        $sql = "UPDATE settings SET  setting=$data->settings, value=$data->value where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
