<x-main>
    <x-slot name="title">Presto.it | {{__('ui.login')}}</x-slot>


    <div class="container py-4">
        <h1 class="text-center mb-4 pt-md-5 fw-bold">{{__('ui.loginOn')}} Presto.it</h1>
        <div class="row align-items-center flex-column">
            <div class="col-12 col-md-4 text-center mb-2">
                <a href="{{route('socialite.login.google', ['social' => 'google'])}}" class="btn btn-light btn-lg px-2 w-100 text-decoration-none fw-semibold"><img src="\img\google.png" alt="" height="30"> {{__('ui.loginWith')}} Google</a>
            </div>
            <div class="col-12 col-md-4 text-center mb-4">
                <a href="{{route('socialite.login.github', ['social' => 'github'])}}" class="btn btn-light btn-lg px-2 w-100 text-decoration-none fw-semibold"><img src="\img\github.png" alt="" height="30"> {{__('ui.loginWith')}} Github</a>
            </div>
            {{-- <div class="col-12 col-md-4 text-center mb-4">
                <a href="{{route('socialite.login.facebook')}}" class="btn btn-light btn-lg px-2 w-100 text-decoration-none fw-semibold"><img src="\img\facebook.png" alt="" height="30"> Accedi con Facebook</a>
            </div> --}}
            <div class="col-12 col-md-4 mb-4">
                <div class="d-flex align-items-center text-divider"><span class="mx-4 fs-5 mb-1">{{__('ui.or')}}</span></div>
            </div>
            <div class="col-12 col-md-4">

                <form class="p-4 shadow rounded" action="{{ route('login') }}" method="POST">
                    @method('POST')
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Email" required>
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="passwordInput" value="{{ old('password') }}" placeholder="Password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <button class="btn btn-light" type="button" id="showPasswordButton">
                          <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>


                    <button type="submit" class="btn btn-red btn-lg px-5 w-100 fw-semibold">{{__('ui.login')}}</button>
                </form>
                <p class="text-center mt-2">{{__('ui.noAccount')}} 
                    <a href="{{route('register')}}" class="text-decoration-none fw-semibold" style="color: var(--red)">{{__('ui.register')}}</a>
                </p>
            </div>
        </div>
    </div>
</x-main>