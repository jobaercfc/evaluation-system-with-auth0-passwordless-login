<?php
if(isset($_SESSION["lang"])) {
    $language = $_SESSION["lang"];
} else {
    $_SESSION["lang"] = "english";
    $language = $_SESSION["lang"];
}

require "assets/lang/".$language.".php";
$item_mastery_level = array("Level 1", "Level 2", "Level 3", "Level 4", "Level 5");
$item_interest_level = array("Not interested", "Low interest", "Medium interest", "High interest");
$base_url = "http://localhost/project_djas";