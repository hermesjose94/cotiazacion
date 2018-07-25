@extends('main')

@section('title')
  Cargar Productos
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Sistema</a></li>
    <li class="active">Cargar Productos</li>
  </ol>
@endsection

@section('content')
  <div class="box">
    <div class="box-body">
      <div class="row">
        <div class="col col-sm-8">
          <a class="btn btn-success" role="button" data-toggle="collapse" href="#form0" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-plus"></i> Crear Productos</a>
        </div>
      </div>
      <div class="collapse" id="form0">
        <hr>
        <form method="POST" action="{{route('cargarProductos.store')}}" enctype="multipart/form-data" accept-charset="UTF-8">
          {{ csrf_field() }}
          <div class="form-group">
              <label>Imagen</label>
              <input type="file" name="image"  required class="form-control" id="images">
          </div>
          <div class="form-group">
            <label for="Nombre">Nombre del Producto</label>
            <input class="form-control" placeholder="Nombre" required="" name="name" type="text" id="name">
          </div>
          <div class="form-group">
            <label for="precio">Precio</label>
            <input class="form-control" required="" name="precio" type="number" id="precio">
          </div>
          <div class="form-group">
            <label for="des">Descuento</label>
            <input class="form-control" required="" name="des" type="number" id="des">
          </div>
          <div class="form-group">
            <label for="desCant">Cantidad para el descuento</label>
            <input class="form-control" required="" name="desCant" type="number" id="desCant">
          </div>
          <div class="form-group">
            <label for="desGp">Descuento para lotes</label>
            <input class="form-control" required="" name="desGp" type="number" id="desGp">
          </div>
          <div class="form-group">
            <label for="desGpCant">Cantidad para el descuento en lote</label>
            <input class="form-control" required="" name="desGpCant" type="number" id="desGpCant">
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit"><i class="fa  fa-upload"></i> Registrar</button>
          </div>
        </form>
      </div>
      <hr>
      <div class="row">
        @foreach ($productos as $producto)
          <div class="col-sm-12 col-md-6">
            <div class="box box-solid">
              <div class="box-body">
                <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">{{$producto->nb_nombre}}</h4>
                <div class="media">
                  <div class="media-left">
                      <a href="#" class="ad-click-event">
                          <img src="{{ asset('catalogo/'.$producto->ra_foto.'') }}" alt="{{$producto->nb_nombre}}" class="media-object" style="width: 150px;height: 150px;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                      </a>
                  </div>
                  <div class="media-body">
                    <div class="clearfix row">
                      <div class="col col-xs-12">
                        <h4 style="margin-top: 0">Precio ─ ${{$producto->nu_precio}}</h4>
                        <p>Rebaja del {{$producto->nu_descuento}}% con mas de {{$producto->nu_cantidad}}</p>
                        <p>Con la compra de {{$producto->nu_cantidadGrupo}} de nuestros otros productos obtines un  {{$producto->nu_descuentoGrupo}}%</p>
                      </div>
                      <div class="col col-xs-12">
                        <p class="pull-right">
                            <a href="{{ route('cargarProductos.destroy', $producto->pk_producto) }}" class="btn btn-danger btn-sm ad-click-event">Eliminar</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
