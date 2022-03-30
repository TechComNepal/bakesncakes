@props([
    'col' => 3,
    'team' => null,
])

<div class="col-xl-3 col-sm-6 team-cards">
    <div class="card text-center">
        <div class="card-body">
            <div class="dropdown text-end">
                <a class="text-muted dropdown-toggle font-size-16" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateModalStatic-{{$team->id}}">Edit</a>
                    <a class="dropdown-item" id="delete-btn" data-id="{{$team->id}}">Remove</a>
                </div>
            </div>

            <div class="mx-auto mb-4">
                <img src="{{$team->getFirstOrDefaultMediaUrl('image', 'thumb')}}" alt="Team" class="avatar-xl rounded-circle">
            </div>
            <h5 class="font-size-16 mb-1"><a class="text-dark">{{$team->title}}</a></h5>
            <p class="text-muted mb-2">{{$team->designation}}</p>

        </div>
    </div>
</div>
