<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Formulario</title>
</head>

<body>
  <video src="img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">
    <form method="POST" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Cualquier Ciudad</option>
              @foreach ($data->pluck('Ciudad')->unique() as $ciudad)
                <option value="{{$ciudad}}" selected>{{$ciudad}}</option>
              @endforeach
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option value="">Cualquier Tipo</option>
              @foreach ($data->pluck('Tipo')->unique() as $Tipo)
                <option value="{{$Tipo}}" selected>{{$Tipo}}</option>
              @endforeach
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input form="formulario" type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles <span id="conteobienes">({{$data->count()}})</span></a></li>
        <li><a href="#tabs-2">Mis bienes <span id="conteoguardados">({{$guardados->count()}})</span></a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda" style="width: 100% !important;">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Resultados de la búsqueda:</h5>
            <div class="divider"></div>
          </div>
            @foreach ($data as $bien)
              <div class="col s12 m7">
                <div class="itemMostrado card horizontal">
                  <img src="{{asset('/img/home.jpg')}}">
                  <div class="card-stacked">
                    <div class="card-content">
                        <p><b>Dirección: </b>{{$bien->Direccion}}</p>
                        <p><b>Ciudad: </b>{{$bien->Ciudad}}</p>
                        <p><b>Telefono: </b>{{$bien->Telefono}}</p>
                        <p><b>Código Postal: </b>{{$bien->Codigo_Postal}}</p>
                        <p><b>Tipo: </b>{{$bien->Tipo}}</p>
                        <p><b>Precio: </b>{{$bien->Precio}}</p>
                    </div>
                    <div class="card-action">
                      <button onclick="Save({{$bien->Id}})" class="btn">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
      </div>
      
      <div id="tabs-2" >
        <div class="colContenido" id="bienesGuardados" style="width: 100% !important;">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
          </div>
          @foreach ($guardados as $guardado)
            <div id="saved{{$guardado->Origin}}" class="col s12 m7">
              <div class="itemMostrado card horizontal">
                <img src="{{asset('/img/home.jpg')}}">
                <div class="card-stacked">
                  <div class="card-content">
                      <p><b>Dirección: </b>{{$guardado->Direccion}}</p>
                      <p><b>Ciudad: </b>{{$guardado->Ciudad}}</p>
                      <p><b>Telefono: </b>{{$guardado->Telefono}}</p>
                      <p><b>Código Postal: </b>{{$guardado->Codigo_Postal}}</p>
                      <p><b>Tipo: </b>{{$guardado->Tipo}}</p>
                      <p><b>Precio: </b>{{$guardado->Precio}}</p>
                  </div>
                  <div class="card-action">
                    <button onclick="Delete({{$guardado->Origin}})" class="btn red">Borrar</button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script type="text/javascript">
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "6000",
        "extendedTimeOut": "3000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

      function NotifiTrue(Mensaje) {
        toastr.success(Mensaje);
      }

      function NotifiFalse(Mensaje) {
        toastr.error(Mensaje);
      }
    </script>
    <script>
			var buttonsubmit = $('#submitButton');
      function enablebutton(Mensaje) {
        buttonsubmit.disabled = false;
        buttonsubmit.prop('disabled', false);
        buttonsubmit.prop('class', 'btn white');
        buttonsubmit.val(`BUSCAR`);
      }
      function disablebutton() {
        buttonsubmit.disabled = true;
        buttonsubmit.prop('disabled', true);
        buttonsubmit.prop('class', 'btn blue');
        buttonsubmit.val(`Buscando...`);
      }
      function renewtoken(token) {
        $('meta[name="csrf-token"]').attr('content', token);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
      }
    </script>
    <script type="text/javascript">
      $( document ).ready(function() {
          $( "#tabs" ).tabs();
      });
      $('#formulario').on( "submit", function(e) {
					var Ciudad = $('#selectCiudad').val();
					var Tipo = $('#selectTipo').val();
					var Range = $('#rangoPrecio').val();
				$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
				});
				$.ajax({
				url: "{{route('filtrar')}}",
				method: 'POST',
				data: {'Ciudad': Ciudad, 'Tipo': Tipo, 'Range':Range},
				beforeSend: function(){
          disablebutton();
          $('#divResultadosBusqueda').empty();
				},
				success: function(data, textStatus, jqXHR){
          renewtoken(data.newtoken);
					switch (jqXHR['status']) {
						case 200:
							toastr.success(data['message']);
							break;
					
						default:
							toastr.error(data['message']);
							break;
					}
          $('#conteobienes').html("("+data['total']+")")
          Object.keys(data.filter).forEach(function(key) {
            $('#divResultadosBusqueda').append(`
              <div class="col s12 m7 item">
                <div class="itemMostrado card horizontal">
                  <img src="/img/home.jpg">
                  <div class="card-stacked">
                    <div class="card-content">
                        <p><b>Dirección: </b>`+data.filter[key].Direccion+`</p>
                        <p><b>Ciudad: </b>`+data.filter[key].Ciudad+`</p>
                        <p><b>Telefono: </b>`+data.filter[key].Telefono+`</p>
                        <p><b>Código Postal: </b>`+data.filter[key].Codigo_Postal+`</p>
                        <p><b>Tipo: </b>`+data.filter[key].Tipo+`</p>
                        <p><b>Precio: </b>`+data.filter[key].Precio+`</p>
                    </div>
                    <div class="card-action">
                      <button href="#" class="btn">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            `);
          });
          $('#divResultadosBusqueda').fadeIn('slow');
          enablebutton();
				},
				error: function(xhr, textStatus, jqXHR){
          renewtoken(xhr.newtoken);
					toastr.error(xhr['responseJSON']['message']);
          enablebutton();
				},
				complete: function(){
					
				}
				})
        e.preventDefault();
			});
      function Save(Id) {
				$.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
				});
				$.ajax({
          url: "{{route('bienes.store')}}",
          method: 'POST',
          data: {'Id': Id},
          beforeSend: function(){
            //
          },
          success: function(data, textStatus, jqXHR){
            renewtoken(data.newtoken);
            switch (jqXHR['status']) {
              case 200:
                toastr.success(data['message']);
                break;
            
              default:
                toastr.error(data['message']);
                break;
            }
            $('#conteoguardados').html("("+data['total']+")");
            
            Object.keys(data.filter).forEach(function(key) {
              $('#bienesGuardados').append(`
                <div id="saved`+data.filter[key].Id+`" class="col s12 m7 item">
                  <div class="itemMostrado card horizontal">
                    <img src="/img/home.jpg">
                    <div class="card-stacked">
                      <div class="card-content">
                          <p><b>Dirección: </b>`+data.filter[key].Direccion+`</p>
                          <p><b>Ciudad: </b>`+data.filter[key].Ciudad+`</p>
                          <p><b>Telefono: </b>`+data.filter[key].Telefono+`</p>
                          <p><b>Código Postal: </b>`+data.filter[key].Codigo_Postal+`</p>
                          <p><b>Tipo: </b>`+data.filter[key].Tipo+`</p>
                          <p><b>Precio: </b>`+data.filter[key].Precio+`</p>
                      </div>
                      <div class="card-action">
                        <button onclick="Delete(`+data.filter[key].Id+`)" class="btn red">Borrar</button>
                      </div>
                    </div>
                  </div>
                </div>
              `);
            });
          },
          error: function(xhr, textStatus, jqXHR){
            renewtoken(xhr.newtoken);
            switch (xhr['status']) {
              case 422:
                toastr.error(xhr['responseJSON']['errors']['Id']);
                break;
            
              default:
                toastr.error(xhr['responseJSON']['message']);
                break;
            }
          },
          complete: function(){
            
          }
				})
      }
      function Delete(Id) {
				$.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
				});
				$.ajax({
          url: "{{route('bienes.destroy', ['biene' => "+Id+"])}}",
          method: 'DELETE',
          data: {'Id': Id},
          beforeSend: function(){
            //
          },
          success: function(data, textStatus, jqXHR){
            renewtoken(data.newtoken);
            switch (jqXHR['status']) {
              case 200:
                toastr.success(data['message']);
                break;
            
              default:
                toastr.error(data['message']);
                break;
            }
            $('#conteoguardados').html("("+data['total']+")");
            
            $('#saved'+data.Origin).remove();
          },
          error: function(xhr, textStatus, jqXHR){
            renewtoken(xhr.newtoken);
            switch (xhr['status']) {
              case 422:
                toastr.error(xhr['responseJSON']['errors']['Id']);
                break;
            
              default:
                toastr.error(xhr['responseJSON']['message']);
                break;
            }
          },
          complete: function(){
            
          }
				})
      }
    </script>
  </body>
  </html>