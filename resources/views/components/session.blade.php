@if (session('success')) 
    <div id="sessionSuccess" class="justify-content-center" style="display: flex;">
        <div class="text-center bg-success bg-opacity-25 rounded text-success mb-4 px-4 py-2 fs-4 fw-semibold">{{session('success')}}</div> 
    </div>
@elseif (session('edit'))
    <div id="sessionEdit" class="justify-content-center" style="display: flex;">
        <div class="text-center bg-warning bg-opacity-75 rounded text-light mb-4 px-4 py-2 fs-4 fw-semibold">{{session('edit')}}</div> 
    </div>
@elseif (session('delete'))
    <div id="sessionDelete" class="justify-content-center" style="display: flex;">
        <div class="text-center bg-danger bg-opacity-25 rounded text-danger mb-4 px-4 py-2 fs-4 fw-semibold">{{session('delete')}}</div> 
    </div>

@elseif (session('revisorSuccess'))
    <div id="sessionRevisorSuccess" class="justify-content-center align-items-center" style="display: flex;">
        <div class="text-center bg-success bg-opacity-25 rounded text-success mb-4 px-4 py-2 fs-4 fw-semibold">
            <form action="{{ Route('revisor.undo_announcement', ['announcement' => ' '])}}" method="POST">
                @csrf
                @method('POST')
                <h4 class="mb-0">{{session('revisorSuccess')}} {{__('ui.lastCheck')}}
                    <button class="btn btn-lg btn-red fw-semibold shadow">{{__('ui.cancel')}}</button>
                </h4>
            </form> 
        </div> 
    </div>

@elseif (session('revisorDelete'))
    <div id="sessionRevisorDelete" class="justify-content-center align-items-center" style="display: flex;">
        <div class="text-center bg-danger bg-opacity-25 rounded text-danger mb-4 px-4 py-2 fs-4 fw-semibold">
            <form action="{{ Route('revisor.undo_announcement', ['announcement' => ' '])}}" method="POST">
                @csrf
                @method('POST')
                <h4 class="mb-0">{{session('revisorDelete')}} {{__('ui.lastCheck')}}
                    <button class="btn btn-lg btn-red fw-semibold shadow">{{__('ui.cancel')}}</button>
                </h4>
            </form> 
        </div> 
    </div>
@endif