<x-main>
    <x-slot name="title">Presto.it | {{__('ui.profile')}} - {{ $user->name }}</x-slot>

    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-12 col-md-6 d-flex justify-content-center ps-0">
                <img class="card-img rounded shadow border-0" src="@if (Auth::user()->gender == 'Femmina') 
                {{empty(Auth::user()->img) ? '/img/female-placeholder.jpg' : Storage::url(Auth::user()->img)}}
            @elseif (Auth::user()->gender == 'Maschio') 
                {{empty(Auth::user()->img) ? '/img/male-placeholder.jpeg' : Storage::url(Auth::user()->img)}}
            @elseif (Auth::user()->gender == 'Non binario' || Auth::user()->gender == 'Non specificato')
                {{empty(Auth::user()->img) ? '/img/user-placeholder.png' : Storage::url(Auth::user()->img)}}
            @endif">
            </div>
            <div class="col-12 col-md-6 mt-5 mt-md-0 px-0 px-md-2 justify-content-center align-items-beetween">
                <div class="card border-0 d-flex justify-content-between ps-md-4">
                        <a class="btn btn-dark text-white position-absolute top-0 end-0 me-3 shadow opacity-50 px-2 py-1" href="{{ route('users.edit', ['user' => Auth::user()->id]) }}"><i class="bi bi-pencil"></i></a>


                    <h1 class="mb-3 fw-bold">{{ $user->name }}</h1>
                
                    <p class="mb-1 fs-5 fw-semibold"><i class="bi bi-envelope me-2"></i>{{ $user->email }}</p>
                    <p class="mb-3 fs-5 fw-semibold"><i class="bi bi-telephone me-2"></i>{{ $user->phone }}</p>

                    <p class="mt-2 fs-5 mb-1 fw-semibold"><i class="bi bi-@if (Auth::user()->gender == 'Femmina')gender-female @elseif (Auth::user()->gender == 'Maschio')gender-male @elseif (Auth::user()->gender == 'Non binario')gender-trans @elseif (Auth::user()->gender == 'Non specificato')circle @endif me-2"></i>{{ $user->gender }}</p>
                    <p class="mb-3 fs-5 fw-semibold"><i class="bi bi-calendar2-heart me-2"></i>{{ isset($user->birthday) ? $user->birthday->format('d-m-Y') : '- - -' }}</p>

                    <p class="mt-3 mb-2 text-dark text-opacity-75"><i class="bi bi-tags me-2"></i><em>{{ $user->announcementCount() }} {{__('ui.onlineAnnouncements')}}</em></p>

                    <a href="{{ route('announcements.create') }}" class="btn btn-lg btn-light-orange w-100 fw-semibold shadow fs-3 py-3"><i class="bi bi-plus-square"></i> {{__('ui.addAnnouncement')}}</a>
                    
                    @if (Auth::user()->is_revisor)
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <a href="{{ route('revisor.index') }}" class="btn btn-lg btn-green w-100 fw-semibold shadow fs-3 py-3 mt-3"><i class="bi bi-clipboard-data"></i> {{__('ui.revisorZone')}} @if ($user->toBeRevisionedCount() > 0) <span class="badge btn-red">{{ $user->toBeRevisionedCount() }}</span> @endif</a>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="bg-primary text-center rounded text-white w-100 fw-semibold shadow fs-3 py-3 mt-3"><i class="bi bi-piggy-bank me-2 fs-3"></i>{{ number_format($user->wallet, 2, ',', ' ') }}€</div>      
                            </div>
                        </div>
                    @endif

                    @if (Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-lg btn-red w-100 fw-semibold shadow fs-3 py-3 mt-3"><i class="bi bi-shield-lock"></i> {{__('ui.adminZone')}}</a>                      
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div id="like-annunci" class="col-12 justify-content-center align-items-center mb-5">
        <h2 class="text-center fw-bold mt-5 mb-4 fs-2">{{__('ui.likeAnnouncements')}}</h2>
        <div class="row g-3">
            @forelse ($user->announcements_liked as $announcement)
                @if ($announcement->is_accepted)
            <div class="col-12 col-md-3">
                <div class="card border-0 shadow h-100">
                    <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-capitalize fw-semibold text-white position-absolute mt-3 ms-3 shadow"
                         href="{{ route('categories.show', ['category' => $announcement->category_id]) }}">
                         @if (Lang::locale() == 'it') {{$announcement->category->name_it}} @elseif (Lang::locale() == 'eng') {{$announcement->category->name_en}} @elseif (Lang::locale() == 'es') {{$announcement->category->name_es}} @endif</a>
                    @if ($announcement->users->contains(Auth::user()->id))
                        <form action="{{ route('announcements.dislike', ['announcement' => $announcement->id]) }}" method="POST"> @csrf @method('PATCH')<button class="btn btn-red text-white position-absolute top-0 end-0 mt-3 me-3 shadow opacity-75 px-2 py-1"><i class="bi bi-suit-heart-fill"></i></button></form>
                    @else
                        <form action="{{ route('announcements.like', ['announcement' => $announcement->id]) }}" method="POST"> @csrf @method('PATCH')<button class="btn btn-dark text-white position-absolute top-0 end-0 mt-3 me-3 shadow opacity-75 px-2 py-1"><i class="bi bi-suit-heart-fill"></i></button></form>
                    @endif

                    <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(600,600) : '/img/presto.it_placeholder.jpg'}}" alt="" class="card-img-top object-fit-cover position-center" height="180rem">
                    <div class="card-body">
                        <h5 class="fs-3 fw-bold mb-5">{{ $announcement->title }}</h5>
                        <p class=" position-absolute bottom-0 fs-4 fw-semibold" style="color: var(--grey);">€ {{ number_format($announcement->price, 2, ',', ' ') }}</p>
                        @if ($announcement->is_accepted)
                            <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-white position-absolute bottom-0 end-0 mb-3 me-3 shadow"
                                href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}"><i class="bi bi-search"></i></a>                          
                        @endif
                    </div>
                </div>
            </div>
                                
            @endif  
            @empty
            <div class="text-center mt-4 text-dark text-opacity-75"><em>Nessun annuncio preferito trovato...</em></div>
            @endforelse
        </div>
    </div>


    <div id="my-annunci" class="col-12 justify-content-center align-items-center mb-5">
        <h2 class="text-center fw-bold mt-5 mb-4 fs-2">{{__('ui.myAnnouncements')}}</h2>
        <x-session />
        <div class="row g-3">
            @forelse ($user->announcements as $announcement)
                @if ($announcement->is_accepted || !isset($announcement->is_accepted) )
            <div class="col-12 col-md-3">
                <div class="card border-0 shadow h-100 @if($announcement->is_accepted == null) opacity-50 @endif">
                    <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-capitalize fw-semibold text-white position-absolute mt-3 ms-3 shadow"
                         href="{{ route('categories.show', ['category' => $announcement->category_id]) }}">
                         @if (Lang::locale() == 'it') {{$announcement->category->name_it}} @elseif (Lang::locale() == 'eng') {{$announcement->category->name_en}} @elseif (Lang::locale() == 'es') {{$announcement->category->name_es}} @endif</a>
                    @if (Auth::user() !== null && Auth::user()->id == $announcement->user_id && $announcement->is_accepted)
                        <a class="btn btn-dark text-white position-absolute top-0 end-15 mt-3 me-3 shadow opacity-75 px-2 py-1" href="{{ route('announcements.edit', ['announcement' => $announcement]) }}"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('announcements.destroy', ['announcement' => $announcement]) }}" method="POST"> @csrf @method('DELETE')<button class="btn btn-red text-white position-absolute top-0 end-0 mt-3 me-3 shadow px-2 py-1"><i class="bi bi-trash"></i></button></form>
                    @endif
                    <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(600,600) : '/img/presto.it_placeholder.jpg'}}" alt="" class="card-img-top object-fit-cover position-center" height="180rem">
                    <div class="card-body">
                        <h5 class="fs-3 fw-bold mb-5">{{ $announcement->title }}</h5>
                        <p class=" position-absolute bottom-0 fs-4 fw-semibold" style="color: var(--grey);">€ {{ number_format($announcement->price, 2, ',', ' ') }}</p>
                        @if ($announcement->is_accepted)
                            <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-white position-absolute bottom-0 end-0 mb-3 me-3 shadow"
                                href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}"><i class="bi bi-search"></i></a>                          
                        @endif
                    </div>
                </div>
            </div>
                                
            @endif  
            @empty
            <div class="text-center mt-4 text-dark text-opacity-75"><em>{{__('ui.noAnnouncement')}}</em></div>
            @endforelse
        </div>
    </div>

</x-main>