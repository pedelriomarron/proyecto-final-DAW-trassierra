<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ImageGallery;
use \File;


class ImageGalleryController extends Controller
{


    /**
     * Listing Of images gallery
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = ImageGallery::orderBy('order')->get();
        return view('image-gallery', compact('images'));
    }


    /**
     * Upload image function
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'image.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $key => $file) {
                $name = $key . '-' . time() . '.' . $file->extension();
                $file->move(public_path('uploads/gallery'), $name);
                $data[] = $name;
            }
        }

        // $input['image'] = time() . '.' . $request->image->getClientOriginalExtension();
        // $request->image->move(public_path('uploads/gallery'), $input['image']);

        foreach ($data as $key => $img) {
            ImageGallery::create([
                'title' => $request->title,
                'image' => $img,
                //     'order' => 1,
                'car_id' => 1
            ]);
        }
        //$input['title'] = $request->title;
        //ImageGallery::create($input);
        // $file = new File();
        //$file->filenames = json_encode($data);
        //dd($data);
        // $file->save();


        return back()
            ->with('success', 'Image Uploaded successfully.');
    }


    /**
     * Remove Image function
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImageGallery::find($id)->delete();
        return back()
            ->with('success', 'Image removed successfully.');
    }


    public function order(Request $request)
    {
        $order = json_decode($request->order);
        foreach ($order as $or => $key) {
            ImageGallery::where('id', $key)
                ->update(['order' => $or]);
        }
        return back()
            ->with('success', 'Update Order successfully.');
    }
}
