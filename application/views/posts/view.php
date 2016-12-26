<h2><?php echo $title ?></h2>
<small class="post-date"><?php echo $post['created_at']; ?></small>
<hr>
<p><?php echo $post['body']; ?></p>
<hr>
<a class="btn btn-default btn-xs" href="<?php echo site_url('/posts/') ?>">Back</a>

<div class="pull-right">

    <?php echo form_open('/posts/delete/'.$post['id'])?>
    <input class="btn btn-danger btn-xs" type="submit" value="Delete">
    </form>

    <a class="btn btn-warning btn-xs" href="<?php echo site_url('/posts/edit/'.$post['slug']) ?>">Edit</a>
</div>



