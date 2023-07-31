<x-main>
    <x-slot name="title">Presto.it | {{__('ui.adminDashboard')}}</x-slot>

    <h1 class="text-center mb-4 fw-bold text-uppercase">{{__('ui.adminDashboard')}}</h1>

    <div class="d-flex justify-content-center">
        <button class="btn btn-light-orange fw-semibold mb-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#allAnnouncements" aria-expanded="false" aria-controls="allAnnouncements">
            {{__('ui.allAnnouncements')}}</button>
        <button class="btn btn-orange fw-semibold mb-3 fs-5 mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#allCategories" aria-expanded="false" aria-controls="allAnnouncements">
            {{__('ui.categories')}}</button>
        <button class="btn btn-red fw-semibold mb-3 fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#allUsers" aria-expanded="false" aria-controls="allAnnouncements">
            {{__('ui.allUsers')}}</button>
    </div>

    {{-- TUTTI GLI ANNUNCI --}}
    <div class="collapse show" id="allAnnouncements">
        <div class="container-fluid">
            <table class="table border mt-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center col-1 text-light bg-black">#</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">VISIBILITÀ</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">IMG</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">CATEGORIA</th>
                        <th scope="col" class="text-center col-3 text-light bg-black">TITOLO</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">AUTORE</th>
                        <th scope="col" class="col-4 text-light bg-black"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                    <tr class="align-middle">
                        <th scope="row" class="text-center">{{$announcement->id}}</th>
                        <th class="text-center">
                            @if($announcement->is_accepted)
                            <form action="{{ Route('admin.hidden', ['announcement' => $announcement])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn px-2 py-0"><i class="bi bi-eye fs-3 text-success"></i></button>
                            </form>
                            @elseif(!isset($announcement->is_accepted))
                            <a href="{{ Route('revisor.index') }}" class="btn px-2 py-0"><i class="bi bi-question fs-3 text-black"></i></a>
                            @else
                            <form action="{{ Route('admin.visible', ['announcement' => $announcement])}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn px-2 py-0"><i class="bi bi-eye-slash fs-3 text-danger"></i></button>
                            </form>
                            @endif
                        </th>
                        <td class="text-center"><img class="card-img max-vh-5"
                            src="{{!$announcement->images()->get()->isEmpty() ? $announcement->images()->first()->getUrl(600,600) : '/img/presto.it_placeholder.jpg'}}"
                            alt=""></td>
                        <td class="text-center text-uppercase fw-bold">
                            @if (Lang::locale() == 'it') {{$announcement->category->name_it}} @elseif (Lang::locale() == 'eng') {{$announcement->category->name_en}} @elseif (Lang::locale() == 'es') {{$announcement->category->name_es}} @endif
                        </td>
                        <td class="text-center">{{$announcement->title}}</td>
                        <td class="text-center">{{$announcement->user->name}}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                @if (isset($announcement->is_accepted)) 
                                <a href="{{route('announcements.show', ['announcement' => $announcement->id])}}"
                                class="btn btn-primary me-md-2"><i class="bi bi-search"></i></a>
                                @endif
                                    
                                <a href="{{route('announcements.edit', ['announcement' => $announcement])}}"
                                    class="btn btn-warning me-md-2"><i class="bi bi-pencil-square"></i></a>

                                <form action="{{route('announcements.destroy', ['announcement' => $announcement])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-red text-white"><i class="bi bi-trash"></i></button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <td colspan="12" class="text-center mt-4 text-dark text-opacity-75"><em>{{__('ui.noAnnouncement')}}</em></td>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>

    {{-- TUTTE LE CATEGORIE --}}
    <div class="collapse" id="allCategories">
        <div class="container-fluid">
            <table class="table border mt-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center col-1 text-light bg-black">#</th>
                        <th scope="col" class="text-center col-3 text-light bg-black">MACRO</th>
                        <th scope="col" class="text-center col-4 text-light bg-black">CATEGORIA</th>
                        <th scope="col" class="col-4 bg-black text-end"><a href="{{route('categories.add')}}"
                            class="text-white text-decoration-none fw-semibold me-md-2"><i class="bi bi-plus-square me-2"></i>AGGIUNGI CATEGORIA</a></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr class="align-middle">
                        <th scope="row" class="text-center">{{$category->id}}</th>
                        <td class="text-center text-capitalize">{{$category->macro}}</td>
                        <td class="text-center"><button class="btn @if ($category->macro == 'motori') btn-light-orange @elseif ($category->macro == 'immobili') btn-orange @elseif ($category->macro == 'market') btn-red @endif text-white text-uppercase fw-bold"> @if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif </button></td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">                                
                                <a href="{{route('categories.edit', ['category' => $category])}}"
                                    class="btn btn-warning me-md-2"><i class="bi bi-pencil-square"></i></a>

                                <form action="{{route('categories.destroy', ['category' => $category])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-red text-white"><i class="bi bi-trash"></i></button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <td colspan="12" class="text-center mt-4 text-dark text-opacity-75"><em>{{__('ui.noCategories')}}</em></td>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- TUTTI GLI UTENTI --}}
    <div class="collapse" id="allUsers">
        <div class="container-fluid">
            <table class="table border mt-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center col-1 text-light bg-black">#</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">IMG</th>
                        <th scope="col" class="text-center col-2 text-light bg-black">USERNAME</th>
                        <th scope="col" class="text-center col-2 text-light bg-black">EMAIL</th>
                        <th scope="col" class="text-center col-1 text-light bg-black">TELEFONO</th>
                        <th scope="col" class="text-center col-2 text-light bg-black">DATA DI NASCITA</th>
                        <th scope="col" class="text-center col-2 text-light bg-black">STATO REVISORE</th>
                        <th scope="col" class="col-1 bg-black text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="align-middle">
                        <th scope="row" class="text-center">{{$user->id}}</th>
                        <td class="text-center"><img class="card-img max-vh-5"
                            src="@if ($user->gender == 'Femmina') 
                            {{empty($user->img) ? '/img/female-placeholder.jpg' : Storage::url($user->img)}}
                        @elseif ($user->gender == 'Maschio') 
                            {{empty($user->img) ? '/img/male-placeholder.jpeg' : Storage::url($user->img)}}
                        @elseif ($user->gender == 'Non binario' || $user->gender == 'Non specificato')
                            {{empty($user->img) ? '/img/user-placeholder.png' : Storage::url($user->img)}}
                        @endif"
                            alt=""></td>
                        <td class="text-center fw-bold">@if ($user->is_admin) <i class="bi bi-shield-lock-fill text-danger me-1"></i> @elseif ($user->is_revisor) <i class="bi bi-clipboard-data-fill text-success me-1"></i> @endif {{$user->name}} </td>
                        <td class="text-center">{{$user->email}}</td>
                        <td class="text-center">{{$user->phone}}</td>
                        <td class="text-center">{{ isset($user->birthday) ? $user->birthday->format('d-m-Y') : '- - -' }}</td>
                        <td class="text-center">
                            @if ($user->email == "admin@mail.com" || $user->id == Auth::user()->id || $user->is_admin)
                                
                            @else

                                @if ($user->is_revisor)
                                        <a href="{{route('dismiss.revisor', compact('user'))}}"
                                        class="btn btn-outline-danger me-md-2 fw-semibold"><i class="bi bi-x-octagon me-2"></i>Licenzia</a>
                                @elseif (!$user->is_revisor)
                                        <a href="{{route('make.revisor', compact('user'))}}"
                                        class="btn btn-outline-green me-md-2 fw-semibold"><i class="bi bi-shield-lock me-2"></i>Rendi Revisore</a>
                                @endif
                                                        
                            @endif
                        </td>
                        <td>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            
                                <form action="" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-red text-white"><i class="bi bi-trash"></i></button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <td colspan="12" class="text-center mt-4 text-dark text-opacity-75"><em>{{__('ui.noUsers')}}</em></td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-session />


</x-main>