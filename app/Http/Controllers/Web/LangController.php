<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class LangController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke($lang)
	{
		session(['lang' => $lang]);

		return redirect()->back();
	}
}
