<?php

namespace App\Repositories;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChannelRepository
{
    /**
     * All Channels List
     */
    public function all()
    {
        return Channel::all();
    }

    /**
     * Create New Channel
     * @param Request $request
     */
    public function create(Request $request): void
    {
        Channel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
    }

    /**
     * Update Channel With Id
     * @param Request $request
     */
    public function update(Request $request): void
    {
        Channel::find($request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
    }

    /**
     * Delete Channel With Id
     * @param Request $request
     */
    public function delete(Request $request): void
    {
        Channel::destroy($request->id);
    }
}