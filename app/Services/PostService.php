<?php
namespace App\Services;
use App\Models\Post;
use Carbon\Carbon;
use DB;


class PostService{
    public function __construct(Post $post){
        $this->post = $post;
    }
    public function getData(){
       return $this->post->getData();
    }
    public function savePost($data){
        try {

            $response =[
                'success' => 0,
                'data'  => "fail",
                'status' => 404,
            ];
            DB::beginTransaction();
            $result = [
                'name' => $data['name'],
                'comments' => $data['comment'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            $dataInsert =  $this->post->savePost($result);
            if($dataInsert){
                DB::commit();
                $response =[
                    'success' => 1,
                    'data'   => "Post data is stored successfully",
                    'status' => 200,
                ];
            }else{
                DB::rollback();
                 
            }
            
        } catch (Exception $e) {
            DB::rollback();
            $response['data'] = $e->getMessage();
        }finally{
            return $response;
        }
        
      
       
    }

    public function getDataById($id){
        return $this->post->getDataById($id);
    }
    public function updatePostData($input,$id){
        // try{
        //     $response = [

        //     ]

        // }catch(){

        // }finally{

        // }
        $updateData = [
            'name' => $input['name'],
            'comments' => $input['comment'],
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        return $this->post->updatePostData($updateData,$id);
    }
    public function deleteComment($id){
        return $this->post->deleteComment($id);
    }

}