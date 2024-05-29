<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(4);
        return view('products.index', ['products' => $products]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);

        //upload image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imageName;
        $res = $product->save();
        if ($res) {
            app(MailController::class)->index($request->name,$request->description);
            // $mailData = [
            //     'title' => $request->name,
            //     'body' => $request->description,
            // ];
            // Mail::to('hbdeveloper.43@gmail.com')->send(new DemoMail($mailData));
            return redirect('/')->withSuccess('create successfully');
        } else {
            return back()->withErrors('Not Added!!');
        }
    }
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('products/edit', ['product' => $product]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,svg|max:10000'
        ]);
        $product = Product::where('id', $id)->first();
        if (isset($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        return redirect('/')->withSuccess('Update successfully');
    }
    public function delete($id)
    {
        $prod = Product::where('id', $id)->first();
        $prod->delete();
        return redirect('/')->withSuccess('Deleted successfully');
    }

    public function show($id)
    {
        $prod = Product::where('id', $id)->first();
        return view('products.show', ['product' => $prod]);
    }
}