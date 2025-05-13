<?= $this->extend('layouts/news') ?>

<?= $this->section('news_content') ?>

<img src="<?=base_url('assets/img/logo.png')?>" >

    <h2><?=esc($title);?></h2>
   
    <?php if (! empty($news) && is_array($news)): ?>

        <?php foreach ($news as $news_item): ?>

            <h3><?= esc($news_item['title']) ?></h3>
            <div class="main">
                <?= esc($news_item['body']) ?>
            </div>
            <p><a href="<?=base_url('news/' . esc($news_item['slug'], 'url') )?>">View article</a></p>
        <!--
                base_url() => http://localhost:port/            => http://localhost:port/news/xxxx
                site_url() => http://localhost:port/index.php/  => http://localhost:port/index.php/news/xxxx

                < ?= base_url('news' . $slug) ? >  => http://localhost:port/news/xxxx
        -->
        <?php endforeach; ?>

    <?php else: ?>

        <h3>No News</h3>
        <p>Unable to find any news for you.</p>

    <?php endif; ?>

<?= $this->endSection() ?>