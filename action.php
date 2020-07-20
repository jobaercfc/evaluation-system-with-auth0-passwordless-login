<?php
session_start();

function load_default_global_variables($language=null) {
    require "database_connection.php";
    $sql = "SELECT settings_vars.var_name as var_name, settings_vars_values.var_value_english as var_value_english, settings_vars_values.var_num_order as var_num_order, settings_vars_trans.var_value_translation as translations, languages.language_name as lang_name FROM settings_vars INNER JOIN settings_vars_values ON ( settings_vars.id = settings_vars_values.var_id ) INNER JOIN settings_vars_trans ON ( settings_vars_trans.var_value_id = settings_vars_values.id ) INNER JOIN languages ON ( languages.id = settings_vars_trans.language_id )";
    if($language != null) {
        $addConditions = " where languages.language_name = '$language'";
        $sql .= $addConditions;
    }
    $run = $conn->prepare($sql);
    $run->execute();

    $return = [];
    if($run->rowCount() > 0) {
        $return = $run->fetchAll(PDO::FETCH_ASSOC);
    }

    return $return;
}

function get_catagories_name() {
    require "database_connection.php";

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
    require "database_connection.php";

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
    require "database_connection.php";
    $category_array = [];
    $return = [];
    $categories = get_catagories_name();
    foreach ($categories as $id => $value) {
        $category_array[$id] = [];
    }
    $email = isset($_SESSION["email"]) ? $_SESSION["email"] : '';
    $condition = "where users.email = '".$email."'"; //should be changed after validation
    $fields = "cid as category_id, items.id as specific_item_id, items.*, users.*, user_items_eval.selected_master_level as selected_master_level, user_items_eval.selected_interest_level as selected_interest_level";
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

function set_mastery_level($params) {
    require "database_connection.php";
    $sqlCheck = "select * from user_items_eval where (user_id = ? and item_id = ? and evaluator_user_id = ?)";
    $runCheck = $conn->prepare($sqlCheck);
    $runCheck->execute([$_SESSION['user_id'], $params['item_id'], $_SESSION['user_id']]);

    if($runCheck->rowCount() == 1) {
        $data = [
            'selected_master_level' => $params['selected_master_level'],
            'user_id' => $_SESSION['user_id'],
            'item_id' => $params['item_id'],
            'evaluator_user_id' => $_SESSION['user_id']
        ];
        $sqlMasterLevel = "update user_items_eval set selected_master_level = :selected_master_level where (user_id = :user_id and item_id = :item_id and evaluator_user_id = :evaluator_user_id)";
        $runMasterLevel = $conn->prepare($sqlMasterLevel);
        $runMasterLevel->execute($data);
    }
}

function set_interest_level($params) {
    require "database_connection.php";
    $sqlCheck = "select * from user_items_eval where (user_id = ? and item_id = ? and evaluator_user_id = ?)";
    $runCheck = $conn->prepare($sqlCheck);
    $runCheck->execute([$_SESSION['user_id'], $params['item_id'], $_SESSION['user_id']]);

    if($runCheck->rowCount() == 1) {
        $data = [
            'selected_interest_level' => $params['selected_interest_level'],
            'user_id' => $_SESSION['user_id'],
            'item_id' => $params['item_id'],
            'evaluator_user_id' => $_SESSION['user_id']
        ];
        $sqlMasterLevel = "update user_items_eval set selected_interest_level = :selected_interest_level where (user_id = :user_id and item_id = :item_id and evaluator_user_id = :evaluator_user_id)";
        $runMasterLevel = $conn->prepare($sqlMasterLevel);
        $runMasterLevel->execute($data);
    }
}

if(isset($_POST["set_mastery_level"]) && $_POST["set_mastery_level"]) {
    set_mastery_level($_POST["params"]);
}

if(isset($_POST["set_interest_level"]) && $_POST["set_interest_level"]) {
    set_interest_level($_POST["params"]);
}

if(isset($_POST["set_language"]) && $_POST["language"]) {
    $_SESSION['lang'] = $_POST['language'];
    echo $_SESSION['lang'];
}

if(isset($_POST["check_step"])) {
    require "global_variables.php";
    $return = [];
    if(isset($_POST["complete_steps_warning"])) {
        $return["title"] = $labels['eval_page']['warning_title'];
        $return["msg"] = $labels['eval_page']['warning_incomplete_selection'];
    }
    if(isset($_POST["previous_steps_warning"])) {
        $return["title"] = $labels['eval_page']['warning_title'];
        $return["msg"] = $labels['eval_page']['warning_incomplete_previous_steps'];
    }
    if(isset($_POST["finish_steps"])) {
        $return["title"] = $labels['eval_page']['success_title'];
        $return["msg"] = $labels['eval_page']['success_eval_completed'];
        session_destroy();
    }

    echo json_encode($return);
}

if(isset($_POST["logout"]) && $_POST["logout"] == 1) {
    session_destroy();
    echo "logout";
}

