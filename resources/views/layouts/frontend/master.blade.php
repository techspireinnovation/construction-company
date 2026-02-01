<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
		<meta name="description" content="ConstBuild : Construction, Renovation & Building HTML Template" />
	<meta property="og:title" content="ConstBuild : Construction, Renovation & Building HTML Template" />
	<meta property="og:description" content="ConstBuild : Construction, Renovation & Building HTML Template" />
	<meta property="og:image" content="ConstBuild : Construction, Renovation & Building HTML Template" />
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('Website/images/favicon.png')}}" />

	<!-- PAGE TITLE HERE -->
	<title>ConstBuild : Construction, Renovation & Building HTML Template</title>

	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
@include('layouts.frontend.css')

@yield('style')

</head>

<body id="bg">
    <div id="loading-area"></div>
    <div class="page-wraper">
@include('layouts.frontend.header')


@yield('content')

@include('layouts.frontend.footer')
@include('layouts.frontend.js')
@yield('script')




</body>
</html>