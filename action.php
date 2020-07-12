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

function get_user_items_eval_details() {
    include "database_connection.php";
    $category_array = [];
    $return = [];
    $categories = get_catagories_name();
    foreach ($categories as $id => $value) {
        $category_array[$id] = [];
    }

    $condition = "where user_items_eval.user_id = 1"; //should be changed after validation
    $sql = "select cid as category_id, items.* from user_items_eval inner join items on (user_items_eval.item_id = items.id) inner join  categories on (items.item_category_id = categories.cid)";
    $sql .= $condition;

    $run = $conn->prepare($sql);
    $run->execute();

    if($run->rowCount() > 0) {
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            array_push($category_array[$row["category_id"]], $row);
        }
    }
    $return["user_id"] = 1;
    $return["categories"] = $category_array;

    return json_encode($return);
}

