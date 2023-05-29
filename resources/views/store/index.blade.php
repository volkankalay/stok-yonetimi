@php @endphp
@include('template.header')

<div class="container text-center mt-5">
    <h1 class="h3 text-success">{{ $store->name }}</h1>
    <p class="lead"><span class="text-primary"> {{ $store->name }} </span>
    </p>
</div>

<div class="row">
    <form action="{{ route('stores.update', $store->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col">
                <label for="name">Mağaza Adı</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $store->name }}">
            </div>

            <div class="form-group col mt-4">
                <button type="submit" class="btn btn-primary">Güncelle</button>
            </div>
        </div>
    </form>
</div>

<div class="row mt-5">
    <div class="h2">
        Stoklar
    </div>

    <div class="row mt-3" id="new_store">
        <form method="POST" action="{{ route('stocks.store') }}">
            @csrf
            <input type="hidden" name="store_id" value="{{$store->id}}">
            <div class="row">

                <div class="form-group col">
                    <label for="name" class="form-label">Stok Adı</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                           placeholder="Stok Adı" required>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col">
                    <label for="unit" class="form-label">Stok Birimi</label>
                    <input type="text" class="form-control" id="unit" name="unit" value="{{ old('unit') }}"
                           placeholder="Stok Birimi" required>
                    @error('unit')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col">
                    <label for="stock_amount" class="form-label">Stok Miktarı</label>
                    <input type="number" step="any" class="form-control" id="stock_amount" name="stock_amount"
                           value="0"
                           placeholder="Stok Miktarı">
                    @error('stock_amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
                </div>

            </div>
        </form>

    </div>

    <div class="row mt-2 table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Stok Adı</th>
                <th>Stok Birimi</th>
                <th>Stok Miktarı</th>
                <th class="text-center">İşlemler</th>
            </tr>
            </thead>
            <tbody>


            @foreach($stocks as $stock)
                <tr>
                    <td>#{{ $stock->id }}</td>
                    <td>{{ $stock->name }}</td>
                    <td>{{ $stock->unit }}</td>
                    <td class="@if($stock->stock_amount < 0) text-danger @else text-success @endif">{{ number_format($stock->stock_amount, 2, ',', '.') }}</td>
                    <td>
                        <form action="{{route('stocks.destroy', $stock->id)}}"
                              class="d-flex justify-content-center"
                              method="POST">
                            <input type="hidden" name="store_id" value="{{$stock->store_id}}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('stocks.show', $stock->id) }}"
                               class="btn btn-primary btn-sm col-sm-2 mx-1">
                                Görüntüle
                            </a>
                            <button type="submit" class="btn btn-danger btn-sm col-sm-2 mx-1">
                                Sil
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
