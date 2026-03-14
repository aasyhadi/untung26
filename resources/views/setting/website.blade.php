@extends('layout')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <h1 class="h3 mb-1">{{ $pagetitle }}</h1>
        <p class="text-muted mb-0">{{ $smalltitle }}</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ url('pengaturan-website/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Website</label>
                            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name ?? site_setting('site_name')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teks Brand / Domain</label>
                            <input type="text" name="site_domain_text" class="form-control" value="{{ old('site_domain_text', $setting->site_domain_text ?? site_setting('site_domain_text', site_setting('brand_name'))) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $setting->lokasi ?? site_setting('lokasi')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email ?? site_setting('email')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $setting->whatsapp_number ?? site_setting('whatsapp_number')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pesan Default WhatsApp</label>
                            <input type="text" name="whatsapp_default_message" class="form-control" value="{{ old('whatsapp_default_message', $setting->whatsapp_default_message ?? site_setting('whatsapp_default_message')) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $setting->hero_title ?? site_setting('hero_title')) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea name="hero_subtitle" rows="3" class="form-control">{{ old('hero_subtitle', $setting->hero_subtitle ?? site_setting('hero_subtitle')) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Profil Ringkas</label>
                            <textarea name="profil_ringkas" rows="4" class="form-control">{{ old('profil_ringkas', $setting->profil_ringkas ?? site_setting('profil_ringkas')) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Hero Image</label>
                            <input type="file" name="hero_image" class="form-control">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Preview ringkas</h5>
                <p class="mb-2"><strong>Brand:</strong> {{ $setting->site_domain_text ?? site_setting('site_domain_text', site_setting('brand_name')) }}</p>
                <p class="mb-2"><strong>Lokasi:</strong> {{ $setting->lokasi ?? site_setting('lokasi') }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $setting->email ?? site_setting('email') }}</p>
                <p class="mb-3"><strong>WhatsApp:</strong> {{ $setting->whatsapp_number ?? site_setting('whatsapp_number') }}</p>
                @if(!empty($setting->hero_image ?? null))
                    <img src="{{ media_url($setting->hero_image) }}" alt="Hero Image" class="img-fluid rounded">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
