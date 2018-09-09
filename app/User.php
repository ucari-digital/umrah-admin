<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use App\Helper\Response;
class User extends Authenticatable
{
    use Notifiable;

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

    public static function simpan($req)
    {
        try {
            $table = new self;
            $table->kode_user = 'USR'.rand(0000, 9999);
            $table->nama_user = $req->nama;
            $table->email = $req->email;
            $table->password = Hash::make($req->password);
            $table->level = 'admin';
            $table->status = 'active';
            $table->created_by = 'SUPERADMIN';
            $table->save();

            return Response::json($table, 'Berhasil menyimpan data', 'success', 200);
        } catch (\Exception $e) {
            return 'error : '.$e->getMessage();         
        }
    }
}
