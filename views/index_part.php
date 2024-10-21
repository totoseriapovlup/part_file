<a href="/form.php">Add new message</a>
<?php if(count($messages) > 0):?>
    <ul>
        <?php foreach ($messages as $message):?>
            <li><?= $message?></li>
        <?php endforeach;?>
    </ul>
<?php else:?>
    <div>No messages yet</div>
<?php endif;?>
