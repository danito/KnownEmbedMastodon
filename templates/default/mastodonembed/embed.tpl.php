<?php

$embedded = '';

$body = Idno\Core\site()->triggerEvent('url/expandintext', ['object' => $vars['object']], $vars['object']->body);

/**
 * https://INST.ANCE/users/*USER/updates/$ID
 */
if (preg_match_all('/https?:\/\/[^\s]+\/users\/[^\s]+\/updates\/[^\s]+/i', $body, $matches)) {
    foreach ($matches[0] as $m) {

        if ($html = \IdnoPlugins\MastodonEmbed\Main::getApiFromDom($m)) {
            $embedded .= $html;
        }
    }
}
//https://mastodon.social/@nxd4n/3391735
if (preg_match_all('/https?:\/\/[^\s]+\/@[^\s]+\/[^\s]+/i', $body, $matches)) {
    foreach ($matches[0] as $m) {
        
        if ($html = \IdnoPlugins\MastodonEmbed\Main::getApiFromDom($m)) {
            $embedded .= $html;
        }
       
    }
}



echo $embedded;
