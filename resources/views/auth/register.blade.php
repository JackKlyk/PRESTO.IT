<x-main>
    <x-slot name="title">Presto.it | {{__('ui.register')}}</x-slot>

    <div class="container py-md-5">
        <h1 class="text-center mb-4 fw-bold">{{__('ui.registerOn')}} Presto.it</h1>
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
                <form class="p-4 shadow rounded" action="{{ route('register') }}" method="POST">
                    @method('POST')
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Username" required>
                        <label for="name" class="form-label">Username</label>
                        @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Email" required>
                        <label for="email" class="form-label">Email</label>
                        @error('email')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="{{__('ui.phone')}}" required>
                        <label for="phone" class="form-label">{{__('ui.phone')}}</label>
                        @error('phone')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control" id="passwordInput" value="{{ old('password') }}" placeholder="Password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <button class="btn btn-light" type="button" id="showPasswordButton">
                          <i class="bi bi-eye-slash"></i>
                        </button>
                        @error('password')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmInput" value="{{ old('confirm_password') }}" placeholder="{{__('ui.confirm')}} Password" required>
                            <label for="password_confirmation" class="form-label">{{__('ui.confirm')}} Password</label>
                        </div>
                        <button class="btn btn-light" type="button" id="showConfirmPasswordButton">
                          <i class="bi bi-eye-slash"></i>
                        </button>
                        @error('password_confirmation')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Maschio">{{__('ui.male')}}</option>
                            <option value="Femmina">{{__('ui.female')}}</option>
                            <option value="Non binario">{{__('ui.noBinary')}}</option>
                            <option selected value="Non specificato">{{__('ui.notSpecified')}}</option>
                        </select>
                        <label for="gender">{{__('ui.gender')}}</label>
                        @error('gender')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" id="birthday" name="birthday" type="date" value="{{ old('birthday') }}" placeholder="{{__('ui.birthday')}}">
                        <label for="birthday">{{__('ui.birthday')}}</label>
                        @error('birthday')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>
    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-red btn-lg px-5 w-100 fw-semibold">{{__('ui.register')}}</button>
                </form>
                <p class="text-center mt-2">{{__('ui.yesAccount')}} 
                    <a href="{{route('login')}}" class="text-decoration-none fw-semibold" style="color: var(--red)">{{__('ui.login')}}</a>
                </p>
            </div>
        </div>
    </div>
</x-main>