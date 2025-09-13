<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>
    Create a Teacher
  </p>
  <form action="{{route ('teachers.store')}}" method="post">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{old ('name')}}"><br><br>

    <label for="mobile"> mobile:</label>
    <input type="text" id="mobile" name="mobile" value="{{old ('mobile')}}"><br><br>

    <label for="address">address:</label>
    <input type="address" id="address" name="address" value="{{old ('address')}}"><br><br>

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