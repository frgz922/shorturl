<?php

namespace App\Http\Controllers\API;

use App\Helpers\Helper as Helper;
use App\Urls;
use App\UrlsAliases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ShortUrlController extends Controller
{
    /**
     * Display a listing of the Top 100 of most visited sites.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top100 = Urls::orderBy('visit_count', 'desc')
            ->with('alias')
            ->limit(100)
            ->get();

        return $top100;
    }

    /**
     * Stores a shorter URL given a site URL.
     * Returns the created URL.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = Validator::make(
            $request->all(),
            [
                'url' => 'required|string',
                'nsfw' => 'boolean'
            ]
        );

        if ($rules->fails()) {
            return response()->json([
                "status" => "error",
                "msg" => $rules->errors(),
            ], 404);
        }

        $url_path = $request->get('url');
        $nsfw = $request->get('nsfw');

        $title = Helper::getTitle($url_path);

        $url = new Urls();
        $url->fill($request->all($url->getFillable()));
        $url->nsfw = $nsfw ? $nsfw : 0;
        $url->title = $title;

        $url->save();

        $alias = base_convert(crc32($url->id), 10, 36);

        $url_alias = new UrlsAliases();
        $url_alias->url_id = $url->id;
        $url_alias->alias = $alias;
        $url_alias->shortened_url = url('/' . $alias);

        $url_alias->save();

        return response()->json([
            "status" => "success",
            "msg" => 'URL successfully shortened.',
            "generated_url" => $url_alias->shortened_url
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
