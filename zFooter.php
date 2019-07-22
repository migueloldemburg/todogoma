<script src="modals/js/app.js?v=1"></script>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <p class="help-block">&copy; Todogoma</p>	
            </div>
            <div class="col-xs-6">
                <ul class="list-inline text-right">
                    <li><a href="catalogueA.php">Inicio</a></li>
                <?php
                    if($_SESSION['nivel_']=='SUPER-U' || $_SESSION['nivel_']=='ADM'){ ?>
                    <li><a href="inicio.php">Administraci&oacute;n</a></li>
                    <?php } ?>
                    <!--<li><a href="contactos.php">Contactos</a></li>-->
                </ul>
            </div>
        </div>
    </div>
</footer>