<?php

namespace App\Http\Controllers;

use App\Services\UrlShorten;
use App\Trait\ResponseTrait;
use App\Services\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UrlGenerateRequest;

class UrlGenerateController extends Controller
{
    use ResponseTrait;
    public function shorten($shorten, UrlShorten $urlShorten)
    {
        $url = $urlShorten->shorten($shorten);
        if (!$url) {
            return view('backend.error');
        } else {
            return redirect($url->org_url);
        }
    }

    public function store(UrlGenerateRequest $request, UrlGenerator $urlGenerator)
    {
        $validatedData = $request->validated();
        $url = $urlGenerator->store($validatedData);
        if ($url) {
            return $this->successResponse('Url generated successfully.', [
                'short_url' => $url->short_url,
                
            ]);
        } else {
            return $this->errorResponse('Failed to generate URL.');
        }
    }
}
