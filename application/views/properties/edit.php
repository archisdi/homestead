<h2><?php echo $title ?></h2>
<hr>

<?php if(validation_errors()){?>

    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p><strong>Errors Found</strong></p>
        <?php echo validation_errors() ?>
    </div>

<?php } ?>

<?php echo form_open('/properties/update')?>

<input type="hidden" name="id" value="<?php echo $property['id']?>">

<div class="form-group">
    <label>Type</label>
    <input type="text" name="type" value="<?php echo set_value('type',$property['type']) ?>" class="form-control">
</div>

<div class="form-group">
    <label>Address</label>
    <textarea name="address" class="form-control"><?php echo set_value('address', $property['address']) ?></textarea>
</div>

<div class="form-group">
    <label>Latitude</label>
    <input type="text" name="latitude" value="<?php echo set_value('latitude', $property['latitude']) ?>" class="form-control">
</div>

<div class="form-group">
    <label>Longitude</label>
    <input type="text" name="longitude" value="<?php echo set_value('longitude', $property['longitude']) ?>" class="form-control">
</div>

<div class="form-group">
    <label>Price</label>
    <input type="number" name="price" value="<?php echo set_value('price', $property['price']) ?>" class="form-control">
</div>

<button type="submit" class="btn btn-success btn-block">Edit Property</button>

</form>