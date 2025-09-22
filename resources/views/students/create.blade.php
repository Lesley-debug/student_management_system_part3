<!-- @extends('layouts.app')

@section('content')
<div class="container">
    
     <h1> Create a student</h1>
    
    <form action="{{route ('students.store')}}" method="post">
      @csrf
      <div class="form-group mb-3">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{old ('name')}}"><br><br>
      </div>

      <div class="form-group mb-3">
        <label for="mobile"> mobile:</label>
        <input type="number" id="mobile" name="mobile" value="{{old ('mobile')}}"><br><br>
      </div>

      <div class="form-group mb-3">
        <label for="address">address:</label>
        <input type="address" id="address" name="address" value="{{old ('address')}}"><br><br>
      </div>

      <input type="submit" value="Submit" class="btn btn-success">

    </form>

    @if ($errors->any())

    <ul>
      @foreach ($errors ->All() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>

    @endif
</div>
@endsection