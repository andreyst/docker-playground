<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/hello', function()
{
  throw new Exception();
  return 'Hello everybody!';
});

Route::get('users', function()
{
    $users = User::all();

    return View::make('users')->with('users', $users);
});

Route::get('samplelog', function()
{
    $sampleLog = SampleLog::all();

    return View::make('sampleLog')->with('sampleLog', $sampleLog);
});
