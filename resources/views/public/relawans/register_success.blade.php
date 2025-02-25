@extends('layouts.public')

@section('title', 'Pendaftaran Berhasil')

@section('header')
    Pendaftaran Berhasil
@endsection

@section('content')
    <div class="row">
        <h1>Pendaftaran Berhasil</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('relawan'))
        <div class="row">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title">Data DIri</h3></div>
            <div class="card-body">
                <p>Pendaftaran Anda Berhasil</p>
                <b>Tunjukkan nomor Identitas MSP Anda setiap kali mengikuti kegiatan Ramadhan Fest</b>
                <p>Nomor Identitas MSP Anda: <strong>{{ session('relawan')->identity }}</strong></p>
                <p>Email: {{ session('relawan')->email }}</p>
                <p>Nama Lengkap: {{ session('relawan')->fullname }}</p>
                <p>Nomor Whatsapp: {{ session('relawan')->wa_number }}</p>
                <p>Alamat Lengkap: {{ session('relawan')->address }}</p>

            </div>
            </div>
        </div>
    @endif

    <a href="{{ route('public.relawans.register') }}" class="btn btn-secondary">Back</a>
@endsection
