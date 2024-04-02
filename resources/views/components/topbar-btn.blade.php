<div class="inline-flex flex-col justify-center mx-6">
   @if($action == "")
   <a
   @else 
   <form method="POST" action="{{$action}}">
      @csrf
      <input type="submit" value="{{$slot}}"
   @endif 
   class="text-black font-semibold  @if($link != "" || $action != "") cursor-pointer" @if($link != "") href="{{$link}}" @endif @else cursor-default" @endif>
   @if($action == "")
      {{$slot}}
   </a>
   @else
   </form>
   @endif
</div>
