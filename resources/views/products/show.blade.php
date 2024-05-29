<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('products/cdn')
    <title>Document</title>
</head>
<body>
   <h1>Show products</h1> 
   <h1>{{$product->name}}</h1> 
   <h1>{{$product->description}}</h1> 
<img src="/products/{{$product->image}}" alt="not" />
</body>
</html>