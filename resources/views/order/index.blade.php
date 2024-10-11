@extends('layouts.app')

@section('title', 'Order Page')

@section('contents')
    @foreach($categories as $category)
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background-color: #1F3933; color: #FFFFFF;">
            <h6 class="m-0 font-weight-bold">{{ $category->nama }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Harga</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($category->menu as $menu)
                        <tr>
                            <td>{{ $menu->nama_menu }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td>
                                <!-- Form untuk Add to Cart -->
                                <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada menu untuk kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
@endsection
