<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertisementApplyRequest;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function apply(AdvertisementApplyRequest $request)
    {
        $request->user()->applications()->attach($request->advertisement_id);
        return response(['message' => 'Advertisement applied'], 201);
    }

    public function save(Request $request)
    {
        if (auth()->user()->advertisement_saved()->detach($request->advertisement_id)) {
            return response(['message' => 'Advertisement unsaved'], 200);
        }

        auth()->user()->advertisement_saved()->attach($request->advertisement_id);
        return response(['message' => 'Advertisement saved'], 201);
    }
}
