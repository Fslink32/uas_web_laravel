<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

#[\AllowDynamicProperties]

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // private static $instance;
    // public function __construct()
	// {
	// 	self::$instance =& $this;
	// }
}
