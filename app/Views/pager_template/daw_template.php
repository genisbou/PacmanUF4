<?php $pager->setSurroundCount(2) ?>

<style>
    .dawpageactive {
        font-weight: bolder;
        text-decoration: overline;
    }
</style>
<nav>
    <?php if ($pager->hasPreviousPage()) : ?>
        <span>
            <a href="<?= $pager->getFirst() ?>">&lt;&lt;</a></span>
        <span>
            <a href="<?= $pager->getPreviousPage() ?>">&lt;</a>
        </span>
    <?php else : ?>
        <span>&lt;&lt;</span>
        <span>&lt;</span>
    <?php endif ?>
    <!-- << < -->

    <span>&nbsp;</span>
    <?php foreach ($pager->links() as $link) : ?>
        <span <?= $link['active'] ? 'class="dawpageactive"' : '' ?>>
            <a href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></span>
        <span>&nbsp;</span>
    <?php endforeach ?>
    <!-- 1 2 3 4 5 ... -->

    <?php if ($pager->hasNextPage()) : ?>
        <span>
            <a href="<?= $pager->getNextPage() ?>">&gt;</a>
        </span>
        <span>
            <a href="<?= $pager->getLast() ?>">&gt;&gt;</a>
        </span>
    <?php else : ?>
        <span>&gt;</span>
        <span>&gt;&gt;</span>
    <?php endif ?>
    <!-- > >> -->
</nav>