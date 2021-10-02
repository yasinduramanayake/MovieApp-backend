<!DOCTYPE html>
<html>

<head>
    <title>YMP</title>
</head>

<body>
    <h1> All Movies </h1>

    <table border="1">
        <thead>
            <th>Movie Image</th>
            <th>Movie Name</th>
            <th>Movie Type</th>
            <th>Theater Description</th>
            <th>Theaters</th>


        </thead>
        <tbody>
            <tr>
            </tr>
            @foreach($data as $movies)
            <tr>
                <td><img src="{{$movies->image}}"></td>
                <td>{{$movies->name}}</td>
                <td>{{$movies->type}}</td>
                <td>{{$movies->description}}</td>
                <td>{{$movies->theaters}}</td>
                <td>{{count($data)}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>