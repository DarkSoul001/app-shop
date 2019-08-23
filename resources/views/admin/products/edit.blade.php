@extends('layouts.app')

@section('tittle','Bienvenido a App Shop')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
  <div class="container">

    <div class="section">
      <h2 class="title text-center">Modificar producto seleccionado</h2>
      
      <form method="POST" action="{{url('/admin/products/'.$product->id.'/edit')}}">
        {{csrf_field()}}
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Nombre del Producto</label>
              <input type="text" name="name" class="form-control" value="{{old('name',$product->name)}}" required="" minlength="3">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group label-floating">
              <label class="control-label">Precio del Producto</label>
              <input type="number" step="0.01" name="price" class="form-control" value="{{old('price',$product->price)}}" required="" min="0">
            </div>
          </div>
        </div>
        <div class="form-group label-floating">
          <label class="control-label">Descripción corta</label>
          <input type="text" name="description" class="form-control" value="{{old('description',$product->description)}}" required="" maxlength="200">
        </div>

        <div class="form-group label-floating">
          <textarea class="form-control" placeholder="Descripción extensa del producto" name="long_description" rows="5">{{old('long_description',$product->long_description)}}</textarea>
        </div>
        <button  class="btn btn-primary">Guardar Cambios</button>
        <a href="{{url('/admin/products')}}" class="btn btn-default">Cancelar</a>
      </form>
      
    </div>

  </div>
</div>

@include('includes.footer')
@endsection
