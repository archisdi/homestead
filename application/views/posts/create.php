<h2><?php echo $title ?></h2>
<hr>

<?php echo validation_errors()?>

<?php echo form_open('/posts/create')?>
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="form-group">
        <label>Body</label>
        <textarea name="body" class="form-control" id="editor"></textarea>
    </div>

    <button type="submit" class="btn btn-success btn-block">Submit Post</button>
</form>