<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Hash;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class LoginController extends Controller
{
    function page_login(){ return view('login'); }

    function do_login_by_token(Request $r){
        $token = $r->token;
        try {
            Auth::logout(); Session::flush();
            $uuid_token = explode("#", decrypt($token));
            if(count($uuid_token)!=2){ return redirect('login'); }
            $uuid = $uuid_token[0]; $valid_time = $uuid_token[1];
            if(time() > $valid_time){ return redirect('/dashboard'); }
            $pegawai = DB::table('tb_pegawairs')->where('uuid', $uuid)->first();
            if(!$pegawai){ return redirect('/dashboard'); }
            $user = DB::table('users')->where('id_pegawai',$pegawai->id_pegawai)->first();
            if($user){ Auth::loginUsingId($user->id); $this->generate_user_menu(); return redirect('/dashboard'); }
            return redirect('/dashboard');
        } catch (DecryptException $e) { return redirect('/dashboard'); }
    }

    function do_login_cookies(Request $request){
        $cookies = $request->query('cookies');
        if(!$cookies){ return redirect('login'); }
        try {
            $uuid = decrypt($cookies);
            $user = DB::table('users')->where('uuid',$uuid)->first();
            if($user){ Auth::loginUsingId($user->id); $this->generate_user_menu(); return redirect('/dashboard'); }
            return redirect('login');
        } catch (DecryptException $e) { return redirect('login'); }
    }

    function ganti_password(){ $pagetitle = 'Ganti Password'; $smalltitle = ''; return view('setting.ganti-password', compact('pagetitle','smalltitle')); }

    function submit_update_password(Request $r){
        $user = Auth::user();
        if (Hash::check($r->password1, $user->password)){
            if ($r->password2 == $r->password3){
                if (strlen($r->password2)>=5){
                    DB::table('users')->where('id', $user->id)->update(['password'=>bcrypt($r->password2),'updated_at'=>date('Y-m-d H:i:s')]);
                    Session::flash('success', 'Password Berhasil Diubah!');
                }else{ Session::flash('error', 'Password Minimal 5 Karakter'); }
            }else{ Session::flash('error','Konfirmasi Password Baru Tidak Sama!'); }
        }else{ Session::flash('error','Password Lama Salah!'); }
        return redirect('ganti-password');
    }

    function submit_login(Request $r){
        $r->validate(['username' => 'required', 'password' => 'required']);
        if (Auth::attempt(['username' => $r->username, 'password' => $r->password])) {
            $this->generate_user_menu();
            return redirect()->intended('/dashboard');
        }
        return redirect('login')->with('error', 'Username dan Password Tidak Sesuai');
    }

    /* function generate_user_menu(){
        $id_user = Auth::user()->id; $menu_user = array();
        $menu_induk = DB::table('user_role as a')->join('role_menu as b','a.id_role','=','b.id_role')->join('menu as c','c.id_menu','=','b.id_menu')->join('menu as d','c.id_menu_induk','=','d.id_menu')->where('a.id_user',$id_user)->groupBy('d.id_menu','d.nama_menu','d.url','d.id_menu_induk','d.urutan','d.icon','d.uuid')->orderBy('d.urutan')->select('d.*')->get();
        foreach($menu_induk as $mni){
            $menu_user[$mni->id_menu] = ['id_menu'=>$mni->id_menu,'url'=>$mni->url,'icon'=>$mni->icon,'nama_menu'=>$mni->nama_menu,'child'=>[]];
            $menu_anak = DB::table('user_role as a')->join('role_menu as b','a.id_role','=','b.id_role')->join('menu as c','c.id_menu','=','b.id_menu')->join('menu as d','c.id_menu_induk','=','d.id_menu')->where('a.id_user',$id_user)->where('c.id_menu_induk',$mni->id_menu)->groupBy('c.nama_menu','c.id_menu','c.url','c.urutan','c.id_menu_induk')->orderBy('c.id_menu_induk')->orderBy('c.urutan')->select('c.nama_menu','c.id_menu','c.url','c.urutan','c.id_menu_induk')->get();
            foreach($menu_anak as $mna){ $menu_user[$mni->id_menu]['child'][] = ['id_menu'=>$mna->id_menu,'url'=>$mna->url,'nama_menu'=>$mna->nama_menu]; }
        }
        Session::put('menu7890_2386', json_encode($menu_user));
    } */

    function generate_user_menu()
    {
        $id_user   = Auth::user()->id;
        $menu_user = [];

        $menu_induk = DB::table('user_role as a')
            ->join('role_menu as b', 'a.id_role', '=', 'b.id_role')
            ->join('menu as c', 'c.id_menu', '=', 'b.id_menu')
            ->join('menu as d', 'c.id_menu_induk', '=', 'd.id_menu')
            ->where('a.id_user', $id_user)
            ->groupBy(
                'd.id_menu',
                'd.nama_menu',
                'd.url',
                'd.id_menu_induk',
                'd.urutan',
                'd.icon',
                'd.uuid'
            )
            ->orderBy('d.urutan')
            ->select('d.id_menu',
                'd.nama_menu',
                'd.url',
                'd.id_menu_induk',
                'd.urutan',
                'd.icon',
                'd.uuid')
            ->get();

        foreach ($menu_induk as $mni) {

            $menu_user[$mni->id_menu] = [
                'id_menu'   => $mni->id_menu,
                'url'       => $mni->url,
                'icon'      => $mni->icon,
                'nama_menu' => $mni->nama_menu,
                'child'     => []
            ];

            $menu_anak = DB::table('user_role as a')
                ->join('role_menu as b', 'a.id_role', '=', 'b.id_role')
                ->join('menu as c', 'c.id_menu', '=', 'b.id_menu')
                ->join('menu as d', 'c.id_menu_induk', '=', 'd.id_menu')
                ->where('a.id_user', $id_user)
                ->where('c.id_menu_induk', $mni->id_menu)
                ->groupBy(
                    'c.nama_menu',
                    'c.id_menu',
                    'c.url',
                    'c.urutan',
                    'c.id_menu_induk'
                )
                ->orderBy('c.id_menu_induk')
                ->orderBy('c.urutan')
                ->select(
                    'c.nama_menu',
                    'c.id_menu',
                    'c.url',
                    'c.urutan',
                    'c.id_menu_induk'
                )
                ->get();

            foreach ($menu_anak as $mna) {

                $menu_user[$mni->id_menu]['child'][] = [
                    'id_menu'   => $mna->id_menu,
                    'url'       => $mna->url,
                    'nama_menu' => $mna->nama_menu
                ];
            }
        }

        Session::put('menu7890_2386', json_encode($menu_user));
    }


    function logout(){ Auth::logout(); Session::flush(); setcookie('buker_cookie', '', time() + 1, '/'); return redirect('/'); }
    function profile_user(){ $pagetitle='Profil'; $smalltitle=''; return view('setting.profile', compact('pagetitle','smalltitle')); }
}
