@extends('layouts.app')

@section('content')
    {{-- <script>

  const array = []
</script> --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width:150%;margin-left:-160px;">
                    <div class="card-header" style="display: flex; justify-content:space-between">
                        <div>
                            <h3>Welcome to BlogPost</h3>
                        </div>
                        {{-- <div class="btn-group" style="margin-left:40em;">
                      <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btn">
                        Category
                      </button>
                        <ul class="dropdown-menu" id="category" name="category">
                          <!-- dropdown menu links -->
                          @foreach ($categories as $category)
                          <li id="category" class="dropdown-item"><a href="{{route('home/cat',$category['id'])}}" style="color:black;">{{$category->title}}</a></li>
                          @endforeach

                        </ul>

                        <div class="form-group">
                          <select name="" id="" style="display:{{request()->is('/') ? 'none' : ''}}">
                            @foreach ($categories as $category)
                            <option value="" {{request()->id == $category->id ? 'selected disabled' : ''}}>{{$category->title}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div> --}}
                        <div class="form-group" style="margin-left:40em;">

                            <label for="category">Category</label>

                            <select class="form-control" id="category" name="category" onchange="handleSelect(event)">
                                <option selected disabled>--Select Category--</option>
                                @foreach ($categories as $category)
                                    <a href="{{ route('home.cat', $category->id) }}">
                                        <option value={{ $category->id }} {{-- {{isset($cat)? $cat : ''}} --}} {{-- selected --}}
                                            {{ isset($cat) ? ($cat === $category->id ? 'selected' : '') : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    </a>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="card-deck" id="card" style="">
                            @foreach ($posts as $post)
                                <div class="col-md-4">

                                    <a href="{{ route('page', $post->id) }}"><img
                                            src="{{ asset('/storage/images/' . $post->image) }}" class="card-img-top"
                                            alt="..." id="post_image" style="width:350px;height:400px;">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ route('page', $post->id) }}" style="color:black;"><b>
                                                <h3 id="post_title">{{ Str::limit($post->title, 20) }}</h3>
                                            </b> </a>

                                    {{-- <img src="{{ asset('/storage/images/' . $post->image) }}" class="card-img-top"
                                        alt="..." id="post_image" style="width:350px;height:400px;">
                                    <div class="card-body">
                                        <b>
                                            <h3 id="post_title">{{ Str::limit($post->title, 20) }}</h3>
                                        </b> --}}

                                        <p class="card-text" id="post_desc">
                                            {{ ucfirst(Str::limit($post->description, 100)) }}<span><a
                                                    href="{{ route('page', $post->id) }}">See more</a></span></p>
                                    </div>
                                    <div class="card-footer" style="display:  flex; align-items: center">
                                        <div class="image">
                                            <img src="{{ asset('storage/images/' . $post->author->image) }}"
                                                class="img-circle elevation-2" style="height:35px;width:35px;"
                                                alt="User Image" id="author_image">
                                        </div>
                                        <p style="margin:0px; margin-left:30px" id="author_name">{{ $post->author->name }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-deck" id="card-deck" style="">

                        </div>

                    </div>
                    <ul class="pagination justify-content-center">
                        {!! $posts->links('pagination::bootstrap-4') !!}
                    </ul>
                </div>
            </div>


            <script>
                function handleSelect(event) {
                    var id = event.target.value;
                    var base_url = window.location.origin;
                    window.location = `${base_url}/home/categories/${id}`;

                }
            </script>



            {{-- ////////////////ajax call simple value passing////////////// --}}
            {{-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>

  jQuery(document).ready(function() {
    jQuery('#category').change(function() {
       let category_id = jQuery(this).val();
       console.log(category_id);
       jQuery.ajax({
        url:'/getCategory',
        type:'post',
        data:'category_id='+category_id+
        '&_token={{csrf_token()}}',
        success:function(data){
          var _html='';
          var images="{{ asset('storage/images/') }}/";
          // console.log(data);
          $('#card').hide();
          // jQuery('#post_title').html(data);

          jQuery.each(data.posts, function(key, val){
            console.log(val.title);
            _html+='<div class="card ajx" id="new">';
              _html+='<img src='+images+val.image+' class="card-img-top">';
              _html+='<div class="card-body">';
                _html+='<h3 class="card-title">'+val.title+'</h3>';
                 _html+='<p class="card-text">'+val.description+'</p>';
                 _html+='</div>';

                  _html+='</div>';

              //     _html =`<div class="card">
              // <img src="${image+val.image}" class="card-img-top">
              // <div class="card-body">
              //   <h3 class="card-title">${val.title}</h3>
              //    <p class="card-text">${val.description}</p>
              //    </div>
              //     </div>`

        });
        jQuery(".ajx").remove();
        jQuery("#card-deck").append(_html);




      }
       });
    });
  });

</script> --}}
        @endsection
