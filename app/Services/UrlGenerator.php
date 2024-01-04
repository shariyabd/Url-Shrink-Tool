<?php

namespace App\Services;

use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UrlGenerator
{
    public function store(array $data) : Url
    {

        // $timestamp = time();
        // $shortTimestamp = substr($timestamp, 0, 2);
        $randomString = Str::random(6);

        // $uniqueIdentifier = $shortTimestamp . $randomString;
        $uniqueIdentifier = $randomString;
        $currentUrl = request()->getHttpHost();

        // $shortenUrl = $request->url . $uniqueIdentifier;

        $shortenUrl = $currentUrl . '/' . $uniqueIdentifier;

        $url = Url::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
            ],
            [
                'user_id' => Auth::user()->id,
                'org_url' => $data['org_url'],
                'short_url' => $shortenUrl
            ]
        );

        return $url;
    }
}



?>