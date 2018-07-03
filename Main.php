<?php

    namespace IdnoPlugins\GitHub {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/github/edit/?', '\IdnoPlugins\GitHub\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/github/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\GitHub\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/github/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\GitHub\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/github/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
            }

        }

    }
