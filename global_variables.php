<?php
if(isset($_SESSION["lang"])) {
    $language = $_SESSION["lang"];
    if ($language == "English") {
        $load_global_variables = load_default_global_variables(); //loading the variables based on language
    } else {
        $load_global_variables = load_default_global_variables($language); //loading the variables based on language
    }
} else {
    $_SESSION["lang"] = "English";
    $language = $_SESSION["lang"];
    $load_global_variables = load_default_global_variables(); //loading the variables based on language
}
require "assets/lang/".$language.".php";

$item_mastery_level = [];
$item_interest_level = [];

foreach ($load_global_variables as $load_global_variable) {
    $var_name = $load_global_variable['var_name'];
    $var_value_english = $load_global_variable['var_value_english'];
    $var_num_order = $load_global_variable['var_num_order'];
    $translations = $load_global_variable['translations'];
    $lang_name = $load_global_variable['lang_name'];

    if($var_name == 'item_mastery_level') {
        $item_mastery_level[$var_num_order] = ($language == 'English') ? $var_value_english : $translations;
    }
    if($var_name == 'item_interest_level') {
        $item_interest_level[$var_num_order] = ($language == 'English') ? $var_value_english : $translations;
    }
}

//set your based url here
$base_url = "http://localhost/project_djas";