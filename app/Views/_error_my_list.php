<?php if (! empty($errors)): ?>
    <div class="alert alert-danger" role="alert" style="background-color: red;color:white" >
        <h1>Els ERRORS DETECTATS SON</h1>
        <ol>
            <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ol>
    </div>
<?php endif ?>