<?php


?>




<div class="content-wrapper">

<section class="content-header" style="background-color: white;">

    <h1>

      Lista de signos vitales

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-warning" style="color: black;" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente

        </button>

      </div>

      <div class="box-body">

      <div class="col-lg-12 hidden-md hidden-sm hidden-xs">

<div class="box box-warning">
    <div class="box-header with-border">
    </div>
    <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablahistoria" style="font-size: 14px; width:100%">
            <thead>
                <tr>
                <th>Número</th>
                    <th>Cédula</th>
                    <th>Nombres completos</th>
                    <th>Fecha_nacimiemto</th>
                    <th>Edad</th>
                    <th>Temperatura</th>
                    <th>Precion_arterial</th>
                    <th>Pulso</th>
                    <th>Frecuencia_respiratoria</th>
                    <th>Saturacion</th>
                    <th>Peso</th>
                    <th>Talla</th>
                    <th>IMC</th>
                 
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post">

      

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#F9D047; color:black">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


                <!-- ENTRADA PARA EL DOCUMENTO ID -->
            <div class="form-group">
              <label for="">Cédula</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input onkeypress="return valideKey(event);" type="text"  maxlength="10"  class="form-control input-lg " name="cedula" placeholder="INGRESE CÉDULA" required>
              </div>
            </div>



            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <label for="">Nombres completos</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text" style="text-transform:uppercase" class="form-control input-lg" name="nombres" placeholder="Ingresar nombre completos" required>
              </div>
            </div>

      



            <!-- ENTRADA PARA LA FECHA NACIMIENTO -->

            <div class="form-group">
              <label for="">Fecha nacimiento</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="date" class="form-control input-lg fecha_nacimiemto"  id="fecha_nacimiemto" name="fecha_nacimiemto" placeholder="Fecha nacimiento" required>
              </div>
            </div>



            
            <!-- ENTRADA PARA LA FECHA NACIMIENTO -->

            <div class="form-group">
              <label for="">Edad</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input  type="number" class="form-control input-lg edad" id="edad" name="edad" placeholder="EDAD" readonly required>
              </div>
            </div>




               <!-- ENTRADA PARA LA TEMPERATURA -->

               <div class="form-group">
              <label for="">Temperatura</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text"  class="form-control input-lg" name="temperatura" placeholder="Exp. 26.30"

                onkeypress="return filterFloat(event,this);" required
                >
              </div>
            </div>



             <!-- ENTRADA PARA LA PRESCION ARTERIAL -->

             <div class="form-group">
              <label for="">Presión arterial</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text" class="form-control input-lg"  maxlength="7"  onkeypress="return valideKeyForemat(event,this);" id="presion" name="precion_arterial" placeholder="124/541" required>
              </div>
            </div>



            <!-- ENTRADA PARA PUSLO -->

            <div class="form-group">
              <label for="">Pulso</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text" class="form-control input-lg"  name="pulso" placeholder="Exp. 150" onkeypress="return valideKey(event);" required>
              </div>
            </div>




            <!-- ENTRADA PARA FRECUENCIA -->

            <div class="form-group">
              <label for="">frecuencia respiratoria</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text" onkeypress="return valideKey(event);" class="form-control input-lg" name="frecuencia_respiratoria" placeholder="Exp. 100" required>
              </div>
            </div>



            <!-- ENTRADA PARA SATURACION -->

            <div class="form-group">
              <label for="">Saturación</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="number" class="form-control input-lg" id="" name="saturacion" placeholder="Exp. 10" onkeypress="return valideKey(event);" required>
              </div>
            </div>




            <!-- ENTRADA PARA Peso -->

            <div class="form-group">
              <label for="">Peso KG</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input  type="text" id="peso" class="form-control input-lg" name="peso" placeholder="Exp. 12.255"
                maxlength="5"
                onkeypress="return filterFloat(event,this);" required>
              </div>
            </div>



               <!-- ENTRADA PARA TALLA -->

               <div class="form-group">
              <label for="">Talla CM</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input type="text" class="form-control input-lg"  id="talla" name="talla" 
                maxlength="6" placeholder="Exp. 175.25"
                onkeypress="return filterFloat(event,this);"
                required>
              </div>
            </div>




             <!-- ENTRADA PARA TALLA -->

             <div class="form-group">
              <label for="">IMC</label>
              <div class="input-group">
                <span class="input-group-addon"></span>
                <input  type="number" step="0.00" class="form-control input-lg" id="imc" name="imc" placeholder="IMC" readonly required>
              </div>
            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-warning" style="color: black;">Guardar cliente</button>

        </div>

      </form>

      <?php

      $crearCliente = new ControladorClientes();
      $crearCliente->ctrCrearCliente();

     
      ?>

    </div>

  </div>

</div>

