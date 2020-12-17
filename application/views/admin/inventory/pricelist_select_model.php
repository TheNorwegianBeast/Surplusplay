<?php
$game_id = $_GET['game_id'];
?>
<option value="">Select Model...</option>

<?php
$select_model = $this->Pricelist_model->select_model($game_id);
foreach ($select_model as $row) {
    ?>

    <option value="<?php echo $row->car_model; ?>">
        <?php echo $row->car_model; ?></option>
        <?php
}
?>                                                            
<option value="Other_model">Add Other Car Model</option>
                                                            
