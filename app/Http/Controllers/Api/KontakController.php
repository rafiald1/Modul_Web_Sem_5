<?php

namespace App\Http\Controllers\Api;

//import model Post
use App\Models\Kontak;

use Illuminate\Http\Request;

//import resource PostResource
use App\Http\Controllers\Controller;

//import Http request
use App\Http\Resources\KontakResource;

//import facade Validator
use Illuminate\Support\Facades\Validator;

//import facade Storage
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $kontak = Kontak::latest()->paginate(5);

        //return collection of produk as a resource
        return new KontakResource(true, 'List Data Kontak', $kontak);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'pesan' => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

    

        //create post
        $kontak = Kontak::create([
           'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->pesan,
           
        ]);

        //return response
        return new KontakResource(true, 'Data Kontak Berhasil Ditambahkan!', $kontak);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $kontak = Kontak::find($id);

        //return single post as a resource
        return new KontakResource(true, 'Detail Data Kontak!', $kontak);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'pesan' => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $kontak = Kontak::find($id);

        //check if image is not empty

            //update post with new image
            $kontak->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'pesan' => $request->pesan,
            ]);

        //return response
        return new KontakResource(true, 'Data Kontak Berhasil Diubah!', $kontak);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $kontak = Kontak::find($id);

        //delete image

        //delete post
        $kontak->delete();

        //return response
        return new KontakResource(true, 'Data Kontak Berhasil Dihapus!', null);
    }
}