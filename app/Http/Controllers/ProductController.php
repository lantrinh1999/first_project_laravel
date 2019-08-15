<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\CommentRequest;
use DataTables;

class ProductController extends Controller
{
    protected $_data;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product.list');
    }

    public function productsList()
    {
        $products = Product::all()->load('categories');

        foreach ($products as $key => $value) {
            $str = '';
            if (!empty($value['categories']) && count($value['categories']) > 0) {
                foreach ($value['categories'] as $k => $item) {
                    $str .= ', '.$item['name'];
                }
                $products[$key]['listcategories'] = trim($str, ', ');
            } else {
                $products[$key]['listcategories'] = 'null';
            }
        }
        $pro = $products;

        return DataTables::of($pro)->make(true);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $check = $product->delete();
        $product->categories()->attach();
        if ($check) {
            return redirect()->route('admin.product.list')
                        ->with('success', 'Xoá thành công sản phẩm');
        } else {
            return redirect()->route('admin.product.list')
                        ->with('error', 'Xoá KHÔNG thành công sản phẩm');
        }
    }

    // thêm mới sản phẩm
    public function add()
    {
        $this->_data['categories'] = $this->categoriesList(Category::all());

        return view('product.add', $this->_data);
    }

    public function saveAdd(ProductRequest $request)
    {
        if (!empty($request)) {
            $data = $request->except('_token');
        }
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->image = $data['image'];
        $product->status = $data['status'];
        $product->save();
        $id = $product->id;
        Product::find($id)->categories()->sync($request->category_id);

        return redirect()->route('admin.product.list')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Sửa sản phẩm

    public function edit($id)
    {
        $product = Product::find($id);
        // dd($product);
        if (empty($product)) {
            return redirect()->route('admin.product.list');
        }
        $this->_data['categories'] = $this->categoriesList(Category::all());
        $product = $product->load('categories')->toArray();
        $category_id = [];
        if (count($product['categories']) > 0) {
            foreach ($product['categories'] as $key => $value) {
                $category_id[] = $value['id'];
            }
        }
        // dd($category_id);
        $product['category_id'] = $category_id;
        $this->_data['product'] = $product;

        return view('product.add', $this->_data);
    }

    public function saveEdit(ProductRequest $request)
    {
        if (!empty($request)) {
            $data = $request->except('_token');
        }
        // dd($data);
        $product = Product::find($data['id']);
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->image = $data['image'];
        $product->status = $data['status'];
        $product->save();
        Product::find($data['id'])->categories()->sync($request->category_id);

        return redirect()->route('admin.product.list')->with('success', 'Sửa sản phẩm thành công!');
    }

    public function detail($id)
    {
        $product = Product::find($id);
        // dd($product);
        if (empty($product)) {
            return redirect()->route('admin.product.list');
        }
        $this->_data['categories'] = $this->categoriesList(Category::all());
        // $product = $product->load('comments')->toArray();
        $comments = DB::table('products')
        ->select('comments.product_id', 'comments.user_id', 'comments.id as comment_id', 'users.name', 'comments.content', 'comments.created_at')
        ->join('comments', 'products.id', '=', 'comments.product_id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('products.id', $id)->get();

        $this->_data['product'] = $product;
        $this->_data['comments'] = $comments;

        return view('product.detail', $this->_data);
    }

    public function postComment(CommentRequest $request)
    {
        // dd('aaaaaaa');
        $user = Auth::user();
        $user_id = $user->id;
        $content = $request->content;
        $id = $request->id;
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->product_id = $id;
        $comment->content = $content;
        $comment->save();

        return redirect()->route('admin.product.detail', $id);
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
