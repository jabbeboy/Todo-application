
<td>
    <a class='btn btn-info btn-primary-spacing' name='edit' href='<?php echo "action.php?action=start&id=".$task->id ?>'>
        <span class='glyphicon glyphicon-hand-left'></span> Start
    </a>
    <a class='btn btn-success btn-primary-spacing' name='completed' href='<?php echo "action.php?action=finished&id=" . $task->id ?>'>
        <span class='glyphicon glyphicon-check'></span> Finished
    </a>
    <a class='btn btn-default btn-primary-spacing' name='edit' href='<?php echo "edit.php?id=" . $task->id ?>'>
        <span class='glyphicon glyphicon-edit'></span> Edit
    </a>
</td>