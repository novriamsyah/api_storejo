<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function all(Request $request)
    {
        //filter
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        //filter id
        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);

            if ($category) {
                return ResponseFormatter::success(
                    $category,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }

        $category = ProductCategory::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%');
        }
        if ($show_product) {
            $category->with('products');
        }
        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data list kategori produk berhasil diambil'

        );
    }
}
