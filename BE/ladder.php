<?php

require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

if(!isset($_GET['gender'])){
    $gender = 'm';
}else{
    $gender = $_GET['gender'];
}
    $results = [];
    $sql = '
SELECT contestant.id as userid, contestant.firstname, contestant.lastname, contestant.nick, workout.name, prepPoints.points,
                           contestant.id as cid, workout.id as wid, RX FROM (
                                                                            SELECT CID, WID, RX, SUM(points) as points
                                                                            FROM (
                                                                                     SELECT
                                                                                         @row_number:=CASE WHEN @workout_id = WID THEN (@row_number + 1) ELSE 1 END AS contestantOrder,
                                                                                         @workout_id:=WID as workout_id, prepSort.*
                                                                                     FROM (
                                                                                              SELECT
                                                                                                  contestant.id as CID, workout.id as WID, workout.byTime as WBT, result.id as RID, result.rx as RX
                                                                                              FROM contestant, workout, result
                                                                                              WHERE contestant.id = result.id_contestant
                                                                                                AND workout.id = result.id_workout
                                                                                              AND contestant.gender  like "'.$gender.'"
                                                                                              ORDER BY workout.id ASC, result.rx DESC,
                                                                                                       CASE WHEN workout.byTime = 1 THEN result.result END ASC,
                                                                                                       CASE WHEN workout.byTime = 0 THEN result.result END DESC
                                                                                              LIMIT 1000
                                                                                          ) prepSort
                                                                                 ) prepOrder, points
                                                                            WHERE prepOrder.contestantOrder = points.position
                                                                            GROUP BY CID, WID
                                                                        ) prepPoints, contestant, workout
                    WHERE prepPoints.CID = contestant.id
                      AND prepPoints.WID = workout.id
                    ORDER BY prepPoints.points DESC
; ';
    mysqli_query($con, 'SET @row_number = 0;');
    mysqli_query($con, 'SET @workout_id = 0;');

    if ($result = mysqli_query($con, $sql)) {
        $cr = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $results[$row['cid']]['firstname'] = $row['firstname'];
            $results[$row['cid']]['lastname'] = $row['lastname'];
            $results[$row['cid']]['nick'] = $row['nick'];
            $results[$row['cid']]['userid'] = $row['userid'];
            if (isset($results[$row['cid']]['total'])) {
                $results[$row['cid']]['total'] += $row['points'];
            } else {
                $results[$row['cid']]['total'] = $row['points'];
            }
            $results[$row['cid']]['workouts'][$row['wid']]['name'] = $row['name'];
            $results[$row['cid']]['workouts'][$row['wid']]['points'] = $row['points'];
            $results[$row['cid']]['workouts'][$row['wid']]['rx'] = $row['RX'];
            $cr++;
        }
         usort($results, function($a, $b) {
            return $b['total'] - $a['total'];
        });

        echo json_encode(['data' => $results]);
    } else {
        http_response_code(404);
    }

}
