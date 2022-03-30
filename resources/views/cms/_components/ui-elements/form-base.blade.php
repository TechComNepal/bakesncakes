@props([
    'title' => 'Form',
    'route' => '#',
    'method' => 'POST',
    'requiredParam' => null,
    'hasTitle' => true,
    'subTitle' => null,
    'id'=>null,
])

<div class="row">
    <div class="col-lg-12">
        <div {{ $attributes->merge(['class' => 'card']) }}>
            <div class="card-header">
                @if($hasTitle !== false)
                    <h4 class="card-title mb-0">{{\Illuminate\Support\Str::singular($title)}} Form</h4>
                    @if($subTitle)
                        <p class="card-title-desc">{{$subTitle}}</p>
                    @endif
                @endif
            </div>
            <div class="card-body">
                <form
                    @if($method === 'POST') action="{{route($route, $requiredParam)}}" @endif
                    @if($method === 'PUT') action="{{route($route, $requiredParam)}}" @endif
                    @if($id) id="{{$id}}" @endif
                    method="POST"
                    enctype="multipart/form-data"
                    class="needs-validation"
                    novalidate
                >
                    @csrf
                    @method($method)

                    <div class="row">
                        {{$slot}}
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
