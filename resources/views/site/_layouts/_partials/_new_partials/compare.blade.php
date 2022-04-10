 <a href="{{ route('compare.index') }}">
     <img class="svgInject" alt="Nest" src="{{ asset('new_frontend\assets\imgs\theme\icons\icon-compare.svg') }}">
     @if (\Illuminate\Support\Facades\Session::has('compare'))
         <span class="pro-count blue">{{ count(\Illuminate\Support\Facades\Session::get('compare')) }}</span>
     @else
         <span class="pro-count blue"> 0</span>
     @endif
 </a>
 <a href="{{ route('compare.index') }}"><span class="lable ml-0">Compare</span></a>
