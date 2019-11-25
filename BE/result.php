<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $results = [];
    $sql = "select c.firstname as c_firstname, c.lastname as c_lastname, c.id as c_id, c.nick as c_nick, r.result as r_result,r.rx as r_rx,  r.id as r_id,w.id as w_id, w.name as w_name, w.description as w_description, w.byTime as w_byTime from contestant c join result r  on r.id_contestant = c.id join workout w on r.id_workout = w.id order by id_workout 
";

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $results[$cr]['id'] = $row['r_id'];
            $results[$cr]['result'] = $row['r_result'];
            $results[$cr]['rx'] = $row['r_rx'];
            $results[$cr]['contestant']['id'] = $row['c_id'];
            $results[$cr]['contestant']['firstname'] = $row['c_firstname'];
            $results[$cr]['contestant']['lastname'] = $row['c_lastname'];
            $results[$cr]['contestant']['nick'] = $row['c_nick'];
            $results[$cr]['workout']['id'] = $row['w_id'];
            $results[$cr]['workout']['name'] = $row['w_name'];
            $results[$cr]['workout']['byTime'] = $row['w_byTime'];

            $cr++;
        }

        echo json_encode(['data' => $results]);
    } else {
        http_response_code(404);
    }

} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data) {
        $sql = "INSERT INTO result (  id_contestant, id_workout, result, id_judge, rx) values ( $data->id_contestant, $data->id_workout, $data->result, $data->id_judge, $data->rx)";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    if ($data->id > 0) {
        $sql = "UPDATE result SET id_contestant = $data->id_contestant, id_workout = $data->id_workout, result=$data->result, id_judge=$data->id_judge, rx=$data->rx where id = $data->id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
} else if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
$id = $_GET['id'];

    if ($id > 0) {
        $sql = "DELETE FROM result where id = $id";

        $result = mysqli_query($con, $sql);
        echo $result;
    }
}
