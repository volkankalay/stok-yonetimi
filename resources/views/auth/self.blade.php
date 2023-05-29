@php use Illuminate\Support\Facades\Auth; $user = Auth::user(); @endphp
@include('template.header')

<div class="container text-center mt-5">
    <h1 class="h3 text-success">Hoşgeldiniz !</h1>
    <p class="lead">Merhaba <span class="text-primary"> {{ Auth::user()->name }} </span>
    </p>
</div>

<div class="row mt-5">
    <div class="h2">
        Kullanıcı
    </div>
    <div class="">
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">Ad</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th scope="row">E-posta</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th scope="row">Kayıt Tarihi</th>
                <td>{{ $user->created_at }}</td>
            </tr>
            <tr>
                <th scope="row">&nbsp;</th>
                <td>
                    <a class="btn btn-danger border border-secondary bg-danger bg-opacity-25"
                       style="border-radius: 8px;"
                       href="{{ route('logout') }}">
                        Çıkış Yap
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
