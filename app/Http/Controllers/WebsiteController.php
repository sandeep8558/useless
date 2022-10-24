<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductGroup;
use App\Models\Product;
use App\Models\ServingArea;
use App\Models\User;
use App\Models\Setting;
use DB;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function welcome(){
        return redirect("/home");
    }

}
