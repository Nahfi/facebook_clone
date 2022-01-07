

@php
   
  $p=App\Models\User::where('id','!=',Auth::user()->id)->get();
  $time=now()->addMinutes(-3);
  $active=App\Models\User::where('last_login_time','>=',$time)->pluck('id')->toArray();
@endphp 





<div class="col-sm-3 chat-users">
    <div class="row">
        <h3>Chat</h3>
       
    </div>
    <div class="row">
        @foreach ($p as $u)
        <div class="col-sm-12 chat-user 
        @if (in_array($u->id, $active))
          online  
        @endif
        
        ">
            <a href="#">
                <img src="{{ asset($u->photo) }}" class="pull-left"/>
                &nbsp;
                {{ $u->fname }}
            </a>
        </div>
        @endforeach
        
      
    </div>
</div>