<?= $this->extend('layouts/news') ?>

<?= $this->section('news_content') ?>

<h2><?= esc($title); ?></h2>

[<a href="<?=base_url('/news/create')?>Crear</a>]

<?php if (!empty($news) && is_array($news)) : ?>
   
    <?php foreach ($news as $news_item) : ?>
       
        <h3><?= esc($news_item['title']) ?></h3>
       
        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <p><a href="<?=base_url(['news',esc($news_item['slug'], 'url')])?>">View article</a></p>

    <?php endforeach ?>


    <p><?= $pager->links() ?></p> <?php #Numeros per pagina
                            ?>

    <p><?= $pager->simpleLinks() ?></p> <?php #Enllaç davant i endarrera
                                    ?>

    <p><?= $pager->links('default', 'daw_template'); ?></p> <?php #Plantilla personalitzada
                                                        ?>


<?php else : ?>

    <h3>No News</h3>
    <p>Unable to find any news for you.</p>

<?php endif ?>

<?= $this->endSection() ?>