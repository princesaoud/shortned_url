<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});

Route::post('/', function(){

    $url = request('url');

    Validator::make(compact('url'), ['url' => 'required|url'])->validate();

    $response = App\urls::where('url',$url)->first();
    if($response){
      return view('result')->withShortened($response->shortened);
    }


    $row = App\urls::create([
      'url'=> $url,
      'shortened'=> App\urls::getUniqueUrl()
    ]);

    if($row){
      return view('result')->withShortened($row->shortened);
    }
    return view('result')->withShortened('Error encountered during the shortening process !!! try again please.');
});

Route::get('/{shortened}', function($shortened)
{
  $url = App\urls::whereShortened($shortened)->first();

  if(!$url){
    return redirect('/');
  }
  return redirect($url->url);
});
