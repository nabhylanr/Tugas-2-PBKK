@extends('layouts.app')

@section('title', 'Cart')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold" style="color: #1F3933;">Cart</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0; 
                        $totalItems = 0;
                    @endphp 
                    @forelse($cartItems as $item)
                    <tr>
                        <td>{{ $item->menu->nama_menu }}</td>
                        <td>Rp {{ number_format($item->menu->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->menu->harga * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $totalPrice += $item->menu->harga * $item->quantity;
                        $totalItems += $item->quantity; 
                    @endphp
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Keranjang anda kosong.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($cartItems->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Total Jumlah Item</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $totalItems }}</td>
                        <td>Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <a href="#" class="btn btn-primary" style="background-color: #1F3933; color: #FFFFFF;">Bayar</a>
        </div>
        @endif
    </div>
</div>
@endsection