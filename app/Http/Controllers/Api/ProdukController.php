<?php
namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    
    public function index()
    {
        //get all posts
        $posts = Produk::latest()->paginate(5);

        //return collection of posts as a resource
        return new ProdukResource(true, 'List Data Produk', $posts);
    }

    
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/produks', $image->hashName());

        //create post
        $post = Produk::create([
         'nama_produk' => $request->nama_produk,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'image' => $image->hashName(),
        ]);

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Ditambahkan!', $post);
    }

    
    public function show($id)
    {
        //find post by ID
        $post = Produk::find($id);

        //return single post as a resource
        return new ProdukResource(true, 'Detail Data Produk!', $post);
    }

    
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Produk::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/produks/', $image->hashName());

            //delete old image
            Storage::delete('public/produks/' . basename($post->image));

            //update post with new image
            $post->update([
                'nama_produk' => $request->nama_produk,
        'kategori' => $request->kategori,
        'harga' => $request->harga,
        'image' => $image->hashName(),
            ]);
        } else {

            //update post without image
            $post->update([
                'nama_produk'       => $request->nama_produk,
                'kategori'      => $request->kategori,
                'harga'=> $request->harga,
            ]);
        }

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Diubah!', $post);
    }

    
    public function destroy($id)
    {
        //find post by ID
        $post = Produk::find($id);

        //delete image
        Storage::delete('public/produks/' . basename($post->image));

        //delete post
        $post->delete();

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Dihapus!', null);
    }
}