<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use App\Models\Product;
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

    public function add()
    {
        $categories = $this->categoriesList(Category::all());
        $this->_data['categories'] = $categories;

        return view('category.add', $this->_data);
    }

    public function saveAdd(CategoryRequest $request)
    {
        // $parent_id = $request->parent_id;
        $data = $request->except('_token');
        // dd($data);
        $check = Category::insert($data);
        if ($check) {
            return redirect()->route('admin.category.list')->with('success', 'Thêm sản phẩm thành công!');
        } else {
            return redirect()->route('admin.category.list')->with('error', 'Thêm sản phẩm no thành công!');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        // dd($product);
        if (empty($category)) {
            return redirect()->route('admin.category.list');
        }

        $this->_data['categories'] = $this->categoriesList(Category::all());
        // dd($this->_data['categories']);
        $this->_data['category'] = $category;

        return view('category.add', $this->_data);
    }

    public function saveEdit(EditCategoryRequest $request)
    {
        if (!empty($request)) {
            $data = $request->except('_token');
        }
        $category = Category::find($request->id);
        // dd($data);
        // Product::find($data['id'])->categories()->sync($request->category_id);
        $check = $category->update($data);

        return redirect()->route('admin.category.list')->with('success', 'Sửa danh mục thành công!');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $check = $category->delete();
        $category->products()->detach();
        if ($check) {
            return redirect()->route('admin.category.list')
                        ->with('success', 'Xoá thành công sản phẩm');
        } else {
            return redirect()->route('admin.category.list')
                        ->with('error', 'Xoá KHÔNG thành công sản phẩm');
        }
    }
}
