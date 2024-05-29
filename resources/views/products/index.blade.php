<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('products.cdn')
     <title>Document</title>
</head>
<body>
    <div class="container ">
        @if($meg= Session::get('success'))
        <p class="text-success">{{$meg}}</p>
        @elseif($meg= Session::get('error'))
        <p class="text-success">{{$meg}}</p>
        @endif
       <div class="d-flex justify-content-between">
        <h1>Products</h1>
        <a href="/product/create" class="btn btn-primary">Add Product</a>    
    </div> 
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
@foreach ($products as $item)
<tr>
    <th scope="row">{{$loop->index+1}}</th>
    <td><a href="/product/{{$item->id}}/show">{{$item->name}}</a></td>
    <td>{{$item->description}}</td>
    <td><img src="products/{{$item->image}}" alt="not" class="rounded-circle" width="30" height="30" /></td>
    <td class="d-flex ">
        <a href="/product/{{$item->id}}/edit" class="btn btn-outline-success">Edit</a>
        <form method="post" action="product/{{$item->id}}/delete" class="ms-2">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger">Delete</button>
        </form>
    </td>
  </tr>
@endforeach
          
          
        </tbody>
      </table>
      {{$products->links()}}
    </div>
</body>
</html>