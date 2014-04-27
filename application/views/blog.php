<div class="container">
    <?php

    echo '<p>' . $logged . '</p>';
    echo "<p>     ".anchor('admin/login','logon')." ";
    echo  anchor('admin/logoff','logoff')."  ";
    echo  anchor('admin/record_add','new record')." </p>     ";

    echo '<p>' . $pager . '</p>';

    foreach ($query->result() as $row)
    {
        echo "<h2>    ".$row->title."</h2>    ";
        echo $row->body;
        echo '<p>' . anchor('blog/comments/'.$row->id,'comments') . '</p>';
        echo '<hr/>';
    }

    echo '<p>' . $pager . '</p>';


    $this-> benchmark-> mark('code_end');
    echo "<p> Time generation: ".$this-> benchmark-> elapsed_time('code_start', 'code_end').'"</p> ';

    ?>
</div>