@extends('layouts.app')

@section('title', 'Membership')

@section('contents')
<div class="container mt-5">
    @if(!$membership)
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Kamu belum join membership</h4>
        <p>Silakan daftar untuk mendapatkan akses membership eksklusif kami.</p>
    </div>
    
    @else
    <div class="card shadow mb-4" style="border-radius: 15px;">
        <div class="card-header py-3" style="background-color: #1F3933; color: #FFFFFF; border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <h5 class="m-0 font-weight-bold">Membership Card</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('images/membership-card.png') }}" alt="Membership Card" class="img-fluid" style="border-radius: 15px;">
                </div>
                <div class="col-md-8">
                    <h4 class="font-weight-bold" style="color: #1F3933;">Nama: {{ $auth()->user()->nama }}</h4>
                    <p>ID Membership: {{ $membership->id }}</p>
                    <p>Tanggal Buat: {{ $membership->tglbuat->format('d-m-Y') }}</p>
                    <p>Tanggal Kadaluwarsa: {{ $membership->tglkadaluwarsa->format('d-m-Y') }}</p>
                    <p class="text-muted">Terima kasih telah menjadi anggota kami!</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
