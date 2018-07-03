<?php

    namespace IdnoPlugins\GitHub {

        use Idno\Core\Autosave;

        class GitHub extends \Idno\Common\Entity
        {

            function getTitle()
            {
                if (empty($this->title)) return '';

                return $this->title;
            }

            function getDescription()
            {
                if (!empty($this->body)) return $this->body;

                return '';
            }

            function getTargetURL()
            {
                if (!empty($this->targetURL)) return $this->targetURL;

                return '';
            }

            function getURL()
            {

                // If we have a URL override, use it
                if (!empty($this->url)) {
                    return $this->url;
                }

                if (!empty($this->canonical)) {
                    return $this->canonical;
                }

                if (!$this->getSlug() && ($this->getID())) {
                    return \Idno\Core\site()->config()->url . 'github/' . $this->getID() . '/' . $this->getPrettyURLTitle();
                } else {
                    return parent::getURL();
                }

            }

            /**
             * GitHub objects have type 'article'
             * @return 'article'
             */
            function getActivityStreamsObjectType()
            {
                return 'article';
            }

            function saveDataFromInput()
            {

                if (empty($this->_id)) {
                    $new = true;
                } else {
                    $new = false;
                }
                $body = \Idno\Core\site()->currentPage()->getInput('body');
                if (!empty($body)) {

                    $this->body            = $body . ' <a href="https://brid.gy/publish/github"></a>';
                    $this->title           = \Idno\Core\site()->currentPage()->getInput('title');
                    $this->targetURL       = \Idno\Core\site()->currentPage()->getInput('targetURL');
                    $access                = \Idno\Core\site()->currentPage()->getInput('access');
                    $this->setAccess($access);

                    if ($time = \Idno\Core\site()->currentPage()->getInput('created')) {
                        if ($time = strtotime($time)) {
                            $this->created = $time;
                        }
                    }
    
                    if ($this->save($new)) {

                        $autosave = new Autosave();
                        $autosave->clearContext('github');

                        \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getTitle() . ' ' . $this->getDescription()));

                        return true;
                    }
                } else {
                    \Idno\Core\site()->session()->addErrorMessage('You can\'t save an empty entry.');
                }

                return false;
            }

            function deleteData()
            {
                \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getTitle() . ' ' . $this->getDescription()));
            }

        }

    }
