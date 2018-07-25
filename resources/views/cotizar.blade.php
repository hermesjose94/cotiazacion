@extends('main')

@section('title')
  Cotizar
@endsection

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Sistema</a></li>
    <li class="active">Cotizar</li>
  </ol>
@endsection

@section('content')
  <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 id="title-modal"class="modal-title">Cotización</h4>
            <p>Cotización de {{Auth::user()->empresa->nb_nombre}} RIF {{Auth::user()->empresa->nb_rif}} para {{Auth::user()->nb_nombre}} {{Auth::user()->nb_apellido}} RUC {{Auth::user()->nb_RUC}}</p>
          </div>
          <div class="modal-body">
            <ul class="products-list product-list-in-box" id="body-list">
            </ul>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a>Sub Total <span class="pull-right text-green" id="Sub">0</span></a></li>
                <li><a>IVA 12% <span class="pull-right text-green" id="IVA">0</span></a></li>
                <li><a>Total <span class="pull-right text-green" id="Total">0</span></a></li>
              </ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Volver</button>
          </div>
        </div>
      </div>
  </div>
  <div class="box">
    <div class="box-body">
      <div class="row">
        @php
          $i=0;
        @endphp
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
                        <div class="input-group">
                          <input min="0" type="number" value="0" name="cant" placeholder="Cantidad" class="form-control" id="C{{$i}}">
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-flat" onclick="agregar({{$i}});">Agregar</button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @php
            $i++;
          @endphp
        @endforeach
      </div>
      <div class="col-xs-12">
          <button onclick="cotizar();" type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Cotizar</button>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  var productos = new Array();
  var listado = new Array();
  @foreach ($productos as $producto)
    var producto = new Object();
    producto.foto           = "{{ asset('catalogo/'.$producto->ra_foto.'') }}";
    producto.nombre         = "{{$producto->nb_nombre}}";
    producto.precio         = {{$producto->nu_precio}};
    producto.descuento      = {{$producto->nu_descuento}};
    producto.cantidad       = {{$producto->nu_cantidad}};
    producto.descuentoGrupo = {{$producto->nu_descuentoGrupo}};
    producto.cantidadGrupo  = {{$producto->nu_cantidadGrupo}};
    productos.push(producto);
  @endforeach

  function cotizar() {
    if (listado.length > 0) {
      console.log("cotizando");
      $("#body-list").empty();
      cantT = 0;
      for (var i = 0; i < listado.length; i++) {
        cantT +=  listado[i].cant;
      }
      subTotalFact = 0;
      console.log(productos);
      for (var i = 0; i < listado.length; i++) {
        subTotal = productos[listado[i].numero].precio * listado[i].cant;
        des = 0;
        if (listado[i].cant >= productos[listado[i].numero].cantidad) {
          des = productos[listado[i].numero].descuento
        }
        if (cantT >= productos[listado[i].numero].cantidadGrupo && listado.length>1) {
          des = productos[listado[i].numero].descuentoGrupo;
        }
        Total = subTotal - ((subTotal * des)/100);
        subTotalFact += Total;
        $("#body-list").append('<li class="item"><div class="product-img"><img src='+productos[listado[i].numero].foto+' alt="Product Image"></div><div class="product-info"><p class="product-title text-light-blue">'+productos[listado[i].numero].nombre+'<span class="label label-info pull-right">$'+Total+'</span></p><span class="product-description">Cantidad '+listado[i].cant+'</span></div></li>');
      }
      iva = ((subTotalFact * 12)/100);
      Total = subTotalFact + iva;
      $("#Sub").html(subTotalFact);
      $("#IVA").html(iva);
      $("#Total").html(Total);
    }
  }

  function agregar(pos) {
    var producto = new Object();
    if (listado.length == 0) {
      producto.numero = pos;
      producto.cant   = parseInt(document.getElementById("C"+pos).value);
      listado.push(producto);
    }else {
      band = false;
      for (var i = 0; i < listado.length; i++) {
        if (listado[i].numero == pos) {
          listado[i].cant = parseInt(document.getElementById("C"+pos).value);
          band = true;
        }
      }
      if (!band) {
        producto.numero = pos;
        producto.cant   = parseInt(document.getElementById("C"+pos).value);
        listado.push(producto);
      }
    }
    console.log(listado);
  }



</script>
@endsection
