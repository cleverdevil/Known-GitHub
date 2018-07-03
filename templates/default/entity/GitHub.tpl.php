<article class="github-reference">
    <?php

        if (\Idno\Core\site()->template()->getTemplateType() == 'default') {
            ?>
            <h2 class="p-name">
                <a class="u-url" href="<?= $vars['object']->getDisplayURL() ?>">
                    <?php 
                    if (!empty($vars['object']->getTitle())) {
                    ?>
                    <?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?>
                    <?php
                    } else {
                    ?>
                    <?php
                    }
                    ?>
                </a>
            </h2>
            <?php
        }
    ?>
    
    <div class="github-target" style="margin-bottom: 1em;">
        <i class="fab fa-github"></i><a class="u-in-reply-to" href="<?= $vars['object']->getTargetURL() ?>">
            <?= $vars['object']->getTargetURL() ?>
        </a>
    </div>

    <div class="e-content">
        <?= $this->__(['value' => $vars['object']->body, 'object' => $vars['object'], 'rel' => $rel])->draw('forms/output/richtext'); ?>
    </div>
            
    <div style="display: none;">
        <p class="h-card vcard p-author">
            <a href="<?= $vars['object']->getOwner()->getURL(); ?>" class="icon-container">
                <img class="u-logo logo u-photo photo" src="<?= $vars['object']->getOwner()->getIcon(); ?>"/>
            </a>
            <a class="p-name fn u-url url" href="<?= $vars['object']->getOwner()->getURL(); ?>"><?= $vars['object']->getOwner()->getName(); ?></a>
            <a class="u-url" href="<?= $vars['object']->getOwner()->getURL(); ?>">
            <!-- This is here to force the hand of your MF2 parser --></a>
        </p>
    </div>
</article>
