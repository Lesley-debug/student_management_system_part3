<!--<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>Edit teacher</h1>
  
  <form method="POST" action="{{route('teachers.update', $teacher->id)}}">
    @csrf
    @method ('PUT')  tells laravel to treat this as a PUT request 
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $teacher->name)}}"><br><br>

    <label for="mobile"> mobile:</label>
    <input type="number" id="mobile" name="mobile" value="{{old ('mobile', $teacher->mobile)}}"><br><br>

    <label for="address">address:</label>
    <input type="address" id="address" name="address" value="{{old ('address', $teacher->address)}}"><br><br>

    <input type="submit" value="Submit">
   
  </form>
  

  @if ($errors->any())
    <ul>
      @foreach ($errors ->All() as $error)
      <li>{{$error}}</li>
    @endforeach
    </ul>
  @endif
</body>
</html>
-->