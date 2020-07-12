<?php

function get_catagories_name() {
    include "database_connection.php";

    $sql = "select * from categories";
    $run = $conn->prepare($sql);
    $run->execute();

    $return = [];

    if($run->rowCount() > 0) {
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["cid"];
            $name = $row["name"];

            $return[$id] = $name;
        }
    }

    return $return;
}

