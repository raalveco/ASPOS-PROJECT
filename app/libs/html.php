<?php
	/* Clase Html
	* Esta clase contiene diferentes metodos que regresan el c�digo html para crear diferentes tags predefinidos de manera sencilla.	
	* 
	* Autor: Ramiro Vera(raalveco) y Carlos Lizaola(clizaola)
	* Company: Amecasoft S.A. de C.V. (M�xico)
	* Fecha: 04/06/2011
	* 
	* NOTA: Esta clase esta dise�ada para funcionar como libreria en el Kumbia PHP Spirit 1.0
	* 
	*/
	class Html {
		
		public static function notificacion($mensaje,$tipo="success"){
			$html = '<div class="notification '.$tipo.' png_bg">'; 
	            $html .= '<div>'; 
	                $html .= $mensaje;
		        $html .= '</div>';
			$html .= '</div>';
			
			return $html;
		}
		
		public static function link($accion, $texto) {
			$params = is_array($accion) ? $accion : Util::getParams(func_get_args());
			return  link_to($params);
		}
        
        public static function linkAncla($ancla, $texto) {
            $params = is_array($ancla) ? $ancla : Util::getParams(func_get_args());
            return  link_to($params);
        }
	
		public static function linkConfirmado($accion, $texto, $mensaje) {
			$params = is_array($accion) ? $accion : Util::getParams(func_get_args());
			$params["onclick"] = "return confirm('" . $mensaje . "');";
			return  link_to($params);
		}
	
		public static function linkAjax($accion, $text, $contenedor) {
			$params = is_array($accion) ? $accion : Util::getParams(func_get_args());
			$params["rel"] = "#" . $contenedor;
			$params["class"] = "jsRemote";
			$params["id"] = "jsRemote";
			return  link_to($params);
		}
		
		public static function linkAjaxConfirmado($accion, $text, $contenedor){
            $params = is_array($accion) ? $accion : Util::getParams(func_get_args());
            
            $params["onclick"] = "return confirm('".$mensaje."');";
            $params["rel"] = "#".$contenedor;
            $params["class"] = "jsRemoteEliminar";
            
            $controlador = substr($accion,0,strpos($accion,"/"));
            $acciontmp = substr($accion,strpos($accion,"/")+1);
            
            if(strpos($acciontmp,"/")!==false){
            	$acciontmp = substr($acciontmp,0,strpos($acciontmp,"/"));
            }
            
            return link_to($params);
        }
		
		public static function linkear($url, $texto, $contenedor = ""){
			if($contenedor == ""){
				
				return Html::link($url,$texto);
			}
			else{
				if($contenedor == "blank" || $contenedor == "_blank"){
					return Html::link($url,$texto,"target: _blank");
				}
				else{
					return Html::linkAjax($url,$texto,$contenedor);
				}
			}
		}
		
		public static function linkearConfirmado($url, $texto, $contenedor = "", $mensaje = "�Estas seguro de querer visitar este link?"){
			if($contenedor == ""){
				return Html::linkConfirmado($url, $texto, $mensaje);
			}
			else{
				if($contenedor == "blank" || $contenedor == "_blank"){
					return Html::linkConfirmado($url, $texto, $mensaje, "target: _blank");
				}
				else{
					return Html::linkAjaxConfirmado($url,$texto,$contenedor,$mensaje);
				}
			}
		}
	
		public static function imagen($imagen, $alt="", $w=0, $h=0) {
			$params = is_array($imagen) ? $imagen : Util::getParams(func_get_args());
			
			if($alt != "") {
				$params["alt"] = str_replace(":", "###", $alt);
				$params["title"] = str_replace(":", "###", $alt);
			}
			if($w != "") {
				$params["width"] = $w;
			}
			if($h != "") {
				$params["height"] = $h;
			}
			
			return  str_replace("###", ":", img_tag($params));
		}
		
		public static function mapaGoogle($x, $y, $zoom = 15, $alt="", $w=400, $h=400) {
			$params["src"] = 'http://maps.google.com/maps/api/staticmap?center='.$x.','.$y.'&zoom='.$zoom.'&size='.$w.'x'.$h.'&sensor=false&markers=color:red|'.$x.','.$y.'';
			
			if($alt != "") {
				$params["alt"] = str_replace(":", "###", $alt);
				$params["title"] = str_replace(":", "###", $alt);
			}
			if($w != "") {
				$params["width"] = $w;
			}
			if($h != "") {
				$params["height"] = $h;
			}
			$params["border"] = "0";
			
			return  str_replace("###", ":", img_tag($params));
		}
	
		public static function youtube($codigo, $w=662, $h=408) {
			$html = '<object width="' . $w . '" height="' . $h . '">
						<param name="movie" value="http://www.youtube.com/v/' . $codigo . '?fs=1&amp;hl=es_ES"></param>
						<param name="allowFullScreen" value="true"></param>
						<param name="allowscriptaccess" value="always"></param>
						<param name="wmode" value="transparent" />
						<embed wmode="transparent" src="http://www.youtube.com/v/' . $codigo . '?fs=1&amp;hl=es_ES" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $w . '" height="' . $h . '"></embed>
					</object>';
			return $html;
		}
	
		public static function botonJS($texto, $javascript="alert('Hola Mundo');") {
			return '<input type="button" value="' . $texto . '" onclick="' . $javascript . '" />';
		}
		
	}
?>