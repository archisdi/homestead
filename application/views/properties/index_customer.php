<h2>Properties</h2>

<hr>

<?php foreach ($properties as $property) : ?>

    <h4><?php echo $property['address']; ?></h4>
    <a class="btn btn-default btn-xs" href="<?php echo site_url('/properties/' . $property['id']) ?>">Detail</a>

    <hr>
<?php endforeach; ?>


