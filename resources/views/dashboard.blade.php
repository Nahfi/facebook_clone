
        @extends("fblayout.main")
        @section("main")
        
             
                <div class="col-sm-6">
                    <div class="post col-sm-12" id="new_post">
                        <div class="row post-heading" style="background: #2d9a40;">
                            <div class="col-sm-12">
                                <h4 id="post-header">Create New Post</h4><br/>

                            </div>
                        </div>
                        <div class="row" style="padding: 10px;">
                                {{-- {{  Auth::user()->post}} --}}
                            <form action="{{ route("post.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" >
                                <textarea name="post" placeholder="Whats up?" maxlength="250"></textarea>
                            </div>
                            <div class="form-group" >
                              <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                          
                            </div>
                            <br>
                            <div class="">
                                <div class="pull-left form-group">
                                <label class="btn btn-success"><input name="image" type="file" style="display: none;"/>Add Image</label>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-primary">POST</button>
                            </div>

                            </form>
                        
                            <br>
                        </div>

                    </div>
                  
              



             @foreach ($p as $post )
        {{-- {{ $post['com'] }} --}}
                 
                    <div class="post col-sm-12" id="post_2">
                        <div class="row post-heading">
                            <div class="col-sm-12">
                                <a href="{{ route('post.show',$post['info']->id )}}">
                                    <img src="{{ asset($post['info']->photo) }}" class="profile-picture pull-left"/>
                                    &nbsp;
                                    <span class="post-user-name">{{ $post['info']->fname." ".$post['info']->lname }}</span><br/>
                                    &nbsp;
                                    <small class="post-date text-mute">{{ $post['date'] }}</small>
                                </a>
                            </div>
                        </div>
                        <div class="row post-body">
                            <div class="col-sm-12">
                                 {{$post['post']}}
                            </div>
                            <div class="col-sm-12">
                                @if (!$post['photo'])
                                
                                @else
                                <img src="{{ asset($post['photo']) }}" style="height="300px" width="300px"" alt="">
                                @endif
                            
                            </div>
                        </div>
                        <div class="row post-action">
                            <ul class="post-action-menu">
                                <li><a href="javascript:void(0);" class="text-mute" onclick="like({{$post['id'] }});">Like</a></li>
                                <li><a href="javascript:void(0);" class="text-mute" onclick="share({{$post['id'] }});">Share</a></li>
                                <li><a href="javascript:void(0);" class="text-mute" onclick="comment({{$post['id'] }});">Comment</a></li>
                               
                           

                                <li class="pull-right"><a href="#" class="text-mute"><span id="post_like_count_{{$post['id'] }}">{{$post["like"] }}</span> Likes</a></li>
                                <li class="pull-right"><a href="#" class="text-mute"><span id="post_share_count_{{$post['id'] }}">{{ $post['share'] }}</span> Shares</a></li>
                                <li class="pull-right"><a href="#" onclick="comment({{$post['id'] }});" class="text-mute"><span id="post_comment_count_{{$post['id'] }}">{{ $post['comment'] }}</span> Comments</a></li>
                 
                            </ul>
                        </div>
                        <div class="row post-comment" >
                            
        @foreach ($post['com'] as $c )
                          <div class="col-sm-11 p p_{{$post['id'] }}" id="post_comment_{{$post['id'] }}">
                                <a href="profile.html">
                                    <img src="{{ $c->user_c->photo }}" class="profile-picture-small pull-left"/>   <span class="post-user-name">{{ $c->user_c->fname }}</span>
                                </a>
                              {{ $c->comment }}
                            </div>
        
            
        @endforeach
                            
                            <form action="{{ route('comment') }}" method="POST"  >
                                @csrf
                                <div class="col-sm-1 form-group">
                                    <a href="">
                                        <img src="{{ asset(Auth::user()->photo) }}" class="profile-picture-small pull-left"/>
                                    </a>
                                </div>
        
                                <div class="col-sm-9 form-group">
                                    <textarea rows="1" name="comment" class="comment-text" placeholder="Add Comment" oninput="auto_height(this)"></textarea>
                                </div>
        
                                <div class="col-sm-1 form-group">
                                    <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                    <button type="submit" class="btn btn-success btn-xs">Comment</button>
                                </div>
                            </form>
        
        
                        </div>
                    </div>
                   
             @endforeach
   
                </div>
              
                  
               
       
        @endsection
      @push("script")
      <script type="text/javascript">





function like(id) {

    var elem = document.getElementById("post_like_count_" + id);
    var count = parseInt(elem.innerHTML);
  


    $.ajaxSetup({

        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')

        }

    })
    $.ajax({


        url: "/like",
        method:"post",
     
        dataType:"json",
        data:{
            "d": id
        },
   

    }).done((p) => {
    
      console.log(p)
        elem.innerHTML = count + p.data;
    highlight(elem);

    })




   
}





        function share(id){
            var elem = document.getElementById("post_share_count_"+id);
            var count = parseInt(elem.innerHTML);
            elem.innerHTML = count+1;
            highlight(elem);
        }
        $(".p").hide()
        function comment(id){

          $(".p_"+id).toggle()
       
        }
        function highlight(elem){
            elem.style.color = "red";
            elem.parentElement.parentElement.style.transform="scale(1.5)";
            setTimeout(function(){
                elem.style.color="";
                elem.parentElement.parentElement.style.transform="scale(1)";
            },300);
        }
    </script>
      @endpush