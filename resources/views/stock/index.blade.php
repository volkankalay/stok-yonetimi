@php @endphp
@include('template.header')

<div class="container text-center mt-5">
    <p class="lead">
        <a href="{{route('stores.show', $store->id)}}" class="text-primary"> {{ $store->name }} </a>
    <h1 class="h3 text-success">{{ $stock->name }}</h1>
    <h2 class="h4 @if($stock->stock_amount < 0) text-danger @else text-success @endif">Güncel Stok
        Miktarı: {{ number_format($stock->stock_amount, 2, ',', '.') }}</h2>
    </p>
</div>

<div class="row mt-5">
    <div class="h2">
        Stok Geçmişi
    </div>

    <div class="row mt-3" id="new_store">
        <form method="POST" action="{{ route('addHistory') }}">
            @csrf
            <input type="hidden" name="store_id" value="{{$store->id}}">
            <input type="hidden" name="stock_id" value="{{$stock->id}}">
            <div class="row">

                <div class="form-group col-sm-3">
                    <label for="change" class="form-label">Stok Miktarı</label>
                    <input type="number" step="any" class="form-control" id="change" name="change"
                           value=""
                           placeholder="Değişim Miktarı">
                    @error('change')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col mt-2">
                    <button type="submit" class="btn btn-primary mt-4">Kaydet</button>
                </div>

            </div>
        </form>

    </div>

    <div class="row mt-5 table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tarih</th>
                <th>Saat</th>
                <th>Değişim Miktarı</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody>

            @foreach($histories as $history)
                <tr>
                    <td>#{{ $history->id }}</td>
                    <td>{{ \Carbon\Carbon::make($history->created_at)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::make($history->created_at)->format('H:i:s') }}</td>
                    <td class="@if($history->change * $history->direction < 0) text-danger @else text-success @endif">
                        {{ (number_format($history->change * $history->direction, 2, ',', '.')) }}
                    </td>
                    <td>
                        <form action="{{route('cancelHistory', $history->id)}}"
                              class="d-flex justify-content-center"
                              method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" name="store_id" value="{{$store->id}}">
                            <input type="hidden" name="stock_id" value="{{$stock->id}}">
                            <button type="submit" class="btn btn-danger btn-sm col-sm-4 mx-1">
                                İptal Et
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>
