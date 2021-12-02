<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Barang::where('id', Auth::id())->paginate(10);
        $response['product'] = $product;
        return $this->sendResponse($response, 'Get Products Successfully', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'nama_produk' => 'required',
            'path_gambar' => 'required|max:2000',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'barcode' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 401);
        }

        $product = new Barang;
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->nama_produk = $request->nama_produk;
        $product->harga_beli = $request->harga_beli;
        $product->harga_jual = $request->harga_jual;
        $product->stok = $request->stok;
        $product->barcode = $request->barcode;

        $getImage = $request->path_gambar;
        $imageName = time() . '.' . $getImage->extension();
        $imagePath = public_path() . '/images/product';
        $product->path_gambar = $imageName;
        $getImage->move($imagePath, $imageName);
        $product->save();

        $result['product'] = Barang::where('id', $product->id)->first();
        return $this->sendResponse($result, 'Get Products Successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result['product'] = Barang::where('id', $id)->first();
        return $this->sendResponse($result, 'Get Products Successfully', 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $product = Barang::find($id);
        $getImage = $request->path_gambar;
        $imageName = '';
        if ($getImage) {
            // $imageName = time().'.'.$getImage->extension();
            // $imagePath = public_path(). '/images/product';
            if (Storage::exists('public/images/product/1638194836.jpg')) {
                // Storage::delete('image/product/'.$product->path_gambar);
                $imageName = 'asdasdasddasd';
            }
            // $product['path_gambar'] = $imageName;
            // $getImage->move($imagePath, $imageName);
        }
        https://github.com/shafwansyah/dev_kasir.git
        // $product->fill($input)->save();
        $result['product'] = Barang::where('id', $id)->first();
        return $this->sendResponse($imageName, 'Get Products Successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
