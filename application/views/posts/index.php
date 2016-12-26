<h2><?php echo $title ?></h2>

<hr>

<?php foreach ($posts as $post) : ?>

    <h4><?php echo $post['title']; ?></h4>
    <small class="post-date"><?php echo $post['created_at']; ?></small> <br>
    <a class="btn btn-default btn-xs" href="<?php echo site_url('/posts/' . $post['slug']) ?>">Read More</a>

    <hr>
<?php endforeach; ?>


