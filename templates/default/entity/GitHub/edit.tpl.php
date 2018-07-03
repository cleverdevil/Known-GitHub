<?= $this->draw('entity/edit/header'); ?>
<?php

    $autosave = new \Idno\Core\Autosave();
    if (!empty($vars['object']->body)) {
        $body = $vars['object']->body;
    } else {
        $body = $autosave->getValue('github', 'bodyautosave');
    }
    if (!empty($vars['object']->title)) {
        $title = $vars['object']->title;
    } else {
        $title = $autosave->getValue('github', 'title');
    }
    if (!empty($vars['object']->targetURL)) {
        $targetURL = $vars['object']->targetURL;
    } else {
        $targetURL = $autosave->getValue('github', 'targetURL');
    }
    if (!empty($vars['object'])) {
        $object = $vars['object'];
    } else {
        $object = false;
    }

    /* @var \Idno\Core\Template $this */

?>
    <form action="<?= $vars['object']->getURL() ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 edit-pane">


                <?php

                    if (empty($vars['object']->_id)) {

                        ?>
                        <h4>New GitHub Interaction</h4>
                    <?php

                    } else {

                        ?>
                        <h4>Edit GitHub Interaction</h4>
                    <?php

                    }

                ?>

                <div class="content-form">

                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="If you are filing an issue, give it a title. Otherwise, skip it!" value="<?= htmlspecialchars($title) ?>" class="form-control"/>                    
                    
                    <label for="targetURL">Target URL (GitHub project or issue)</label>
                    <input type="text" name="targetURL" id="targetURL" placeholder="The URL for the GitHub project or issue." value="<?= $targetURL ?>" class="form-control"/>                    
                    
                </div>
                
                <label for="body">Content</label>
                <?= $this->__([
                    'name' => 'body',
                    'value' => $body,
                    'object' => $object,
                    'wordcount' => true
                ])->draw('forms/input/richtext')?>
                <?= $this->draw('entity/tags/input'); ?>

                <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('article'); ?>
                <?php if (empty($vars['object']->_id)) { ?><input type="hidden" name="forward-to" value="<?= \Idno\Core\site()->config()->getDisplayURL() . 'content/all/'; ?>" /><?php } ?>
                
                <?= $this->draw('content/access'); ?>

                <p class="button-bar ">
	                
                    <?= \Idno\Core\site()->actions()->signForm('/github/edit') ?>
                    <input type="button" class="btn btn-cancel" value="Cancel" onclick="tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'body'); hideContentCreateForm();"/>
                    <input type="submit" class="btn btn-primary" value="Publish"/>

                </p>

            </div>

        </div>
    </form>

    <div id="bodyautosave" style="display:none"></div>
<?= $this->draw('entity/edit/footer'); ?>
