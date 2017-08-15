<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
   public function errorPage()
   {
   	return view('pages.error.not-found');
   }
}
