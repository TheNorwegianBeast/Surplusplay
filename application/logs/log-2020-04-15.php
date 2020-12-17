<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2020-04-15 06:45:56 --> Severity: error --> Exception: syntax error, unexpected '?' C:\xampp\htdocs\porsche_upgrade\application\views\admin\level\view_level.php 174
ERROR - 2020-04-15 09:00:33 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp\htdocs\porsche_upgrade\application\controllers\Admin.php 105
ERROR - 2020-04-15 09:01:56 --> Query error: Table 'porsche2403.question_g1_m18' doesn't exist - Invalid query: SELECT `q`.*, `g`.`game_name`, `m`.`mission_step`
FROM `question_g1_m18` `q`
JOIN `game` `g` ON `q`.`game_id` =`g`.`game_id`
JOIN `mission_g1` `m` ON `m`.`mission_id` = 18
ERROR - 2020-04-15 09:01:56 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp\htdocs\porsche_upgrade\application\models\admin_model\Mission_model.php 124
ERROR - 2020-04-15 09:53:26 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'porsche1504' C:\xampp\htdocs\porsche_upgrade\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2020-04-15 09:53:26 --> Unable to connect to the database
ERROR - 2020-04-15 09:53:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'porsche1504' C:\xampp\htdocs\porsche_upgrade\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2020-04-15 09:53:27 --> Severity: Warning --> session_start(): Failed to initialize storage module: user (path: C:\xampp\tmp) C:\xampp\htdocs\porsche_upgrade\system\libraries\Session\Session.php 143
ERROR - 2020-04-15 09:53:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'porsche1504' C:\xampp\htdocs\porsche_upgrade\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2020-04-15 09:53:27 --> Unable to connect to the database
ERROR - 2020-04-15 09:53:27 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'porsche1504' C:\xampp\htdocs\porsche_upgrade\system\database\drivers\mysqli\mysqli_driver.php 203
ERROR - 2020-04-15 09:53:27 --> Unable to connect to the database
ERROR - 2020-04-15 09:53:27 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp\htdocs\porsche_upgrade\system\core\Exceptions.php:271) C:\xampp\htdocs\porsche_upgrade\system\helpers\url_helper.php 564
ERROR - 2020-04-15 10:05:03 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 10:05:19 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 10:05:42 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:00:45 --> Severity: Notice --> Array to string conversion C:\xampp\htdocs\porsche_upgrade\application\controllers\admin_controller\User.php 165
ERROR - 2020-04-15 16:04:20 --> Query error: Table 'porsche1404.user_list_g' doesn't exist - Invalid query: SELECT COUNT(*) as ECount
FROM `user_list_g`
WHERE `email` = 'vxv'
ERROR - 2020-04-15 16:04:20 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp\htdocs\porsche_upgrade\application\models\admin_model\User_model.php 93
ERROR - 2020-04-15 16:06:04 --> Severity: Notice --> Undefined variable: p_user_role_id2 C:\xampp\htdocs\porsche_upgrade\application\controllers\admin_controller\User.php 212
ERROR - 2020-04-15 16:08:44 --> Severity: Notice --> Undefined variable: p_user_role_id2 C:\xampp\htdocs\porsche_upgrade\application\controllers\admin_controller\User.php 215
ERROR - 2020-04-15 16:11:27 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:11:40 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:11:52 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:12:03 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:15:34 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
ERROR - 2020-04-15 16:15:48 --> Severity: Notice --> Undefined variable: mission_id C:\xampp\htdocs\porsche_upgrade\application\views\admin\mission\add_budget.php 73
