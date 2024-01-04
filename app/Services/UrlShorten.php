<?php

namespace App\Services;

use App\Models\Url;

class UrlShorten{

    public function shorten($shorten){
        $currentUrl = request()->getHttpHost();
        $shortenUrl = $currentUrl . '/' . $shorten;

        $shorten = Url::where('short_url', $shortenUrl)->select('org_url', 'short_url')->first();
        return $shorten;
    }
}


?>