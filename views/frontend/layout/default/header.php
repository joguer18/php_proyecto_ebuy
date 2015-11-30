<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width"/>
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>public/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>public/assets/frontend/css/style.css" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>public/assets/frontend/css/jquery.mCustomScrollbar.css" />
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo BASE_URL?>public/assets/frontend/css/jquery.bxslider.css" />
        <style>
            #header div.header-top ul.nav-user li{
                background: #c10e0e;
            }
            #header div.header-top ul.nav-user li ul.logged-user-options li a:hover{
                background: #c10e0e;
            }
            #header div.header-bot ul.main-menu>li:hover{
                border-bottom: 2px solid #c10e0e;
            }
            #home #carousel .carousel-indicators li.active{
                border: 1px solid #c10e0e;
                background: #c10e0e;
            }
            #home #featured-products li p.product-new-price{
                color: #c10e0e;
            }
            #header div.header-top{
                border-top: 3px solid #c10e0e;
            }
            @media only screen and (max-width: 1023px){
                
            }
            @media only screen and (max-width: 767px){
                
                #header div.header-top ul.nav-user li.unknown-user{
                    background: #c10e0e;
                }
                #header div.header-bot ul.main-menu{
                    background: #c10e0e;
                }
            }
            @media only screen and (max-width: 479px){

            }
        </style>
        <script type="text/javascript">
            var globalColor = "c10e0e";
        </script>
    </head>
   
    <body>
        <div id="wrapper">
            <header id="header">
                <div class="header-top">
                    <div id="responsive-menu">
                        <span class="responsive-menu-btn"></span>
                    </div>
                    <ul class="nav-user">
                        <li class="unknown-user uppercase">Login</li>
                        <li class="logged-user uppercase"><span></span><p>Paolo</p>
                            <ul class="logged-user-options">
                                <li><a href="#">Mi Cuenta</a></li>
                                <li><a href="#">Mis Pedidos</a></li>
                                <li><a href="#">Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <table class="header-mid">
                    <tr>
                        <td>
                            <a class="logo" href="<?php echo BASE_URL?>"><img src="<?php echo BASE_URL; ?>temp/<?php echo $this->logo->source?>" width="153" height="142"></a>
                        </td>
                        <td>
                            <ul class="nav-info">
                                <li class="online">
                                    <span></span>
                                    <p>Compra online las 24 horas</p>
                                </li>
                                <li class="delivery">
                                    <span></span>
                                    <p>Delivery a todo el Perú</p>
                                </li>
                                <li class="pago">
                                    <span></span>
                                    <p>Todos los medios de pago</p>
                                </li>
                                <li class="fonocompras">
                                    <span></span>
                                    <p>Fonocompras 213-6677</p>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                <div class="header-bot">
                    <ul class="main-menu">
                        <?php foreach ($this->clasificaciones as $clasificacion): ?>
                             
                        <li class="uppercase"><p><?php echo $clasificacion['nombre']?></p><span></span>
                            <div class="main-menu-dropdown-box">
                                <div class="main-menu-dropdown">
                                    <div class="main-menu-space"></div>
                                    <ul>
                                       <?php $reg = $this->categorias->getCategoriaPorClasificacion($clasificacion['id']); ?>
                                        <?php foreach ($reg as $categoria): ?>
                                        <li><a href="<?php echo BASE_URL?>categoria/listar/<?php echo $categoria['id'];?>"><?php echo $categoria['nombre'];?></a></li>
                                         <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <ul class="extra-menu">
                        <li class="facebook"><a href="http://<?php echo $this->logo->facebook?>" target="_blank"></a></li>
                        <li class="twitter"><a href="http://<?php echo $this->logo->twitter?>" target="_blank"></a></li>
                        <li class="basket"><a href="<?php echo BASE_URL;?>carro/carro"><p><?php if(isset($_SESSION["totalImporte"])):?> 
                 		
						$ <?php echo $_SESSION["totalImporte"];?> 
                    <?php else:?>
                        
                		$     0
                	<?php endif;?></p><span></span></a></li>
                    </ul>
                </div>
            </header>