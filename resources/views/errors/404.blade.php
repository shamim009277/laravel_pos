<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Custom 404 pages</title>
	<link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template text-center">
                <h2 style="font-size: 162px;">404</h2>
				<h2>Page Not Found</h2>
				<p>We are sorry,the page you request could not found.Please go to home page</p>
				<a href="{{URL::to('admin/home')}}" class="btn btn-info">View Homepage</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>