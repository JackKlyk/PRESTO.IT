<div class="container-fluid pb-4 pb-md-5">
    <h1 class="text-center mb-4 pt-md-5 fw-bold">{{__('ui.editAnnouncement')}}</h1>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <form class="p-4 p-md-5 shadow rounded" wire:submit.prevent="update" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" wire:model="announcement.title" placeholder="{{__('ui.title')}}">
                    <label for="title" class="form-label">{{__('ui.title')}}</label>
                    @error('title')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <select class="form-select mb-3 capitalize" aria-label="Default select example" id="category_id"
                wire:model="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $announcement->category->id) selected @endif class="capitalize">
                        @if (Lang::locale() == 'it') {{$category->name_it}} @elseif (Lang::locale() == 'eng') {{$category->name_en}} @elseif (Lang::locale() == 'es') {{$category->name_es}} @endif
                    </option>
                @endforeach
            </select>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="description" wire:model="announcement.description" placeholder="{{__('ui.description')}}">
                    <label for="description" class="form-label">{{__('ui.description')}}</label>
                    @error('description')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="price" step="0.01" wire:model="announcement.price" placeholder="{{__('ui.price')}}">
                    <label for="price" class="form-label">{{__('ui.price')}}</label>
                    @error('price')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <input wire:model="temporary_images" type="file" name="images" multiple
                        class="form-control shadow @error('temporay_images.*') is-invalid"@enderror placeholder="img" />
                    @error('temporary_images.*')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>
                @if (!empty($images) || (!empty($imagesFromDb)))
                    <div class="row mb-4">
                        <div class="col-12">
                            <p>Immagini in Anteprima</p>
                            <div class="row rounded shadow py-4 mx-1">
                                @foreach ($images as $key => $image)
                                    <div class="col px-0">
                                        <div class="img-preview mx-auto shadow rounded"
                                            style="background-image: url({{ $image->temporaryUrl() }});"></div>
                                        <button type="button"
                                            class="btn btn-red shadow d-block text-center mt-2 mx-auto"
                                            wire:click="removeImage({{ $key }})">Cancella
                                    </div>
                                @endforeach
                                @if (!empty($imagesFromDb))
                                @foreach ($imagesFromDb as $key => $image)
                                <div class="col px-0">
                                    <div class="img-preview mx-auto shadow rounded"
                                        style="background-image: url({{ $image->getUrl() }});"></div>
                                    <button type="button"
                                        class="btn btn-red shadow d-block text-center mt-2 mb-3 mx-auto"
                                        wire:click="removeImageFromDb({{ $key }})">Cancella
                                </div>
                                @endforeach

                                    @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <button type="submit" class="btn btn-red btn-lg px-5 w-100 fw-semibold">{{__('ui.update')}}</button>
            </form>
        </div>
    </div>
</div>

