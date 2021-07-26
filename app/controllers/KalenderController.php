<?php

class KalenderController extends BaseController {

	public function getIndex()
	{
		return View::make('kalender.index');
	}

}
