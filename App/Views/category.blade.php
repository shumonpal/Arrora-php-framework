<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
<h1>Wellcome</h1>
<h3>This is view from 'Category' controller.</h3>
	<ul>
		@foreach($cats as $cat)
        <li>
        	<p>{{$cat['name']}}</p>
        	<p>{{$cat['discribe']}}</p>
        </li>
       @endforeach
    </ul>
<h3>{{ hello() }}</h3>
</body>
</html>