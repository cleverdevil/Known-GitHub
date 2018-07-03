<?php

    namespace IdnoPlugins\GitHub {

        class ContentType extends \Idno\Common\ContentType {

            public $title = 'GitHub';
            public $category_title = 'GitHub';
            public $entity_class = 'IdnoPlugins\\GitHub\\GitHub';
            public $logo = '<i class="fab fa-github"></i>';
            public $indieWebContentType = array('article', 'github');

        }

    }
