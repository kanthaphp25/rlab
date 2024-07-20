<!DOCTYPE html>
<html lang="en">
@include('layout.adminheader')
<body>
<header>
  <h2>Admin site</h2>
</header>

<section>
  <nav>
    <ol>
      <li><a href="{{ url('/productsdashboard') }}">Products</a></li>
      <li><a href="{{ url('/salesorderlist') }}">Sales Orders</a></li>
      <li><a href="{{url('/createproduct')}}" >Create Product</a></li>
      <li><a href="{{url('/')}}" >Logout</a></li>
    </ol>
  </nav>
@yield('content')
</section>
@yield('formcontent')

</body>
</html>

