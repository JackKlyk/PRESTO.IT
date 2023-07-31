<x-main>
    <x-slot name="title">Presto.it | {{ $announcement->title }}</x-slot>

    <x-session />

    <div class="row g-5 mt-md-2 mb-5">
        <div class="col-12 col-md-6">
            <div class="card border-0 shadow">
                <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">
                    @if (count($announcement->images) > 0)
                    <div id="showCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            @foreach ($announcement->images as $image)
                                <div class="carousel-item @if ($loop->first)active @endif" @if ($loop->first)data-bs-interval="10000" @endif>
                                    <img src="{{$image->getUrl(600,600)}}" class="d-block w-100" alt="">
                                </div>
                            @endforeach
                        </div>                           
                        <button class="carousel-control-prev" type="button" data-bs-target="#showCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#showCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                    @else
                        <img src="/img/presto.it_placeholder_center.jpg" class="rounded" alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 d-flex h-100 justify-content-between">
                @if (Auth::user() !== null && Auth::user()->id == $announcement->user_id)
                    <a class="btn btn-dark text-white position-absolute top-0 end-0 mt-2 me-0 shadow opacity-50 px-2 py-1"
                        href="{{ route('announcements.edit', ['announcement' => $announcement]) }}"><i
                            class="bi bi-pencil"></i></a>
                @endif
                @if (Auth::user() !== null && Auth::user()->id !== $announcement->user_id)
                    @if ($announcement->users->contains(Auth::user()->id))
                        <i class="bi bi-suit-heart-fill fs-3 text-danger position-absolute top-0 end-0 mt-0 me-0"></i>
                    @endif
                @endif
                <div>
                    <h2 class="fw-bold fs-1 w-75 mb-3">{{ $announcement->title }}</h2>
                    <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif fit-content text-capitalize fw-semibold text-white shadow"
                        href="{{ route('categories.show', ['category' => $announcement->category_id]) }}">

                        @if (Lang::locale() == 'it') {{$announcement->category->name_it}} @elseif (Lang::locale() == 'eng') {{$announcement->category->name_en}} @elseif (Lang::locale() == 'es') {{$announcement->category->name_es}} @endif</a>

                    <p class="mb-0 fw-semibold fs-5 mt-3 mt-md-5">{{__('ui.price')}}</p>
                    <p class="mb-0 fw-bold fs-2" style="color: var(--grey); margin-top: -0.5rem;">€
                        {{ number_format($announcement->price, 2, ',', ' ') }}</p>
                </div>

                <div>
                    <p class="mb-0 fw-light mb-3">{{__('ui.publishedOn')}} {{ $announcement->created_at->format('d-m-Y') }}</p>

                    <div class="card border-0 shadow px-4 py-3">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <p class="fs-4 fw-semibold mb-1"><img
                                        class="card-img max-vh-4 mx-2 rounded-circle w-auto"
                                        style="clip-path: circle(50%)"
                                        src="@if ($announcement->user->gender == 'Femmina') {{ empty($announcement->user->img) ? '/img/female-placeholder.jpg' : Storage::url($announcement->user->img) }}
                                    @elseif ($announcement->user->gender == 'Maschio') 
                                        {{ empty($announcement->user->img) ? '/img/male-placeholder.jpeg' : Storage::url($announcement->user->img) }}
                                    @elseif ($announcement->user->gender == 'Non binario' || $announcement->user->gender == 'Non specificato')
                                        {{ empty($announcement->user->img) ? '/img/non-binary-placeholder.png' : Storage::url($announcement->user->img) }} @endif"
                                        alt="">
                                    <span class="fw-bold d-inline-block"> {{ $announcement->user->name }}</span>
                                </p>
                                <p class="fs-5 ms-3 mb-3 mb-md-0"><span class="fw-bold fs-4 me-1">
                                        {{ $announcement->user->announcementCount() }} </span> {{__('ui.onlineAnnouncements')}}</p>
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-end">
                                <a class="btn btn-lg btn-primary shadow fw-semibold w-100"
                                    href="tel:{{ $announcement->user->phone }}">{{__('ui.contact')}} <i
                                        class="bi bi-telephone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center fw-bold mt-4 mb-0 fs-1">{{__('ui.description')}}</h2>
    <p class="text-center px-md-5 mx-md-5 my-3">{{ $announcement->description }}</p>


    <h2 class="text-center fw-bold mt-5 mb-0 fs-2">{{__('ui.lastAnnouncements')}}</h2>

    <div class="row g-4 mt-1">
        @forelse ($announcements as $announcement)
            @if ($announcement->is_accepted)
                <div class="col-12 col-md-3">
                    <div class="card border-0 shadow h-100">
                        <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-capitalize fw-semibold text-white position-absolute mt-3 ms-3 shadow"
                            href="{{ route('categories.show', ['category' => $announcement->category_id]) }}">
                            @if (Lang::locale() == 'it') {{$announcement->category->name_it}} @elseif (Lang::locale() == 'eng') {{$announcement->category->name_en}} @elseif (Lang::locale() == 'es') {{$announcement->category->name_es}} @endif</a>
                        @if (Auth::user() !== null && Auth::user()->id == $announcement->user_id)
                            <a class="btn btn-dark text-white position-absolute top-0 end-0 mt-3 me-3 shadow opacity-50 px-2 py-1"
                                href="{{ route('announcements.edit', ['announcement' => $announcement]) }}"><i
                                    class="bi bi-pencil"></i></a>
                        @endif
                        @if (Auth::user() !== null && Auth::user()->id !== $announcement->user_id)
                            @if ($announcement->users->contains(Auth::user()->id))
                                <form action="{{ route('announcements.dislike', ['announcement' => $announcement->id]) }}" method="POST"> @csrf @method('PATCH')<button class="btn btn-red text-white position-absolute top-0 end-0 mt-3 me-3 shadow opacity-75 px-2 py-1"><i class="bi bi-suit-heart-fill"></i></button></form>
                            @else
                                <form action="{{ route('announcements.like', ['announcement' => $announcement->id]) }}" method="POST"> @csrf @method('PATCH')<button class="btn btn-dark text-white position-absolute top-0 end-0 mt-3 me-3 shadow opacity-75 px-2 py-1"><i class="bi bi-suit-heart-fill"></i></button></form>
                            @endif
                        @endif
                        <img src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(600,600) : '/img/presto.it_placeholder.jpg'}}" alt=""
                            class="card-img-top object-fit-cover position-center" height="180rem">
                        <div class="card-body">
                            <h5 class="fs-3 fw-bold mb-5">{{ $announcement->title }}</h5>
                            <p class=" position-absolute bottom-0 fs-4 fw-semibold" style="color: var(--grey);">€
                                {{ number_format($announcement->price, 2, ',', ' ') }}</p>
                            <a class="btn @if ($announcement->category->macro == 'motori') btn-light-orange @elseif ($announcement->category->macro == 'immobili') btn-orange @elseif ($announcement->category->macro == 'market') btn-red @endif text-white position-absolute bottom-0 end-0 mb-3 me-3 shadow"
                                href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}"><i
                                    class="bi bi-search"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center mt-4 text-dark text-opacity-75"><em>Nessun annuncio trovato...</em></div>
        @endforelse

    </div>



</x-main>
