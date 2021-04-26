<?php


namespace App\Http\Controllers;

use App\Traits\Validator;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use ApiResponser;
    use Validator;
}
