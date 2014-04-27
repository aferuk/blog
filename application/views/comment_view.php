<div class="container">
    <?php
    foreach ($records as $record)
    {
        echo "<h2>    ".$record->title."</h2>    ";
        echo "<p>    ".$record->body."</p>    <hr/>    ";
    }
    foreach ($comments as $comment)
    {
        echo "<h4>    ".$comment->author."</h4>    ";
        echo "<p>    ".$comment->body."</p>    <hr/>    ";
    }
    echo anchor('blog', 'Back');

    echo '<br /><br />';
    echo '<p><b>Comment this shit</b></p>';
    echo form_open('blog/comment_add');
    echo form_hidden('record_id', $this-> uri-> segment(3));
    ?>

    <div> <input type="text" id="author" name="author" value="Name"/> </div>
    <div> <textarea name="body" id="comment_body" rows="10" cols="40"> Comment</textarea> </div>
    <input type="submit" value="Submit Comment" />

    <?php
        echo form_close();
    ?>
</div>