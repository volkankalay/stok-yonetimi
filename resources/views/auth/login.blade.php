@include('template.header')
<div class="h1 text-primary">Giriş Yap</div>
<div class="mx-auto m-auto">
    <div class="row col-sm-12">


        <form method="POST" action="{{ route('logMeIn') }}" class="form mx-auto">
            @csrf

            <div class="form-group mt-3">
                <label for="email">E-Posta</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">Parola</label>
                <input type="password" name="password" id="password" required class="form-control">
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block w-100 mt-3">Giriş Yap</button>
            </div>
        </form>


        <div class="form-group mt-5">
            <a href="{{ route('register') }}" class="btn btn-lg btn-info text-white btn-block w-100 mt-3">Kayıt Ol
            </a>
        </div>
    </div>

</div>
</div>
</body>
</html>
