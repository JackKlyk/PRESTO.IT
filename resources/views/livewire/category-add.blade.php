<div class="container-fluid pb-4 pb-md-5">
    <h1 class="text-center mb-4 pt-md-5 fw-bold">{{__('ui.addCategory')}}</h1>
    <x-session />
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <form class="p-4 p-md-5 shadow rounded" wire:submit.prevent="add">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_it" wire:model="name_it"
                        placeholder="{{__('ui.category_it')}}">
                    <label for="name_it" class="form-label">{{__('ui.category_it')}}</label>
                    @error('name_it')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_en" wire:model="name_en"
                        placeholder="{{__('ui.category_en')}}">
                    <label for="name_en" class="form-label">{{__('ui.category_en')}}</label>
                    @error('name_en')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name_es" wire:model="name_es"
                        placeholder="{{__('ui.category_es')}}">
                    <label for="name_es" class="form-label">{{__('ui.category_es')}}</label>
                    @error('name_es')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <select class="form-select mb-3 capitalize" aria-label="Default select example" id="macro"
                    wire:model="macro" required>
                    <option selected>{{__('ui.selectMacro')}}</option>
                    
                    <option value="motori" class="capitalize">
                        {{__('ui.motors')}}
                    </option>
                    <option value="immobili" class="capitalize">
                        {{__('ui.properties')}}
                    </option>
                    <option value="market" class="capitalize">
                        {{__('ui.market')}}
                    </option>
                    
                </select>

                <button type="submit"
                    class="btn btn-red btn-lg px-5 w-100 fw-semibold">{{ __('ui.createCategory') }}</button>
            </form>
        </div>
    </div>
</div>