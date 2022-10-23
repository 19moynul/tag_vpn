<?php


namespace App\Models;

use App\Enums\Constant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $table = 'tbl_admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    use Notifiable;
    public $userTypes = ['ADMIN', 'USER'];
    protected $appends = ['fullName'];
    public $statuses = ['INACTIVE', 'ACTIVE'];
    public $title = 'LIST OF ALL USER';


    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $guarded = [
    //     'confirm_password'
    // ];

    // public $table = 'tbl_users';

    // /**
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // public function scopeFilter($query)
    // {
    //     $first_name = request('first_name');
    //     $last_name = request('last_name');
    //     $phone = request('phone');
    //     $search = request('search');
    //     $email = request('email');
    //     $status = request('status');
    //     $user_type = request('user_type');
    //     $deleted_at = request('deleted_at');


    //     if ($first_name) {
    //         $query->where('first_name', 'LIKE', '%' . $first_name . '%');
    //     }

    //     if ($last_name) {
    //         $query->where('last_name', 'LIKE', '%' . $last_name . '%');
    //     }

    //     if ($phone) {
    //         $query->where('phone', 'LIKE', '%' . $phone . '%');
    //     }

    //     if ($email) {
    //         $query->where('email', 'LIKE', '%' . $email . '%');
    //     }

    //     if ($search) {
    //         $query->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%" . $search . "%");
    //         $query->orwhere('phone', 'LIKE', '%' . $search . '%');
    //     }
    //     if ($user_type) {
    //         $query->where('user_type', $user_type);
    //     }
    //     if ($status > -1) {
    //         $query->where('status', $status);
    //     }
    //     if ($deleted_at) {
    //         $query->whereNotNull('deleted_at');
    //     } else {
    //         $query->whereNull('deleted_at');
    //     }
    // }


    // public function setTitle()
    // {
    //     $user_type = request('user_type');
    //     $deleted_at = request('deleted_at');

    //     if ($deleted_at) {
    //         $this->title = 'LIST OF ALL DELETED USERS';
    //     }
    //     if ($user_type == Constant::ADMIN) {
    //         $this->title = 'LIST OF ALL ADMIN';
    //     }
    //     if ($user_type == Constant::USER) {
    //         $this->title = 'LIST OF ALL USER';
    //     }
    // }

    // public function getfullNameAttribute()
    // {
    //     $fullname = $this->first_name . ' ' . $this->last_name;
    //     return $fullname;
    // }


    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public static function login($request)
    {
    
        $user = User::where('email', $request->email)->first();
       
        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                
                if ($user->status == 1) {
                    Auth::login($user);
                    return ["success" => true];
                } else {
                    Auth::logout();
                    return ["error" => true, "message" => "Your account is not active"];
                }
            } else {
                return ["error" => true, "message" => "Incorrect email or password"];
            }
        } else {
            return ["error" => true, "message" => "Incorrect email mobile or password "];
        }
    }
    static function getSidebarFileName()
    {
        return 'admin-menu.json';
    }



    static function getUserType()
    {
        return Auth::user()->user_type;
    }

}