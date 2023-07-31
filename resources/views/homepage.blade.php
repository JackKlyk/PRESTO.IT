<x-main>
    <x-slot name="title">Presto.it | Homepage</x-slot>

    <x-session />

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 pe-md-4">
            <form class="d-flex mx-auto mb-5 input-group" action="{{ route('search') }}" method="POST">
                @method('POST')
                @csrf

                <input class="form-control rounded border-0 shadow w-auto mx-2 mx-md-0" id="search_announcement"
                    name="search_announcement" type="search" placeholder="{{__('ui.whatAreYouSearching')}}" list="datalistOptions">
                <datalist id="datalistOptions">
                    @foreach ($announcements as $announcement)
                        @if ($announcement->is_accepted)
                            <option value="{{ $announcement->title }}"></option>
                        @endif
                    @endforeach
                </datalist>
                <select class="form-select rounded border-0 shadow my-2 my-md-0 mx-2 mx-md-3 capitalize"
                    aria-label="Search Category" id="search_category" name="search_category" type="search">
                    <option selected>{{__('ui.allCategories')}}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" class="capitalize">
                            @if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif
                        </option>
                    @endforeach
                </select>
                <button
                    class="input-group-text btn btn-red rounded fw-semibold shadow px-4 my-2 my-md-0 me-2 me-md-0 w-auto"
                    type="submit">{{__('ui.search')}}<i class="bi bi-search ms-2"></i></button>

            </form>
        </div>
        @auth
            <div class="col-12 col-md-4 px-md-5">
                <a href="{{ route('announcements.create') }}" class="btn btn-light-orange w-100 fw-semibold shadow"><i
                        class="bi bi-plus-square"></i> {{__('ui.addAnnouncement')}}</a>
            </div>
        @endauth
    </div>



    <div class="row g-5 text-center align-items-center mt-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card pb-4 border-0 shadow">
                <img src="\img\macro_motori.png" class="card-img-top position-absolute w-50 bottom-50 start-25"
                    alt="">
                <div class="card-body mt-5 pt-5">
                    <a href="{{ route('macro', ['macro' => 'motori']) }}"
                        class="btn btn-lg btn-light-orange fw-semibold text-white mt-5 shadow">{{__('ui.searchInMotors')}}</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card pb-4 border-0 shadow">
                <img src="\img\macro_immobili.png" class="card-img-top position-absolute w-50 bottom-50 start-25"
                    alt="">
                <div class="card-body mt-5 pt-5">
                    <a href="{{ route('macro', ['macro' => 'immobili']) }}"
                        class="btn btn-lg btn-orange fw-semibold text-white mt-5 shadow">{{__('ui.searchInProperties')}}</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card pb-4 border-0 shadow">
                <img src="\img\macro_market.png" class="card-img-top position-absolute w-50 bottom-50 start-25"
                    alt="">
                <div class="card-body mt-5 pt-5">
                    <a href="{{ route('macro', ['macro' => 'market']) }}"
                        class="btn btn-lg btn-red fw-semibold text-white mt-5 shadow">{{__('ui.searchInMarket')}}</a>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center fw-bold mt-4 mb-0 fs-2">{{__('ui.lastAnnouncements')}}</h2>

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
            <div class="text-center mt-4 text-dark text-opacity-75"><em>{{__('ui.noAnnouncement')}}</em></div>
        @endforelse

    </div>

</x-main>
