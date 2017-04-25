<?php

$embedded = '';

$testembed = '<div class=\'activity-stream activity-stream-headless h-entry\'>
<div class=\'entry entry-center\'>
<div class=\'detailed-status light\'>
<a class="detailed-status__display-name p-author h-card" rel="noopener" href="https://mastodon.social/@nxd4n"><div>
<div class=\'avatar\'>
<img width="48" height="48" alt="" class="u-photo" src="https://files.mastodon.social/accounts/avatars/000/027/955/original/64ff61f550bba6ad.jpeg?1491391555" />
</div>
</div>
<span class=\'display-name\'>
<strong class=\'p-name emojify\'>nxd4n</strong>
<span>@nxd4n</span>
</span>
</a><div class=\'status__content p-name emojify\'><div class=\'e-content\' style=\'display: block; direction: ltr\'><p>GitHub - danito/KnownEmbedMastodon: Convert mastodon status URLs into quoted toots: <a href="https://github.com/danito/KnownEmbedMastodon" rel="nofollow noopener" target="_blank"><span class="invisible">https://</span><span class="ellipsis">github.com/danito/KnownEmbedMa</span><span class="invisible">stodon</span></a></p></div></div>
<div class=\'detailed-status__meta\'>
<data class=\'dt-published\' value=\'2017-04-20T12:28:57+00:00\'></data>
<a class="detailed-status__datetime u-url u-uid" rel="noopener" href="https://mastodon.social/@nxd4n/3391735"><span>Apr 20, 2017, 12:28</span>
</a>·
<a class="detailed-status__application" target="_blank" rel="noopener" href="https://nxd4n.nixekinder.be/">nxd4n&#39;s Known</a>
·
<span><i class="fa fa-retweet"></i><span>0</span></span>
·
<span><i class="fa fa-star"></i><span>0</span></span>
·
<a class="open-in-web-link" target="_blank" href="https://mastodon.social/web/statuses/3391735">Open in web</a>
</div>
</div>

</div>


</div>';

$body = Idno\Core\site()->triggerEvent('url/expandintext', ['object' => $vars['object']], $vars['object']->body);
if (preg_match_all('/https?:\/\/[^\s]+\/users\/[^\s]+\/updates\/[^\s]+/i', $body, $matches)) {
    foreach ($matches[0] as $m) {
        $url = parse_url($m);
        $serverAPI = $url['scheme'].'://'.$url['host'].'/api/oembed.json?url='.$param = urlencode($m);
        
        $res = \Idno\Core\Webservice::get($serverAPI);
        $content = json_decode($res['content']);
        \Idno\Core\Idno::site()->logging()->log("GET CONTENT: " . var_export($content, true));
              
        if (!empty($content)) {
            $html = $content->html;
            $embedded .= $html;
        }
        //$embedded .= '<iframe src="' . $m . '/embed" style="overflow: hidden" frameborder="0" height="300"  width="600" scrolling="yes" onload="this.height=this.contentWindow.document.body.scrollHeight;"></iframe>';
        //$embedded .= $embedded .= '<script src="' . $m . '.js"></script>';;
    }
}
//https://mastodon.social/@nxd4n/3391735
if (preg_match_all('/https?:\/\/[^\s]+\/@[^\s]+\/[^\s]+/i', $body, $matches)) {
    foreach ($matches[0] as $m) {
       $url = parse_url($m);
        $serverAPI = $url['scheme'].'://'.$url['host'].'/api/oembed.json?url='.$param = urlencode($m);
        
        $res = \Idno\Core\Webservice::get($serverAPI);
        $content = json_decode($res['content']);
        \Idno\Core\Idno::site()->logging()->log("GET CONTENT: " . var_export($content, true));
              
        if (!empty($content)) {
            $html = $content->html;
            $embedded .= $html;
        }
        //$embedded .= $embedded .= '<script src="' . $m . '.js"></script>';;
    }
}

echo $embedded;
