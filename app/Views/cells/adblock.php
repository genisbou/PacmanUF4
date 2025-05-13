<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Demo cell</h1>

    <?= view_cell('AdblockCell::show', ['type' => 'success', 'message' => 'The user has been updated.']); ?>
    
    <h1>Demo cell controlled simple</h1>
    <?php //= view_cell('AdblockcontrolledCell'); ?>
    
    <h1>Demo cell controlled customitzable</h1>
    <?= view_cell('AdblockcontrolledCell', ['type' => 'success', 'message' => 'The user has been updated.']); ?>
</body>

</html>