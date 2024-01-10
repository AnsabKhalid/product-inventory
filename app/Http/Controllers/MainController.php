<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Inventory;
use App\Models\Product;

class MainController extends Controller
{
    
    public function productList()
    {
        $products = Product::all();

        return view('product_list')->with('products', $products);
    }

    public function productForm() {
        return view('add_product');
    }

    public function addProducts(Request $request) {
        $this->validate($request, ['name' => 'required',
                                    'description' => 'required',
                                    'price' => 'required',
                                    'category' => 'required',
                                    'image' => 'image|nullable']);

        $randomNumbers = [];
        for ($i = 0; $i < 1; $i++) {
            $randomNumbers[] = mt_rand(1000, 9999);
        }

        if($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $request->file('image')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        if($request->category) {
            $sku_id = $request->category . '-' . implode($randomNumbers);
        }

        $product = new Product();
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sku_id = $sku_id;
        $product->color = $request->color;
        $product->image = $fileNameToStore;

        $product->save();

        return redirect('/')->with('status', 'The Product has been successfully Added..!!');
    }

    public function editProduct($id) {
        $product = Product::find($id);
        return view('update_product')->with('product', $product);
    }

    public function updateProduct(Request $request) {
        $this->validate($request, ['name' => 'required',
                                    'description' => 'required',
                                    'price' => 'required',
                                    'image' => 'image|nullable']);

        $product = Product::find($request->id);
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $request->file('image')->storeAs('public/image', $fileNameToStore);

            if($product->image != 'noimage.jpg') {
                Storage::delete('image/'.$product->image);
            }

            $product->image = $fileNameToStore;
        }

        $product->save();

        return redirect('/')->with('status', 'The Product has been successfully Updated..!!');
    }

    public function inventory($id) {
        $product = Product::find($id);

        $inventories = Inventory::all();
        return view('inventory')->with('product', $product)->with('inventories', $inventories);
    }

    public function addInventory(Request $request) {
        $this->validate($request, ['product_id' => 'required',
                                    'type' => 'required',
                                    'quantity' => 'required',
                                    'price' => 'required',
                                    'date' => 'required',]);

        $inventory = new Inventory();
        
        $inventory->product_id = $request->product_id;
        $inventory->type = $request->type;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->date = $request->date;

        $inventory->save();

        return back()->with('status', 'The Inventory has been successfully Added..!!');
    }
}
