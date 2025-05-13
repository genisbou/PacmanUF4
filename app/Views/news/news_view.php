<?= $this->extend('layouts/news') ?>

<?= $this->section('news_content') ?>

    <h2><?= esc($news['title']) ?></h2>
    <p><?= esc($news['body']) ?></p>
    <p><a href="<?=base_url('news')?>">Anar noticies</a></p>

<?= $this->endSection() ?>