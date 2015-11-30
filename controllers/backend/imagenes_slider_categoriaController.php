<?php

class imagenes_slider_categoriaController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->_view->renderizar('index');
    }

    public function agregar($categoriaId) {

        $objslider = $this->loadModel('imagenes_slider_categoria');
        $this->_view->slider = $objslider->getAllSliders($categoriaId);
        $this->_view->categoriaId = $categoriaId;
        $this->_view->renderizar('agregar');
    }

    public function agregarSliders() {

        // limpieza de data que viene del formulario
        $categoria_id = trim(strtolower($_POST['categoria_id']));

        $objslider = $this->loadModel('imagenes_slider_categoria');

        //Subida de imagen 1 del Slider
        if (isset($_FILES['imagen1'])) {
            $nombrearchivo = basename($_FILES['imagen1']['name']);
            $destino_archivo = "temp/sliders/" . $nombrearchivo;

            if (move_uploaded_file($_FILES['imagen1']['tmp_name'], $destino_archivo)) {
                $source = $nombrearchivo;
                /* array de tipos permitidos */
                $mimes_permitidos = array('image/jpeg', 'image/jpg', 'image/png');
                $mime = $_FILES['imagen1']['type'];

                if (in_array($mime, $mimes_permitidos)) {
                    $fp = fopen($destino_archivo, "rb");
                    $contenido = fread($fp, filesize($destino_archivo));
                    $imagen = addslashes($contenido);
                    fclose($fp);
                }
                //unlink($destino_archivo);
                $objslider->grabaFotoSlider($categoria_id, $mime, $imagen, $source);
            }
        }
        
        //Subida de imagen 2 del Slider
        if (isset($_FILES['imagen2'])) {
            $nombrearchivo = basename($_FILES['imagen2']['name']);
            $destino_archivo = "temp/sliders/" . $nombrearchivo;

            if (move_uploaded_file($_FILES['imagen2']['tmp_name'], $destino_archivo)) {
                $source = $nombrearchivo;
                /* array de tipos permitidos */
                $mimes_permitidos = array('image/jpeg', 'image/jpg', 'image/png');
                $mime = $_FILES['imagen2']['type'];

                if (in_array($mime, $mimes_permitidos)) {
                    $fp = fopen($destino_archivo, "rb");
                    $contenido = fread($fp, filesize($destino_archivo));
                    $imagen = addslashes($contenido);
                    fclose($fp);
                }
                //unlink($destino_archivo);
                $objslider->grabaFotoSlider($categoria_id, $mime, $imagen, $source);
            }
        }
        
        //Subida de imagen 3 del Slider
        if (isset($_FILES['imagen3'])) {
            $nombrearchivo = basename($_FILES['imagen3']['name']);
            $destino_archivo = "temp/sliders/" . $nombrearchivo;

            if (move_uploaded_file($_FILES['imagen3']['tmp_name'], $destino_archivo)) {
                $source = $nombrearchivo;
                /* array de tipos permitidos */
                $mimes_permitidos = array('image/jpeg', 'image/jpg', 'image/png');
                $mime = $_FILES['imagen3']['type'];

                if (in_array($mime, $mimes_permitidos)) {
                    $fp = fopen($destino_archivo, "rb");
                    $contenido = fread($fp, filesize($destino_archivo));
                    $imagen = addslashes($contenido);
                    fclose($fp);
                }
                //unlink($destino_archivo);
                $objslider->grabaFotoSlider($categoria_id, $mime, $imagen, $source);
            }
        }
        $this->redireccionar('backend/categoria/index');
    }


    public function guardarSliders() {
     
       
        $id = $_POST['id'];
        $categoria_id = trim($_POST['categoria_id']);
//        var_dump($_POST);
//        echo "<br>";
//       var_dump(count($_FILES['imagen']));
//        echo "<br>";
//        echo $id[4];
//        die();
        //var_dump($_FILES['imagen2']);
        $objslider = $this->loadModel('imagenes_slider_categoria');

        
        
        //$objslider->updateSlider($id, $categoria_id);
        for ($i = 0; $i < count($_FILES['imagen']); $i++) {
           //Subida de imagen
            if (isset($_FILES['imagen'])) {
                
                $nombrearchivo = basename($_FILES['imagen']['name'][$i]);
                
                $destino_archivo = "temp/sliders/" . $nombrearchivo;
                $slider_id = $id[$i];
                
                if (move_uploaded_file($_FILES['imagen']['tmp_name'][$i], $destino_archivo)) {
                   
                    $source = $nombrearchivo;
                    
                    /* array de tipos permitidos */
                    $mimes_permitidos = array('image/jpeg', 'image/jpg', 'image/png');
                    $mime = $_FILES['imagen']['type'];

                    if (in_array($mime, $mimes_permitidos)) {
                        $fp = fopen($destino_archivo, "rb");
                        $contenido = fread($fp, filesize($destino_archivo));
                        $imagen = addslashes($contenido);
                        fclose($fp);
                    }
                    //unlink($destino_archivo);
                    $objslider->updateFotoSlider($categoria_id,$slider_id, $mime, $imagen, $source);
                }
            }
        }
        

        $this->redireccionar('backend/categoria/index');
    }

    // Ver el logo de la web
    public function verimagen($id) {

        $objcategoria = $this->loadModel('categoria');
        $reg = $objcategoria->getCategoriaImagen($id);
        header("Content-Type:$reg->mime");
        echo $reg->imagen;
    }

    public function borrar($categoriaId) {

        $objcategoria = $this->loadModel('categoria');
        $objcategoria->borrarCategoria($categoriaId);
        $this->redireccionar('backend/categoria/index');
    }
    

}

?>
