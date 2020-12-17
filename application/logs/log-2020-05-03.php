<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-05-03 00:00:49 --> Query error: Table 'porsche_ci.game_trans_g' doesn't exist - Invalid query: SELECT `st`.`userident`, `u`.`first_name`, `u`.`last_name`, `st`.`trans_type`
FROM `game_trans_g` `st`
JOIN `user_list_g` `u` ON `st`.`userident` = `u`.`userident`
ORDER BY `st`.`game_trans_id` DESC
ERROR - 2020-05-03 00:00:49 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp\htdocs\porsche_ci\application\models\app_model\Dashboard_manager_model.php 21
ERROR - 2020-05-03 10:36:29 --> Query error: Table 'porsche_ci.question_g1_m' doesn't exist - Invalid query: SELECT *
FROM `question_g1_m`
WHERE `mission_id` = ''
ERROR - 2020-05-03 10:36:29 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp\htdocs\porsche_ci\application\models\app_model\Quiz_model.php 360
ERROR - 2020-05-03 10:36:33 --> Query error: Table 'porsche_ci.question_g1_m' doesn't exist - Invalid query: SELECT *
FROM `question_g1_m`
WHERE `mission_id` = ''
ERROR - 2020-05-03 10:36:33 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp\htdocs\porsche_ci\application\models\app_model\Quiz_model.php 360
ERROR - 2020-05-03 18:10:47 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\porsche_ci\application\controllers\Admin.php 120
