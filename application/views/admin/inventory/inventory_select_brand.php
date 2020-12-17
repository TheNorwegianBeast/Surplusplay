<?php
$game_id = $_GET['game_id'];
?>
<option value="">Select Brand...</option>
<?php
$select_brand  = $this->Inventory_model->select_brand($game_id);
foreach ($select_brand as $value) {
    ?>
    <option value="<?php echo $value->brand_name; ?>">
        <?php echo $value->brand_name; ?></option>
        <?php
}
?>
<option value="Others">Add Other Brand</option>
