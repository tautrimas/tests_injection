<?php echo View::factory('menu'); ?>
<ul>
    <?php foreach ($pages as $page) { ?>
        <li><?= $page->url; ?></li>
    <?php } ?>
</ul>
