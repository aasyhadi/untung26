<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;
use Session;

class AuthMenu
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()){
            return redirect()->guest('/login');
        }

        $path = $request->segment(1);
        if(in_array($path, ['beranda', 'dashboard', 'user-guide', 'akun-saya'])){
            return $next($request);
        }

        $id_user = Auth::user()->id;
        $cek_menu = DB::table('menu as a')
            ->join('role_menu as b', 'a.id_menu', '=', 'b.id_menu')
            ->join('user_role as c', 'b.id_role', '=', 'c.id_role')
            ->where('a.url', $path)
            ->where('c.id_user', $id_user)
            ->groupBy('a.id_menu')
            ->selectRaw('count(a.id_menu) as akses, sum(b.ucc) as a_create, sum(b.ucu) as a_update, sum(b.ucd) as a_delete')
            ->first();

        if (!$cek_menu){
            return redirect()->guest('/dashboard');
        }

        $crud_akses = ['update'=>$cek_menu->a_update, 'create'=>$cek_menu->a_create, 'delete'=>$cek_menu->a_delete];
        Session::put('uxa894-'.$path, json_encode($crud_akses));
        return $next($request);
    }
}
