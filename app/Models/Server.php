<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    protected $table = 'tbl_server';
    public $appends = ['icon_url'];

    public function getIconUrlAttribute(){
        if($this->icon){
            return url('/').$this->icon;
        }else{
            return 'https://cdn-icons-png.flaticon.com/512/3086/3086890.png';
        }
    }
}
