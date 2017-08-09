<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Hash;
class User extends Authenticatable
{
    protected $table='users';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function addNew($input)
    {
    $check = static::where('facebook_id',$input['facebook_id'])->first();

    if(is_null($check)){
        return static::create($input);
    }

    return $check;
    
    }
    
    public static function View_User_By_Id($id)
    {
        $user=DB::table('users')->where('id',$id)->select();
            return $user;
    }
    public static function User_All(){
            $user=DB::table('users')
                    ->leftjoin('bills','bills.id_user','=','users.id')
                    ->select('users.id','users.full_name','users.email','users.phone','users.address','users.group','bills.id as id_bill');
            return $user;
    }
    
    public static function Edit_User($id,$name,$phone,$address)
    {
        $user = DB::table('users')->where('id',$id)->update(['full_name'=>$name,'phone'=>$phone,'address'=>$address]);
    }

    public static function Insert_User($name, $email, $password, $phone, $address, $group,$remember_token){
            $id=DB::table('users')->insertGetId(['full_name'=>$name,'email'=>$email, 'password'=>$password, 'phone'=>$phone, 'address'=>$address,'remember_token'=>$remember_token,'group'=>$group,'active'=>1]);
            return $id;
    }
    public static function Delete_User($id){
        $user=DB::table('users')->where('id','=',$id)->delete();
        return $user;
    }
    public static function changePassword($email, $password)
    {
        $user = DB::table('users')->where('email','=',$email)->update(['password'=>Hash::make($password)]);
    }

}
