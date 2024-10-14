<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(PostService $postservice){
        $this->postservice = $postservice;

    }
     public function index()
    {
        $posts = $this->postservice->getData();
        //return  response()->json($posts,200);
        return view('posts.index',compact('posts'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validationData = $request->validate([
            'name' => 'required|regex:/[a-zA-Z0-9\s]+/',
            'comment' => 'required|regex:/[a-zA-Z0-9\s]+/',
        ]);
        $result = $this->postservice->savePost($validationData);
       //return  response()->json($result,200);
        if($result['success']){
            return redirect()->route('posts.index')->with('message', $result['data'])->with('class','alert alert-success');
            
        }else{
            return redirect()->back()->withInput()->with('message',$result['data'])->with('class','alert alert-danger');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->postservice->getDataById($id);
        return view('posts.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = $this->postservice->getDataById($id);
        return view('posts.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    
        $input = $request->all();
        $validatePostData = $request->validate([
            'name' => 'required',
            'comments' => 'required',
        ]);
        $result=  $this->postservice->updatePostData($validatePostData,$id);
        return redirect('posts')->with('class','alert alert-success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->postservice->deleteComment($id);  
        return redirect()->route('posts.index')->with('success','Product deleted successfully');
    }
}
