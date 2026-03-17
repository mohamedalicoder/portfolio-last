<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('locale.switch');

Route::get('/', function () {
    $locale = Session::get('locale', 'en');
    App::setLocale($locale);
    return view('portfolio');
});
