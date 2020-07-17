<?php
session_start();
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

function get_userId_from_email($email) {
    include "database_connection.php";

    $sql = "select * from users where users.email = '".$email."'";
    $run = $conn->prepare($sql);
    $run->execute();

    $return = [];

    if($run->rowCount() == 1) {
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $id = $row["id"];
        }
        array_push($return, $id);
    }
    return $return[0];
}

function get_user_items_eval_details() {
    include "database_connection.php";
    $category_array = [];
    $return = [];
    $categories = get_catagories_name();
    foreach ($categories as $id => $value) {
        $category_array[$id] = [];
    }
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : '';
    $condition = "where users.email = '".$email."'"; //should be changed after validation
    $fields = "cid as category_id, items.id as specific_item_id, items.*, users.*";
    $tablesWithJoins = "from user_items_eval inner join items on (user_items_eval.item_id = items.id) inner join  categories on (items.item_category_id = categories.cid) inner join users on (user_items_eval.user_id = users.id)";
    $sql = "select ".$fields." ".$tablesWithJoins." ";
    $sql .= $condition;

    $run = $conn->prepare($sql);
    $run->execute();

    if($run->rowCount() > 0) {
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            array_push($category_array[$row["category_id"]], $row);
        }
    }
    $return["user_id"] = get_userId_from_email($email);
    $return["categories"] = $category_array;
    return json_encode($return);
}

