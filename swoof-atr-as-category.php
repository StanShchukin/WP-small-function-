<?php


add_action( 'template_redirect', 'redirect_to_register' );
	
	
	function redirect_to_register() {
		if ( is_woocommerce() ) {
			
			add_filter( 'woocommerce_get_breadcrumb', 'change_breadcrumb' );
			function change_breadcrumb( $crumbs ) {
				
				/**
				 * $link = 'page/sub-page#fragment';
				 *
				 * // скорость на 50000 повторений
				 * echo strip_fragment_from_url($link);         // 0.060 sec
				 * echo  preg_replace('~#.*~', '', $link);      // 0.014 sec
				 * echo  str_replace('#fragment', '', $link );  // 0.010 sec
				 * echo  substr($link, 0, strpos($link, '#') ); // 0.007 sec
				 *
				 * // каждая строка выведет на экран:
				 * // page/sub-page
				 */
				
				$swoof    = '?swoof';
				$shop     = get_site_url() . '/shop/';
				$podswoof = '=1&product_cat=';
				//echo $shop;
				$new = array();
				foreach ( $crumbs as $key => $crmbs ) {
					if ( $key != 0 ) {
						
						foreach ( $crmbs as $i => $value ) {
							if ( $i == 1 ) {
								if ( $value === $shop ) {
									$crmbs[ $i ] = $value . $swoof;
//									echo $crmbs[ $i ];
								} else {
									$prod_shop    = str_replace( $shop, '', $value );
									$prodcatarray = explode( '/', $prod_shop );
									
									foreach ( $prodcatarray as $k => $valnull ) {
										if ( $valnull == '' ) {
											unset( $prodcatarray[ $k ] );
										}// else {
										$valnull = $shop . $swoof . $podswoof . implode( ',', $prodcatarray );
										//	}
									}
									$crmbs[ $i ] = $valnull;
									//var_dump($prodcatarray);
//									echo '<pre>'; var_dump($crmbs);

								}
								
							}
						}
					}
					$new[ $key ] = $crmbs;
				}
				
				//var_dump( $new );
				return $new;
				//return $crumbs;
			}
		}
	}
