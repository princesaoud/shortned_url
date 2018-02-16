<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\urls;

class UrlsController extends Controller
{
    public function create()
    {
      return view('welcome');
    }

    public function store(Request $request){

          $this->validate($request, ['url' => 'required|url'] );
          $record = $this->getRecordForUrl($request->get('url'));
          return view('result')->withShortened($record->shortened);

    }

    public function show($shortened)
    {
      $url = \App\urls::whereShortened($shortened)->firstOrFail();

      return redirect($url->url);
    }

    private function getRecordForUrl($url)
    {
      return urls::firstOrCreate([
        'url'=>$url],
        ['shortened'=>urls::getUniqueUrl()
      ]);
    }
}
