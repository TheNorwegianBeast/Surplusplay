<?php
$game_id = $_GET['game_id'];
?>
<option value="">Select Model...</option>

<?php
$select_car_model = $this->Inventory_model->select_car_model($game_id);
foreach ($select_car_model as $row) {
    ?>

    <option value="<?php echo $row->car_model; ?>">
        <?php echo $row->car_model; ?></option>
        <?php
}
?>
<option value="Other_model">Add Other</option>
