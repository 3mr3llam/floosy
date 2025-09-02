<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\MetaResource;
use App\Http\Resources\SettingsResource;
use App\Models\City;
use App\Models\Country;
use App\Models\Currancy;
use App\Models\SiteSetting;
use App\Models\SiteSocail;
use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneralController extends Controller
{

    public function socialMedia(): JsonResponse
    {
        $settings = SiteSetting::first();

        $settings = SiteSetting::first();
        if (!$settings) {
            return response()->json([
                'status' => 'success',
                'message' => 'Meta is empty',
                'data' => [],
            ], Response::HTTP_OK);
        }

        $socialMedia = [
            'whatsapp' => $settings->whatsapp,
            'facebook' => $settings->facebook,
            'instagram' => $settings->instagram,
            'tiktok' => $settings->tiktok,
            'snapchat' => $settings->snapchat,
            'twitter' => $settings->twitter,
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Related social retrieved successfully',
            'data' => $socialMedia,
        ], Response::HTTP_OK);
    }

    public function siteSetting(): JsonResponse
    {
        $siteSetting = SiteSetting::first();
        if (!$siteSetting) {
            return response()->json([
                'status' => 'success',
                'message' => 'Meta is empty',
                'data' => [],
            ], Response::HTTP_OK);
        }
        $siteSetting = SettingsResource::make($siteSetting);
        return response()->json([
            'message' => ' data retrieved successfully',
            'status' => 'success',
            'data' => $siteSetting,
        ], Response::HTTP_OK);
    }


    public function getCountries()
    {
        $countires = Country::with('cities')->get();

        if (!$countires) {
            return response()->json([
                'status' => 'error',
                'message' => 'not country found',
                'data' => [],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => ' data retrieved successfully',
            'status' => 'success',
            'data' => CountryResource::collection($countires),
        ], Response::HTTP_OK);
    }

    public function getCities()
    {
        $cities = City::all();

        if (!$cities) {
            return response()->json([
                'status' => 'error',
                'message' => 'not city found',
                'data' => [],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => ' data retrieved successfully',
            'status' => 'success',
            'data' => CityResource::collection($cities),
        ], Response::HTTP_OK);
    }

    public function getCitiesByCountryId($id)
    {
        $cities = City::where('country_id', $id)->get();

        if (!$cities) {
            return response()->json([
                'status' => 'error',
                'message' => 'not city found',
                'data' => [],
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => ' data retrieved successfully',
            'status' => 'success',
            'data' => CityResource::collection($cities),
        ], Response::HTTP_OK);
    }

}
