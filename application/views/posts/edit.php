<h2><?php echo $title ?></h2>
<hr>

<?php echo validation_errors()?>

<?php echo form_open('/posts/update')?>
<input type="hidden" name="id" value="<?php echo $post['id']?>">
<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="<?php echo $post['title']?>">
</div>
<div class="form-group">
    <label>Body</label>
    <textarea rows="15" name="body" class="form-control" id="editor"><?php echo $post['body']?></textarea>
</div>

<button type="submit" class="btn btn-success btn-block">Submit Post</button>
</form>