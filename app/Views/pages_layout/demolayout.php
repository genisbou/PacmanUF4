<?= $this->extend('layouts/demo') ?>

<?= $this->section('css_files') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/estils.css') ?>">
<?= $this->endSection() ?>


<?= $this->section('zona1') ?>
    <h1>Hello World!</h1>

    <?php
        echo "Hola mon!";
        $a=2;

        if ($a==1){
            echo "a es 1";
        } else {
            echo "a no es 1";
        }
    ?>
<?= $this->endSection() ?>

<?= $this->section('js_files') ?>
    <script src="js/demo.js"></script>
<?= $this->endSection() ?>

<?= $this->section('jsbottom_files') ?>
<?= $this->endSection() ?>
