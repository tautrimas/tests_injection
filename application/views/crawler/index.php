<?php echo View::factory('menu'); ?>
<ul>
    <?php foreach ($pages as $page) { ?>
        <li><a href="<?php echo HTML::chars($page->url); ?>"><?php echo HTML::chars($page->url); ?></a> - <?php echo HTML::chars(substr($page->body, 0, 100)); ?></li>
    <?php } ?>
</ul>
