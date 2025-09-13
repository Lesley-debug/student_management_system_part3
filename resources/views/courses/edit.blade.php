<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <p>edit a Course</p>

    <form method="POST" action="{{route('courses.update', $course->id)}}">
    @csrf
    @method ('PUT') <!-- tells laravel to treat this as a PUT request 
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $course->name)}}"><br><br>

    <label for="syllabus"> syllabus:</label>
    <input type="text" id="syllabus" name="syllabus" value="{{old('syllabus', $course->syllabus)}}"><br><br>

    <label for="duration">duration:</label>
    <input type="number" id="duration" name="duration" value="{{old ('duration', $course->duration)}}"><br><br>

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