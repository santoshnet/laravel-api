<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Blog;
use App\Http\Resources\Blog as BlogResource;
use Validator;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $blogs = Blog::paginate(15);
        return BlogResource::collection($blogs)
        ->response()
        ->setStatusCode(200);
        
       
       
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

       

        $blog = new Blog(input::all());
        if(auth()->user()->blogs()->save($blog))
        {
           return new BlogResource($blog);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
         return new BlogResource($blog);
             
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


      $blog = auth()->user()->blogs()->findOrFail($id);

        $input = $request->all();
        $validator = Validator::make($input, [

            'title' => 'required',

            'body' => 'required'

        ]);

 
        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'blog with id ' . $id . ' not found'
            ], 400);
        }
    
        if ( $blog->fill($input)->save())
           return new BlogResource($blog);
        else
            return response()->json([
                'success' => false,
                'message' => 'blog could not be updated'
            ], 500);

        // $blog = auth()->user()->blogs()->find($id);
        // //$blog->update(Input::all());

        // if($blog->fill($request->all())->save())
        // {
        //     return new BlogResource($blog);
        // }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = auth()->user()->blogs()->find($id);
 
        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'blog with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($blog->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'blog could not be deleted'
            ], 500);
        }
    }
}
