<?php
/**
 * Plugin Name: Assinaturas
 * Plugin URI: n/a
 * Description: Sistema de assinaturas para jornal
 * Version: 1.0
 * Author: Douglas Gomes Tosta
 * Author URI: https://douglasgomes.xyz
 */
add_role( 'Assinante-np', 'Assinante não pagante', array("read"=>true) );
add_action( 'the_content', 'premium' );


function premium ( $content ) {
	

	$naoassinante = "<div> <center> <h2>Exclusivo para assinantes!</h2> <h3>Essa nóticia é exclusiva para membros de nosso jornal, para ver essa e muito mais nóticias, por favor assine nossos planos</h3> <br> <button class='submit' onclick=''> Veja nossos planos! </button> </div>";
	$naoassinante = $naoassinante . "<center><h3>Se você já é um assinante do nosso jornal, faça login para ler essa nóticia</h3> <a href='.../wp-admin'> <button class='submit'> Fazer Login </button></a>";
	$userdata = wp_get_current_user();
	if(is_single() && in_category('assinantes'))
	//get_post_type() == "post"
	{
				if(is_user_logged_in())
				{
					if($userdata->roles[0] == "Assinante-np")
					{
						add_filter( 'comments_open', false, 10 , 2 );
return $naoassinante;

					}else{
						return $content;
					}
				}else{
					add_filter( 'comments_open', false, 10 , 2 );
return $naoassinante;

				}

	}else{
		return $content;
	}
}







?>