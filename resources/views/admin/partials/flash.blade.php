@if($errors->any())
   <div class="alert alert-danger" role="alert">
      <strong>Whoops!</strong>
      There are some problem with your input<br><br>
      <ul>
         @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif

@if(session('success'))
   <div class="alert alert-success" role="alert">{{ session('success') }}</div>
@endif

@if(session('error'))
   <div class="alert alert-success" role="alert">{{ session('error') }}</div>
@endif