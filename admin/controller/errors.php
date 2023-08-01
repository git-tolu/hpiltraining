<?php if(count($errors) > 0):?>
    <div style="color: #ff0000">
        <?php foreach ($errors as $error): ?>
            <p><?= $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
