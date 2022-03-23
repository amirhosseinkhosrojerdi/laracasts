<?php

namespace App\Http\Controllers\API\V01\Channel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Repositories\ChannelRepository;
use Symfony\Component\HttpFoundation\Response;

class ChannelController extends Controller
{
    /**
     * Get All Channel
     * @method GET
     * @return JsonResponse
     */
    public function getAllChannelsList()
    {
        $all_channels = resolve(ChannelRepository::class)->all();
        return response()->json($all_channels, Response::HTTP_OK);
    }

    /**
     * Create New Channel
     * @method POST
     * @param Request $request
     * @return JsonResponse
     */
    public function createNewChannel(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'name' => ['required']
        ]);

        // Insert Channel To Database
        resolve(ChannelRepository::class)->create($request);

        return response()->json([
            'message' => "channel created successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * Update New Channel
     * @method PUT
     * @param Request $request
     * @return JsonResponse
     */
    public function updateChannel(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'name' => ['required']
        ]);
        
        // Update Channel In Database
        resolve(ChannelRepository::class)->update($request);

        return response()->json([
            'message' => "channel edited successfully"
        ], Response::HTTP_OK);
    }

    /**
     * Delete Channel(s)
     * @method DELETE
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteChannel(Request $request)
    {
        // Validate Form Inputs
        $request->validate([
            'id' => ['required']
        ]);

        // Delete Channel In Database
        resolve(ChannelRepository::class)->delete($request);

        return response()->json([
            'message' => "channel deleted successfully"
        ], Response::HTTP_OK);
    }
}
