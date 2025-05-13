<!doctype html>
<html>
<head>
    <title><?=$title?></title>
    <?= $this->renderSection('css_files') ?>
    <?= $this->renderSection('js_files') ?>
</head>
<body>
    <?= $this->renderSection('zona1') ?>
    
    <footer>
        <?= $this->renderSection('foot_links') ?>
        
    </footer>
    <?= $this->renderSection('jsbottom_files') ?>
</body>
</html>