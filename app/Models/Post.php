<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['name','comments'];

    public function getData(){
       return $this->latest()->paginate(5);
    }
    public function savePost($input){
        return $this->create($input);
    }
    public function getDataById($id){
        return $this->find($id);
    }
    public function updatePostData($input,$id){
        return $this->find($id)->update($input);
    }

    public function deleteComment($id){
        return $this->where('id', '=', $id)->delete();
    }
}
