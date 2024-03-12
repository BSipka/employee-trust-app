<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementApplyRequest;
use App\Http\Requests\AdvertisementSaveRequest;


class AdvertisementController extends Controller
{
    
    /**
     * Handle the incoming request.
     */
    public function apply(AdvertisementApplyRequest $request)
    {
        $ad_id = $request->validated()['advertisement_id'];

        auth()->user()->applications()->attach($ad_id);
        return response(['message' => 'Advertisement applied'], 201);
    }

    public function save(AdvertisementSaveRequest $request)
    {
        $ad_id = $request->validated()['advertisement_id'];

        if (auth()->user()->advertisement_saved()->detach($ad_id)) {
            return response(['message' => 'Advertisement unsaved'], 200);
        }

        auth()->user()->advertisement_saved()->attach($ad_id);
        return response(['message' => 'Advertisement saved'], 201);
    }
}
