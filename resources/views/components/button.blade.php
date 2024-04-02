@if($type=="button")
<a 
@elseif($type=="submit")
<input type="submit"
@else
{{--uh oh--}}
@endif
class="bg-slate-700 rounded p-3 text-white hover:bg-slate-500 active:bg-slate-400 active:translate-y-0.5 transition-all cursor-pointer select-none {{$css}}"
@if($type=="button")
@if($link != "") href="{{$link}}" @endif>
{{$slot}}
</a>
@elseif($type=="submit")
value="{{$slot}}">
@else
{{--uh oh--}}
@endif
