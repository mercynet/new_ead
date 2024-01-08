<?php

namespace App\Http\Controllers\API\V1\Mzrt;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mzrt\SettingStoreRequest;
use App\Http\Requests\Mzrt\SettingUpdateRequest;
use App\Http\Resources\Mzrt\SettingResource;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @group Mozart
 *
 * @subgroup Settings
 *
 * This class is responsible for handling the actions related to settings.
 */
class SettingController extends Controller
{
    public function __construct(public SettingService $settingService)
    {
        $this->authorizeResource($this->settingService->model);
    }

    /**
     * Retrieves a collection of settings.
     *
     * @param  Request  $request The HTTP request object.
     * @return AnonymousResourceCollection The collection of settings.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return SettingResource::collection($this->settingService->settings($request));
    }

    /**
     * Fetches and returns the resource representation of a specific Setting.
     *
     * @param  Setting  $setting The Setting object to fetch and display.
     * @return Response The HTTP response containing the resource representation of the Setting.
     */
    public function show(Setting $setting)
    {
        return response()->ok(SettingResource::make($this->settingService->setting($setting)));
    }

    public function store(SettingStoreRequest $request)
    {
        return response()->created($this->settingService->create($request->validated()));
    }

    public function update(SettingUpdateRequest $request, Setting $setting)
    {
        return response()->ok(SettingResource::make($this->settingService->update($setting, $request->validated())));
    }

    /**
     * Deletes a specific Setting.
     *
     * @param  Setting  $setting The Setting object to delete.
     * @return Response The HTTP response with no content.
     */
    public function destroy(Setting $setting)
    {
        $this->settingService->delete($setting);

        return response()->noContent();
    }
}
