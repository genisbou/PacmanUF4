<?= $this->extend('layouts/news') ?>

<?= $this->section('news_content') ?>

<h2><?= esc($title) ?></h2>

<?= validation_list_errors() ?>
<hr>
<?= validation_list_errors('daw_errors') ?>

<form action="<?=base_url('/news/create')?>" method="POST">
    <?= csrf_field(); ?> <!-- token de seguretat de proteccio CSRF input:hidden -->

    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?=old('title')?>" ><?= validation_show_error('title') ?></br>

    <label for="body">Text</label>
    <textarea name="body" id="body" cols="45" rows="4"><?=old('body')?></textarea><?= validation_show_error('body') ?></br>

    <input type="submit" value="Create news">
</form>

<p><a href="<?=base_url('/news')?>">Tornar a noticies</a></p>


<?= $this->endSection() ?>