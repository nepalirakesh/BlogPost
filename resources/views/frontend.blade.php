@include('bloglayout.header')
<div class="card-deck">
  <div class="card">
      <img src="{{asset('dist/img/blog.jpg')}}" style="width:100%;height:18rem;" alt="...">
    <div class="card-body">
     <b> <h3 >Card title</h3></b>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer" style="display: flex; align-items: center">
          <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="height:35px;width:35px;" alt="User Image">
          </div>
           <p style="margin:0px; margin-left:30px">{{Auth::user()->name}}</p>
        </div>
  </div>
  <div class="card">
    <img src="{{asset('dist/img/space.jpg')}}" style="width:100%;height:18rem;" alt="...">
    <div class="card-body">
     <b> <h3 >Card title</h3></b>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer" style="display: flex; align-items: center">
          <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="height:35px;width:35px;" alt="User Image">
          </div>
           <p style="margin:0px; margin-left:30px">{{Auth::user()->name}}</p>
        </div>
  </div>
  <div class="card">
    <img src="{{asset('dist/img/nature.jpg')}}" style="width:100%;height:18rem;" alt="...">
    <div class="card-body">
     <b> <h3 >Card title</h3></b>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
    <div class="card-footer" style="display: flex; align-items: center">
          <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" style="height:35px;width:35px;" alt="User Image">
          </div>
           <p style="margin:0px; margin-left:30px">{{Auth::user()->name}}</p>
        </div>
  </div>
</div>