<?php

$embedded = '';

$body = Idno\Core\site()->triggerEvent('url/expandintext', ['object' => $vars['object']], $vars['object']->body);
if (preg_match_all('/https?:\/\/[^\s]+\/users\/[^\s]+\/updates\/[^\s]+/i', $body, $matches)) {
    foreach ($matches[0] as $m) {
        $embedded .= '<iframe src="' . $m . '/embed" style="overflow: hidden" frameborder="0" height="300"  width="600" scrolling="yes" onload="this.height=this.contentWindow.document.body.scrollHeight;"></iframe>';
    }
}

echo $embedded;
