<h2>Orders</h2>

<hr>

<div class="panel panel-default">
    <table class="table table-striped">
        <tr>
            <th>Order ID</th>
            <th>Address</th>
            <th>Customer</th>
            <th>Order Date</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
        <tr>
            <td>#<?php echo $order['id']; ?></td>
            <td><?php echo $order['address']; ?></td>
            <td><?php echo $order['username']; ?></td>
            <td><?php echo $order['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>