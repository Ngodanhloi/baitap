<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách tất cả sản phẩm.
     */
    public function index()
    {
        // Lấy tất cả sản phẩm từ bảng 'products'
        $products = Product::all();

        // Trả về view hoặc dữ liệu dưới dạng JSON
        return view('products.index', compact('products'));  // Ví dụ trả về view
    }

    /**
     * Hiển thị form để tạo sản phẩm mới.
     */
    public function create()
    {
        return view('products.create');  // Trả về view tạo sản phẩm
    }

    /**
     * Lưu sản phẩm mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Kiểm tra và validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);

        // Lưu sản phẩm vào cơ sở dữ liệu
        Product::create($request->all());

        // Chuyển hướng về danh sách sản phẩm
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));  // Trả về view chỉnh sửa sản phẩm
    }

    /**
     * Cập nhật thông tin sản phẩm.
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra và validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
        ]);

        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Cập nhật sản phẩm
        $product->update($request->all());

        // Chuyển hướng về danh sách sản phẩm
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     */
    public function destroy($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Xóa sản phẩm
        $product->delete();

        // Chuyển hướng về danh sách sản phẩm
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm theo id
        return view('products.show', compact('product'));
    }
}
