@php use Illuminate\Support\Facades\Auth; @endphp
@include('template.header')

<div class="container text-center mt-5">
    <h1 class="h3 text-success">Hoşgeldiniz !</h1>
    <p class="lead">Merhaba <span class="text-primary"> {{ Auth::user()->name }} </span>, burası hoşgeldiniz sayfasıdır.
    </p>
</div>

<div class="row mt-5">
    <div class="h2">
        Mağazalar
    </div>

    <div class="row mt-2">
        @foreach($stores as $store)
            <div class="col-md-2">
                <form action="{{ route('stores.destroy', $store->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="btn-group mt-3" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-outline-primary">{{ $store->name }}</button>
                        <a href="{{ route('stores.show', $store->id) }}" type="button"
                           class="btn btn-secondary">Görüntüle</a>
                        <button type="submit" class="btn btn-danger">Sil</button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <div class="row mt-3" id="new_store">
        <form method="POST" action="{{route('stores.store')}}">
            @csrf

            <div class="row col-sm-4">
                <div class="col">
                    <div class="form-group">
                        <label for="name" class="form-label">Mağaza Adı</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success">+ Mağaza Ekle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>

</div>
