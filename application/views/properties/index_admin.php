<h2>Properties</h2>

<hr>


<div class="panel panel-default">
    <table class="table table-striped">
        <tr>
            <th>Property ID</th>
            <th>Type</th>
            <th>Address</th>
            <th>Coordinates</th>
            <th>Status</th>
            <th></th>
        </tr>
        <?php foreach ($properties as $property) : ?>
            <tr>
                <td>#<?php echo $property['id'] ?></td>
                <td><?php echo $property['type'] ?></td>
                <td><?php echo $property['address'] ?></td>
                <td><?php echo $property['latitude'] . ' ,' . $property['longitude'] ?></td>
                <td><?php if ($property['available'] == 1) {
                        echo "<span class='label label-success'>Available</span>";
                    } else {
                        echo "<span class='label label-danger'>Not Available</span>";
                    } ?></td>
                <td><a class="btn btn-default btn-xs" href="<?php echo site_url('/properties/' . $property['id']) ?>">Detail</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


