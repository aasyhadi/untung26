<?php
//fungsi Loading file helper
function loadHelper($str){
	$c=explode(",",$str);
	if($c){
		foreach($c as $v){
			$file= __DIR__ . "/../Helpers/$v".".php";
			if(file_exists($file)) {
				require_once $file;
			}
		}
	}
}

function loadClass($str){
	$c=explode(",",$str);
	if($c){
		foreach($c as $v){
			$file= __DIR__ . "/../Library/$v".".php";
			if(file_exists($file)) {
				require_once $file;
			}
		}
	}
}





function media_url($path, $default = null){
    $fallback = $default ? asset($default) : asset('images/og-image1.png');

    if (empty($path)) {
        return $fallback;
    }

    $path = ltrim((string) $path, '/');

    if (preg_match('/^https?:\/\//i', $path)) {
        return $path;
    }

    if (strpos($path, 'storage/') === 0) {
        $storagePath = substr($path, 8);

        if ($storagePath !== '' && \Illuminate\Support\Facades\Storage::disk('public')->exists($storagePath)) {
            return url('media/' . ltrim($storagePath, '/'));
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return $fallback;
    }

    if (strpos($path, 'uploads/') === 0 || strpos($path, 'images/') === 0 || strpos($path, 'img/') === 0) {
        return file_exists(public_path($path)) ? asset($path) : $fallback;
    }

    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
        return url('media/' . ltrim($path, '/'));
    }

    if (file_exists(public_path($path))) {
        return asset($path);
    }

    return $fallback;
}

function normalize_wa_number($number){
    $number = preg_replace('/\D+/', '', (string) $number);
    if ($number === '') {
        return '';
    }
    if (strpos($number, '0') === 0) {
        return '62' . substr($number, 1);
    }
    if (strpos($number, '62') === 0) {
        return $number;
    }
    return $number;
}

function wa_link($number, $message = ''){
    $number = normalize_wa_number($number);
    if ($number === '') {
        return '#';
    }

    $url = 'https://wa.me/' . $number;
    if ($message !== '') {
        $url .= '?text=' . rawurlencode($message);
    }
    return $url;
}

function site_setting($key = null, $default = null){
    static $items = null;

    if ($items === null) {
        $items = config('site', []);

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                $row = \Illuminate\Support\Facades\DB::table('site_settings')->orderBy('id')->first();
                if ($row) {
                    $items = array_merge($items, (array) $row);
                }
            }
        } catch (\Throwable $e) {
            // fallback ke config saat migrasi / install awal
        }
    }

    if ($key === null) {
        return $items;
    }

    return data_get($items, $key, $default);
}
