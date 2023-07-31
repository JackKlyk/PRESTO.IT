<nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top">
    <div class="container px-3 px-md-5 align-items-center">
        <a class="navbar-brand" href="{{ Route('homepage') }}"><img src="\img\presto.it_logo.png" alt=""
                height="50rem"></a>
        <button id="hamburger-list" class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar" aria-controls="offcavasNavbar" aria-expanded="false"
            aria-label="Toggle navigation"><i class="bi bi-hash text-white"></i></button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <a class="offcanvas-title" id="offcanvasNavbarLabel" href="{{ Route('homepage') }}"><img
                        src="\img\presto.it_logo.png" alt="" height="50rem"></a>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto mb-2 mb-sm-0 flex-col-reverse flex-lg-row-reverse">

                    @auth
                        <li class="nav-item dropdown fs-5 pe-0 pe-md-3 mx-auto">
                            <a class="nav-link text-white fw-semibold d-flex align-items-center d-none d-md-flex position-relative"
                                href="{{ route('users.show', ['user' => Auth::user()->id]) }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} <img class="card-img max-vh-3 ms-2 rounded-circle w-auto"
                                    style="clip-path: circle(50%)"
                                    src="@if (Auth::user()->gender == 'Femmina') {{ empty(Auth::user()->img) ? '/img/female-placeholder.jpg' : Storage::url(Auth::user()->img) }}
                            @elseif (Auth::user()->gender == 'Maschio') 
                                {{ empty(Auth::user()->img) ? '/img/male-placeholder.jpeg' : Storage::url(Auth::user()->img) }}
                            @elseif (Auth::user()->gender == 'Non binario' || Auth::user()->gender == 'Non specificato')
                                {{ empty(Auth::user()->img) ? '/img/user-placeholder.png' : Storage::url(Auth::user()->img) }} @endif"
                                    alt="">
                                @if (Auth::user()->is_revisor && $announcements_to_check)
                                    <span
                                        class="position-absolute top-0 end-0 translate-middle p-1 mt-2 rounded btn-green"></span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end d-block d-md-none mb-4">
                                <li><a class="dropdown-item fw-semibold d-flex justify-content-between fs-5 d-none d-md-flex"
                                        href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                                        {{__('ui.profile')}} <i class="bi bi-person-circle"></i></a></li>
                                <li>
                                <li><a class="dropdown-item fw-bold d-flex justify-content-between fs-5 d-block d-md-none"
                                        href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                                        {{ Auth::user()->name }} <img class="card-img max-vh-4 mt-1 rounded-circle w-auto"
                                            style="clip-path: circle(50%)"
                                            src="@if (Auth::user()->gender == 'Femmina') {{ empty(Auth::user()->img) ? '/img/female-placeholder.jpg' : Storage::url(Auth::user()->img) }}
                            @elseif (Auth::user()->gender == 'Maschio') 
                                {{ empty(Auth::user()->img) ? '/img/male-placeholder.jpeg' : Storage::url(Auth::user()->img) }}
                            @elseif (Auth::user()->gender == 'Non binario' || Auth::user()->gender == 'Non specificato')
                                {{ empty(Auth::user()->img) ? '/img/user-placeholder.png' : Storage::url(Auth::user()->img) }} @endif"
                                            alt=""></a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item fw-semibold"
                                    href="{{ route('users.show', ['user' => Auth::user()->id]) }}/#like-annunci">
                                    <i class="bi bi-suit-heart me-2"></i>{{__('ui.likeAnnouncements')}}</a></li>
                                </li>
                                <li><a class="dropdown-item fw-semibold"
                                        href="{{ route('users.show', ['user' => Auth::user()->id]) }}/#my-annunci">
                                        <i class="bi bi-tags me-2"></i>{{__('ui.myAnnouncements')}}</a></li>
                                </li>
                        @if (Auth::user()->is_revisor)
                            <li><a class="dropdown-item fw-semibold" href="{{ route('revisor.index') }}">
                                    <i class="bi bi-clipboard-data me-2"></i>{{__('ui.revisorZone')}}
                                    @if ($announcements_to_check > 0)
                                        <span class="badge btn-green">{{ $announcements_to_check }}</span>
                                    @endif
                                </a></li>
                            </li>
                        @endif
                        @if (Auth::user()->is_admin)
                            <li><a class="dropdown-item fw-semibold" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-shield-lock me-2"></i>{{__('ui.adminZone')}}
                                </a></li>
                            </li>
                        @endif
                        <li class="px-2 mt-2"><a class="btn btn-light-orange w-100 fw-semibold"
                                href="{{ route('announcements.create') }}">
                                <i class="bi bi-plus-square"></i> {{__('ui.announcement')}}</a>
                        </li>
                        @if (!Auth::user()->is_revisor)
                            <li class="px-2 mt-2">
                                <button class="btn btn-green w-100 fw-semibold px-0" data-bs-toggle="modal" data-bs-target="#modalRevisor">
                                    <i class="bi bi-clipboard-data"></i> {{__('ui.workWithUs')}}</button>
                            </li>
                        @endif
                        <li class="px-2 mt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-red w-100 fw-bold"
                                    onclick="event.preventDefault(); this.closest('form').submit();">{{__('ui.logout')}}</button>
                            </form>
                        </li>
                    </ul>
                    </li>
                    @if (Route::currentRouteName() == 'announcements.index' || Route::currentRouteName() == 'search' || Route::currentRouteName() == 'announcements.search' || Route::currentRouteName() == 'homepage')
                        <li class="nav-item me-0 me-lg-4">
                            <a class="nav-link text-center d-none d-md-block fw-semibold" href="{{ route('announcements.create') }}">
                                <i class="bi bi-plus-square"></i> {{__('ui.addAnnouncement')}}
                            </a>
                        </li>
                    @endif

                @else
                    <ul class="navbar-nav justify-content-evenly flex-row mb-4 mb-md-0">
                        <li class="nav-item mt-1">
                            <a href="{{ route('login') }}" class="btn btn-light text-black px-4 fw-semibold">{{__('ui.login')}}</a>
                        </li>
                        <li class="nav-item mt-1 ms-md-3">
                            <a href="{{ route('register') }}" class="btn btn-red px-4 fw-semibold">{{__('ui.register')}}</a>
                        </li>
                    </ul>
                @endauth

                @if (Route::currentRouteName() == 'announcements.index' || Route::currentRouteName() == 'search' || Route::currentRouteName() == 'announcements.search' || Route::currentRouteName() == 'homepage' || Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register' )
                @else
                <li class="nav-item me-0 me-lg-4 pt-1 mb-4 mb-md-0">
                    <form action="{{ route('announcements.search') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input name="searched" class="form-control" type="search" placeholder="{{__('ui.search')}}..."
                                aria-label="Cerca">
                            <button class="btn btn-red border-0" type="submit"><i class="bi bi-search"></i></button>
                        </div>

                    </form>
                </li>
            @endif
                <li class="dropdown me-0 me-lg-4">
                    <a class="nav-link dropdown-toggle text-center d-none d-md-block fw-semibold" href=""
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{__('ui.categories')}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end d-block d-md-none px-2 text-center">
                        <li><a class="btn btn-light-orange w-100 fw-bold fs-5"
                                href="{{ route('macro', ['macro' => 'motori']) }}">{{__('ui.motors')}}</a></li>
                        @foreach ($categories as $category)
                            @if ($category->macro == 'motori')
                                <li><a class="dropdown-item capitalize fw-semibold"
                                        href="{{ route('categories.show', ['category' => $category->id]) }}">@if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="mt-3"><a class="btn btn-orange w-100 fw-bold fs-5"
                                href="{{ route('macro', ['macro' => 'immobili']) }}">{{__('ui.properties')}}</a></li>
                        @foreach ($categories as $category)
                            @if ($category->macro == 'immobili')
                                <li><a class="dropdown-item capitalize fw-semibold"
                                        href="{{ route('categories.show', ['category' => $category->id]) }}">@if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="mt-3"><a class="btn btn-red w-100 fw-bold fs-5"
                                href="{{ route('macro', ['macro' => 'market']) }}">{{__('ui.market')}}</a></li>
                        @foreach ($categories as $category)
                            @if ($category->macro == 'market')
                                <li><a class="dropdown-item capitalize fw-semibold"
                                        href="{{ route('categories.show', ['category' => $category->id]) }}">@if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <ul class="navbar-nav flex-row justify-content-center me-0 me-lg-4">
                    <li class="nav-item">
                        <x-_locale lang='it' nation='it'/>
                    </li>
                    <li class="nav-item mx-2 mx-lg-0">
                        <x-_locale lang='eng' nation='gb'/>
                    </li>
                    <li class="nav-item">
                        <x-_locale lang='es' nation='es'/>
                    </li>
                </ul>
            </ul>
            </div>
        </div>
    </div>
</nav>

@auth

{{-- ! MODAL REVISOR --}}
<div class="modal fade" id="modalRevisor" tabindex="-1" aria-labelledby="modaleAccept" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 w-110">
            <div class="modal-header border-0 text-center">
                <h1 class="modal-title lh-1 fw-bold w-100">COMPILA IL FORM<br><span class="fs-3 fw-light">e diventa revisore di Presto.it!</span></h1>
            </div>
            <div class="modal-body">
                <form action="{{ Route('become.revisor') }}" method="POST" class="row px-3">
                    @csrf
                    @method('PATCH')
                    <div class="form-floating mb-3 col-12 col-md-5 px-0 pe-md-2">
                        <input type="text" name="name" class="form-control" id="name" value="{{ Auth::user()->name }}" placeholder="Username" readonly>
                        <label for="name" class="form-label">Username</label>
                    </div>
                    <div class="form-floating mb-3 col-12 col-md-7 px-0">
                        <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email }}" placeholder="Email" readonly>
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="form mb-3 px-0">
                        <textarea class="form-control" id="description" name="description"
                            value="description" placeholder="Perchè vuoi diventare Revisore di Presto.it?" rows="5" required></textarea>
                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div>
                        <h3>Regolamento del Revisore:</h3>
                        <ul>
                            <li>Il Revisore deve essere oggettivo;</li>
                            <li>Il Revisore deve rifiutare l'annuncio ove è presente un linguaggio inappropiato;</li>
                            <li>Il Revisore deve rifiutare l'annuncio se non rispetta le policy di Presto.it;</li>
                            <li>Il Revisore deve rifiutare l'annuncio se presenta titolo, prezzo o immagini inappropriate;</li>
                            <li>Il Revisore deve accettare solo se l'annuncio rispetta tutte le regole sopraindicate.</li>   
                        </ul> 
                    </div>
                    <div class="form-check my-2 ps-4">
                        <input class="form-check-input" type="checkbox" value="checkRegolamento" id="checkRegolamento" required>
                        <label class="form-check-label fw-semibold" for="checkRegolamento">Accetto il "Regolamento del Revisore"</label>
                    </div>

                    <button type="submit" class="btn btn-green px-2 py-0 fs-4 w-100">INVIA</button>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endauth