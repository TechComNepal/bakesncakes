<div class="profile-nav col-md-3">
    <div class="panel">
        <div class="user-heading round">
            <div class="user-heading-container">
                <a href="javascript:void(0);" style="position: relative;display: inline-block;">
                    <img src="{{ auth()->user()->getFirstOrDefaultMediaUrl('avatars', 'profile') }}" alt="">
                </a>

            </div>
            <h1 class="text-white text-uppercase"> <strong>{{ auth()->user()->username }}</strong></h1>
            <p class="text-white">{{ auth()->user()->email }}</p>
            <button type="button" class="ps-btn cmn-btn-outline" id="avatar-update-btn" data-bs-toggle="modal"
                data-bs-target="#avatarUpdate" title="Update Profile Picture">
                <i class="fa fa-edit"></i>
                Edit
            </button>
        </div>

        <ul class="nav nav-pills nav-stacked flex-column">
            <li class="@if (\Illuminate\Support\Facades\Route::currentRouteName() === 'user.dashboard') active @endif nav-item"><a class="nav-link"
                    href="{{ route('user.dashboard', auth()->user()->id) }}"> <i class="fa fa-dashboard"></i>
                    Dashboard </a></li>
            <li class="@if (\Illuminate\Support\Facades\Route::currentRouteName() === 'user.profiles.index') active @endif nav-item"><a class="nav-link"
                    href="{{ route('user.profiles.index', auth()->user()->id) }}"> <i class="fa fa-user"></i>
                    Profile</a></li>
            <li class="@if (\Illuminate\Support\Facades\Route::currentRouteName() === 'user.orders.show') active @endif nav-item"><a class="nav-link"
                    href="{{ route('user.orders.show') }}"> <i class="fa fa-edit"></i> Order <span
                        class="label label-warning pull-right r-activity">{{ auth()->user()->orders->count() }}</span></a>
            </li>

        </ul>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="avatarUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.profiles.change.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="file" class="dropify" name="avatar" id="profile-img" data-show-errors="true"
                        data-default-file="{{ auth()->user()->getFirstOrDefaultMediaUrl('avatars') }}" />
                    <button type="submit" class="btn btn-warning btn-lg text-white">Update Image</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <!-- dropify: page js file -->
    <script>
        $('#profile-img').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
