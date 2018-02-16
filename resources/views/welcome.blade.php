@extends('layouts/master')
        @section('content')
            <div class="content">
                <div class="title m-b-md">
                    URL SHORTENNER
                </div>

                <div class="links">
                    <form class="" method="post">
                      {{csrf_field() }}
                      <input type="text" name="url" placeholder="Enter your url here !!!" value="">
                      {!! $errors->first('url','<p> :message </p>') !!}
                      <input type="submit" name="" value="Shorten your url">
                    </form>
                </div>
            </div>
          @stop
