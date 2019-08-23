@extends('layouts.app')

@section('tittle','Imagenes de Productos')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

</div>

<div class="main main-raised">
  <div class="container">

    <div class="section text-center">
      <h2 class="title">Imagenes del producto "{{$product->name}}"</h2>
      <form method="POST" action="" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="file" name="photo" required="">
        <button type="submit" class="btn btn-primary btn-round">Subir nueva imagen</button>
        <a href="{{url('/admin/products')}}" class="btn btn-default btn-round">Volver al listado de productos</a>
      </form>
      <hr>
      <div class="row">
        @foreach($images as $image)
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-body">
              <img src="{{$image->image}}" style="width: 250px; height: 250px;">
              <input type="hidden" name="image_id" value="{{$image->id}}">

              <form method="POST" action="" style="display: inline-block;">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button type="submit" class="btn btn-danger btn-round">Eliminar imagen</button>
              </form>
              @if($image->featured)
              @else
                <form method="POST" action="{{url('/admin/products/'.$product->id.'/images/featured/'.$image->id)}}" style="display: inline-block;">
                  {{csrf_field()}}
                  <button class="btn btn-primary btn-fab btn-fab-mini btn-round">
                    <i class="material-icons">favorite</i>
                  </button>
                </form>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</div>

@include('includes.footer')
@endsection
