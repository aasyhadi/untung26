<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\FrontPageController;
use App\Buku;
use Carbon\Carbon;

Route::get('/', 'FrontPageController@home')->name('home.public');
Route::get('/homepage', function () { return redirect('/'); });
Route::get('/profil', function () { return view('front-end.pages.profil'); })->name('profil.public');
Route::get('/artikel-konstruksi', 'FrontPageController@artikels');
Route::get('/artikel-konstruksi/{slug}', 'FrontPageController@artikelDetail');
Route::get('/produk', 'FrontPageController@produks');
Route::get('/produk/{slug}', 'FrontPageController@produkDetail');


Route::get('/media/{path}', function ($path) {
    abort_unless($path && strpos($path, '..') === false, 404);

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    return response()->file(Storage::disk('public')->path($path));
})->where('path', '.*')->name('media.public');


Route::get('/konsultasi/sukses', function () {
    return redirect()->route('konsultasi.success');
})->name('konsultasi.sukses');
Route::get('/konsultasi/success', function () {
    return view('front-end.pages.success');
})->name('konsultasi.success');

Route::get('/layanan/konsultasi', function () {
    return view('front-end.pages.konsultasi');
});
Route::post('/konsultasi/store', [KonsultasiController::class, 'store'])->name('konsultasi.store');
Route::get('/layanan/konsultasi/pertanyaan', function () { return view('front-end.pages.pertanyaan'); });
Route::get('/layanan/pelatihan', function () { return view('front-end.pages.pelatihan'); });
Route::get('/layanan/sertifikasi', function () { return view('front-end.pages.sertifikasi'); });
Route::get('/layanan/narasumber', function () { return view('front-end.pages.narasumber'); });
Route::get('/layanan/karya-tulis', function () { return view('front-end.pages.karyatulis'); });
Route::get('/profil-profesional', function () { return redirect()->route('profil.public'); });
Route::get('/hubungi', function () { return view('front-end.pages.hubungi'); });
Route::get('/syarat-ketentuan', function () { return view('front-end.pages.syarat-ketentuan'); });
Route::get('/kebijakan-privasi', function () { return view('front-end.pages.kebijakan-privasi'); });
Route::get('/layanan/karya-tulis/buku', function () { return view('front-end.pages.buku'); });
Route::get('/layanan/karya-tulis/buku-detail/{uuid}', function () { return view('front-end.pages.buku-detail'); });
Route::get('/layanan/karya-tulis/form', function () { return view('front-end.pages.templateform'); });
Route::get('/layanan/karya-tulis/form-detail/{uuid}', function () { return view('front-end.pages.templateform-detail'); });
Route::get('/layanan/karya-tulis/ppt', function () { return view('front-end.pages.ppt'); });
Route::get('/layanan/karya-tulis/ppt-detail/{uuid}', function () { return view('front-end.pages.ppt-detail'); });

Route::get('/login','LoginController@page_login');
Route::post('/submit-login','LoginController@submit_login');
Route::get('/login-attempt','LoginController@do_login_cookies');
Route::get('/logout','LoginController@logout');
Route::get('/ganti-password','LoginController@ganti_password');
Route::post('/update-password','LoginController@submit_update_password');
Route::get('/profile','LoginController@profile_user');

Route::group(["middleware"=>['auth.login','auth.menu']], function(){
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::group(['prefix'=>'setting-menu'], function(){
        Route::get('/', 'SettingMenuController@index');
        Route::get('/dt', 'SettingMenuController@datatable');
        Route::get('/get-data/{uuid}', 'SettingMenuController@get_data');
        Route::post('/insert', 'SettingMenuController@submit_insert');
        Route::post('/update', 'SettingMenuController@submit_update');
        Route::post('/delete', 'SettingMenuController@submit_delete');
    });

    Route::group(['prefix'=>'setting-role'], function(){
        Route::get('/', 'SettingRoleController@index');
        Route::get('/dt-role', 'SettingRoleController@datatable_role');
        Route::get('/dt-menu/{id_role}', 'SettingRoleController@datatable_menu');
        Route::get('/menu/{uuid}', 'SettingRoleController@menu_role');
        Route::get('/get-role/{uuid}', 'SettingRoleController@get_data_role');
        Route::get('/get-menu/{uuid}', 'SettingRoleController@get_data_menu');
        Route::post('/insert-role', 'SettingRoleController@submit_insert_role');
        Route::post('/update-role', 'SettingRoleController@submit_update_role');
        Route::post('/delete-role', 'SettingRoleController@submit_delete_role');
        Route::post('/insert-menu', 'SettingRoleController@submit_insert_menu');
        Route::post('/update-menu', 'SettingRoleController@submit_update_menu');
        Route::post('/delete-menu', 'SettingRoleController@submit_delete_menu');
    });

    Route::group(['prefix'=>'pengaturan-website'], function(){
        Route::get('/', 'WebsiteSettingController@index');
        Route::post('/update', 'WebsiteSettingController@update');
    });

    Route::group(['prefix'=>'jadwal-pelayanan'], function(){
        Route::get('/', 'JadwalPelayananController@index');
        Route::get('/dt', 'JadwalPelayananController@datatable');
        Route::get('/get-data/{uuid}', 'JadwalPelayananController@get_data');
        Route::post('/insert', 'JadwalPelayananController@submit_insert');
        Route::post('/update', 'JadwalPelayananController@submit_update');
        Route::post('/delete', 'JadwalPelayananController@submit_delete');
    });

    Route::group(['prefix'=>'master-artikel'], function(){
        Route::get('/', 'MasterArtikelController@index');
        Route::get('/dt', 'MasterArtikelController@datatable');
        Route::get('/get-data/{uuid}', 'MasterArtikelController@get_data');
        Route::post('/insert', 'MasterArtikelController@submit_insert');
        Route::post('/update', 'MasterArtikelController@submit_update');
        Route::post('/delete', 'MasterArtikelController@submit_delete');
    });

    Route::group(['prefix'=>'master-produk'], function(){
        Route::get('/', 'MasterProdukController@index');
        Route::get('/dt', 'MasterProdukController@datatable');
        Route::get('/get-data/{uuid}', 'MasterProdukController@get_data');
        Route::post('/insert', 'MasterProdukController@submit_insert');
        Route::post('/update', 'MasterProdukController@submit_update');
        Route::post('/delete', 'MasterProdukController@submit_delete');
    });

    Route::group(['prefix'=>'order-konsultasi'], function(){
        Route::get('/', 'OrderKonsultasiController@index');
        Route::get('/dt', 'OrderKonsultasiController@datatable');
        Route::get('/get-data/{uuid}', 'OrderKonsultasiController@get_data');
        Route::post('/update', 'OrderKonsultasiController@submit_update');
    });

    Route::group(['prefix'=>'konsul-terjawab'], function(){
        Route::get('/', 'KonsulTerjawabController@index');
        Route::get('/dt', 'KonsulTerjawabController@datatable');
        Route::get('/get-data/{uuid}', 'KonsulTerjawabController@get_data');
        Route::post('/update', 'KonsulTerjawabController@submit_update');
    });
});

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'lastmod' => Carbon::now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => url('/artikel-konstruksi'), 'lastmod' => Carbon::now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => url('/produk'), 'lastmod' => Carbon::now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => url('layanan/konsultasi'), 'lastmod' => Carbon::now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.6'],
        ['loc' => url('layanan/pelatihan'), 'lastmod' => Carbon::now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
    ];

    if (Schema::hasTable('buku')) {
        $books = Buku::orderBy('updated_at', 'desc')->get();
        foreach ($books as $book) {
            $urls[] = [
                'loc' => url('/layanan/karya-tulis/buku-detail/' . $book->uuid),
                'lastmod' => optional($book->updated_at)->toDateString() ?? Carbon::now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.7',
            ];
        }
    }

    return Response::view('sitemap', compact('urls'))->header('Content-Type', 'application/xml');
});
