<div class="container">
    <?php
    echo "<h1> Add record</h1> ";
    echo form_open('admin/record_add'); // здесь обработчик добавления комментария
    ?>
    <div> <input type="text" id="title" name="title" value="title"/> </div>
    <div> <textarea name="body" id="body" rows="20" cols="40"></textarea> </div>

    <script type="text/javaSCRIPT"  src="<?php echo base_url('assets/js/ckeditor/ckeditor.js') ?>"></script>
    <script type="text/javaSCRIPT">
        CKEDITOR.replace( 'body' );
    </SCRIPT>

    <input type="submit" value="Submit Record" />
    <?php
    echo form_close();

    ?>
</div>