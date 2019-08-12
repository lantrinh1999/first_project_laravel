<?php

namespace App\Http\Controllers;

use App\Models\Category;
use DataTables;

class CategoryController extends Controller
{
    protected $_data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('category.list');
    }

    public function listCategries()
    {
        $c = $this->categoriesList(Category::all());

        return DataTables::of($c)->make(true);
    }

    public function categoriesList($categories, $parent_id = 0, $step = 0)
    {
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $parent = Category::find($parent_id);
                $parent_name = $parent['name'];
                $c = $item;
                $c['parent_name'] = $parent_name;
                $c['step'] = $step;
                $this->_data['categoriesDataTable'][] = $c;
                unset($categories[$key]);
                $this->categoriesList($categories, $item['id'], $step + 1);
            }
        }

        return $this->_data['categoriesDataTable'];
    }
}
