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
    <div class="container">
        <h1>Edit Product</h1>
        @if($meg= Session::get('success'))
        <h1 class="text-success">{{$meg}}</h1cl>
        @endif
        <form method="post" action="/product/{{$product->id}}/update" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" value="{{old('name',$product->name)}}" aria-describedby="emailHelp">
              @if($errors->has('name'))
              <p class="text-danger">{{$errors->first('name')}}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" name="description" value="{{old('description',$product->description)}}" aria-describedby="emailHelp">
            @if($errors->has('description')) 
            <p class="text-danger">{{$errors->first('description')}}</p>
            @endif      
            </div>
            <div class="mb-3 form-check">
              <input type="file" class="form-control" name="image" value="{{old('image')}}">
                @if($errors->has('image'))
               <p class="text-danger">{{$errors->first('image')}}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
</body>
</html>