<footer id="footer">
                <div class="footer-top">
                    <ul class="footer-menu">
                        <?php foreach ($this->clasificaciones as $clasificacion): ?>
                        <li><a class="uppercase"><?php echo $clasificacion['nombre']; ?></a></li>
                        <li class="spacer">|</li>
                        <?php endforeach;?>
                    </ul>
                    <ul class="footer-info">
                        <li class="visa"><span></span></li>
                        <li class="mastercard"><span></span></li>
                        <li class="american-express"><span></span></li>
                        <li class="webpay"><span></span></li>
                    </ul>
                </div>
                <div class="footer-bot">
                    <p>Rosatel © 2015 Todos los Derechos Reservados</p>
                </div>
            </footer>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/frontend/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/frontend/js/functions.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>public/assets/frontend/js/bootstrap.min.js"></script>     
    </body>
</html>