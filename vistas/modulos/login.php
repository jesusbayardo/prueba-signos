<div id="back"></div>

<div class="login-box">
    <div class="login-logo">

      
       
      
        <p  style="color: white;font-size:25px;font-weight: bold;">Bienvenidos</p>
        
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="background: #44514A;border: 1px dotted white;" >
        <p class="login-box-msg" style="color: white;">Ingrese sus credenciales</p>

        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario aplicación" name="ingUsuario" value="admin">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="ingPassword" value="12345">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row" style="padding-top: 20px;">

                <!-- /.col -->
                <div class="">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
            <?php
            $login = new ControladorUsuarios();
            $login ->ctrIngresoUsuario()

            ?>

        </form>



<div>


