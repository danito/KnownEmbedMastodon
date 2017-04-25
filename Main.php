<?php

namespace IdnoPlugins\MastodonEmbed {

    /**
     * 
     * @param string $url
     * @return string $content
     */
    class Main extends \Idno\Common\Plugin {

        function registerPages() {
            \Idno\Core\site()->template()->extendTemplate('entity/content/embed', 'mastodonembed/embed');
        }

         function getApi($toot) {
            if ($url = parse_url($toot)) {
                $res = \Idno\Core\Webservice::get($toot);
                $content = json_decode($res['content']);
 
                if (!empty($content)) {
                    return $content->html;
                }
            }
            return false;
        }

        static function getApiFromDom($toot) {
            // \Idno\Core\Idno::site()->logging()->log("DEBUG TOOT " . var_export($toot, true));

            if ($res = \Idno\Core\Webservice::get($toot)) {
                $html = ($res['content']);
                $dom = @\DOMDocument::loadHTML($html);
                
                $attributes = array();
                foreach ($dom->getElementsByTagName('link') as $link) {
                   
                    $href = $link->getAttribute('href');
                    $type = $link->getAttribute('type');
                    
                    if ($type == 'application/json+oembed') {
                        return self::getApi($href);
                    }
                }
            }
            return false;
        }

    }

}