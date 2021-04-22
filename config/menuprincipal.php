  
<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../usuarios/fotos/<?php echo $_SESSION['idusu'];?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['usu'] ?></div>
                    <div class="email"><?php echo $rol ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li role="separator" class="divider"></li>
                            <li><a href="../usuarios/cambiarclave.php"><i class="material-icons">lock_outline</i>Cambiar clave</a></li>
                            <li><a href="../config/salir.php"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENÚ PRINCIPAL</li>
                    <li <?php if ($pagina==1) {echo 'class="active"';}?> >
                        <a href="../acceso/plantilla.php">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==11) {echo 'class="active"';}if($_SESSION['rol']==3) { echo 'style="display:none;"';}?> >
                        <a href="../operaciones/index.php">
                            <i class="material-icons">add_shopping_cart</i>
                            <span>Operaciones</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==8) {echo 'class="active"';} if($_SESSION['rol']==6) { echo 'style="display:none;"';}?> >
                        <a href="../caja/ultimacaja.php">
                            <i class="material-icons">monetization_on</i>
                            <span>Caja</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==3) {echo 'class="active"';} if($_SESSION['rol']==3) { echo 'style="display:none;"';}?> >
                        <a href="../categorias/index.php?pagina=1">
                            <i class="material-icons">label</i>
                            <span>Categorías</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==4) {echo 'class="active"';}if($_SESSION['rol']==3) { echo 'style="display:none;"';}?> >
                        <a href="../productos/index.php?pagina=1">
                            <i class="material-icons">shop</i>
                            <span>Productos</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==12) {echo 'class="active"';}?> >
                        <a href="../enviar-correo.phpmailer/index.php">
                            <i class="material-icons">email</i>
                            <span>Email</span>
                        </a>
                    </li>
                    <!-- <li <?php //if ($pagina==7) {echo 'class="active"';}if($_SESSION['rol']==6) { echo 'style="display:none;"';}?> >
                         <a href="../tarjetas">
                            <i class="material-icons">credit_card</i>
                            <span>Tarjetas</span>
                        </a>
                    </li> -->
                    <li <?php if ($pagina==9) {echo 'class="active"' ;} if($_SESSION['rol']==6) { echo 'style="display:none;"';}?> >
                        <a href="../proveedores">
                            <i class="material-icons">people</i>
                            <span>Proveedores</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==10) {echo 'class="active"';}if($_SESSION['rol']==6 || $_SESSION['rol']==3) { echo 'style="display:none;"';}?> >
                        <a href="../sueldo/">
                            <i class="material-icons">monetization_on</i>
                            <span>Sueldos</span>
                        </a>
                    </li>
                    <li <?php if ($pagina==2) {echo 'class="active"';}if($_SESSION['rol']==6 || $_SESSION['rol']==3) { echo 'style="display:none;"';}?>>
                        <a href="../usuarios/index.php?pagina=1">
                            <i class="material-icons">supervisor_account</i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer 
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
             #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>