<?php
    namespace IdnoPlugins\MastodonEmbed {
        class Main extends \Idno\Common\Plugin {
            function registerPages() {                
                \Idno\Core\site()->template()->extendTemplate('entity/content/embed','mastodonembed/embed');
                \Idno\Core\site()->template()->extendTemplate('shell/head', 'mastodonembed/shell/head');
            }
        }
    }