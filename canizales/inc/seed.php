<?php
/**
 * Configurador inicial: Apariencia → Configurar Canizales.
 * Crea o actualiza páginas, servicios, menú y portada con el contenido
 * revisado. Solo se ejecuta cuando un administrador pulsa el botón.
 *
 * @package Canizales
 */

defined( 'ABSPATH' ) || exit;

/* -------------------------------------------------------------------------
 * Generadores de marcado de bloques (Gutenberg)
 * ---------------------------------------------------------------------- */

function canizales_b_attrs( $attrs ) {
	return $attrs ? ' ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) : '';
}

function canizales_b_p( $html, $class = '' ) {
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return "<!-- wp:paragraph" . canizales_b_attrs( $attrs ) . " -->\n<p{$cls}>{$html}</p>\n<!-- /wp:paragraph -->\n\n";
}

function canizales_b_h( $text, $level = 2, $class = '' ) {
	$attrs = array();
	if ( 2 !== $level ) {
		$attrs['level'] = $level;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$cls = 'wp-block-heading' . ( $class ? ' ' . $class : '' );
	return "<!-- wp:heading" . canizales_b_attrs( $attrs ) . " -->\n<h{$level} class=\"{$cls}\">{$text}</h{$level}>\n<!-- /wp:heading -->\n\n";
}

function canizales_b_list( $items, $ordered = false, $class = '' ) {
	$attrs = array();
	if ( $ordered ) {
		$attrs['ordered'] = true;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$tag   = $ordered ? 'ol' : 'ul';
	$cls   = 'wp-block-list' . ( $class ? ' ' . $class : '' );
	$inner = '';
	foreach ( $items as $item ) {
		$inner .= "<!-- wp:list-item -->\n<li>{$item}</li>\n<!-- /wp:list-item -->\n\n";
	}
	return "<!-- wp:list" . canizales_b_attrs( $attrs ) . " -->\n<{$tag} class=\"{$cls}\">{$inner}</{$tag}>\n<!-- /wp:list -->\n\n";
}

function canizales_b_group( $inner, $class = '' ) {
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = 'wp-block-group' . ( $class ? ' ' . $class : '' );
	return "<!-- wp:group" . canizales_b_attrs( $attrs ) . " -->\n<div class=\"{$cls}\">{$inner}</div>\n<!-- /wp:group -->\n\n";
}

function canizales_b_cols( $columns ) {
	$inner = '';
	foreach ( $columns as $col ) {
		$inner .= "<!-- wp:column -->\n<div class=\"wp-block-column\">{$col}</div>\n<!-- /wp:column -->\n\n";
	}
	return "<!-- wp:columns -->\n<div class=\"wp-block-columns\">{$inner}</div>\n<!-- /wp:columns -->\n\n";
}

function canizales_b_sep() {
	return "<!-- wp:separator {\"className\":\"is-style-wide\"} -->\n<hr class=\"wp-block-separator has-alpha-channel-opacity is-style-wide\"/>\n<!-- /wp:separator -->\n\n";
}

/* -------------------------------------------------------------------------
 * Contenido
 * ---------------------------------------------------------------------- */

function canizales_seed_pages() {
	$firma  = canizales_b_p( 'Nuestra historia', 'is-style-antetitulo' );
	$firma .= canizales_b_h( 'Más de dos décadas acompañando decisiones difíciles.' );
	$firma .= canizales_b_p( 'Fundada por <strong>Ángel M. Canizales</strong> sobre una sólida trayectoria iniciada en 1999, Canizales Consultores S.A.S. se ha consolidado como una firma de referencia en insolvencia, reorganización empresarial y asesoría jurídica especializada.', 'is-style-destacado' );
	$firma .= canizales_b_p( 'Acompañamos a organizaciones y personas naturales en la búsqueda de soluciones sostenibles que permitan preservar su patrimonio, restablecer su equilibrio financiero y dar continuidad a sus proyectos. A lo largo de nuestra historia hemos participado en numerosos procesos de reorganización y liquidación judicial, con estrategias que integran la visión legal, financiera y humana.' );
	$firma .= canizales_b_p( 'Nuestro equipo interdisciplinario reúne profesionales con amplia experiencia en cargos de dirección, investigación y desarrollo. Contamos con modelos y herramientas de diagnóstico integral, con énfasis en pequeñas y medianas empresas, que permiten conocer la situación real de cada compañía y orientar sus decisiones.' );
	$firma .= canizales_b_group(
		canizales_b_p( 'Experiencia ante la Superintendencia de Sociedades', 'is-style-antetitulo' ) .
		canizales_b_p( 'Hemos actuado como <strong>auxiliares de la justicia</strong>, promotores y liquidadores designados por la Superintendencia de Sociedades. Conocemos los procesos desde adentro.', 'is-style-destacado' ),
		'is-style-panel-bosque'
	);
	$firma .= canizales_b_p( 'Plataforma de marca', 'is-style-antetitulo' );
	$firma .= canizales_b_h( 'Propósito, misión y visión' );
	$firma .= canizales_b_cols(
		array(
			canizales_b_h( 'Propósito', 3 ) . canizales_b_p( 'Aportar claridad y orientación jurídica y financiera para que las empresas puedan afrontar desafíos y tomar decisiones informadas.' ),
			canizales_b_h( 'Misión', 3 ) . canizales_b_p( 'Brindar acompañamiento jurídico y financiero, con especial atención a la insolvencia y la reorganización empresarial, mediante análisis riguroso, comunicación clara y atención profesional.' ),
			canizales_b_h( 'Visión', 3 ) . canizales_b_p( 'Consolidar a Canizales Consultores como una firma reconocida en Colombia por su criterio técnico, cercanía y capacidad de orientar procesos empresariales complejos.' ),
		)
	);
	$firma .= canizales_b_p( 'Lo que nos define', 'is-style-antetitulo' );
	$firma .= canizales_b_h( 'Tres principios en cada caso' );
	$firma .= canizales_b_list(
		array(
			'<strong>Claridad.</strong> Traducimos escenarios jurídicos y financieros complejos en información comprensible para decidir.',
			'<strong>Solidez.</strong> Rigor técnico, ética profesional y transparencia en cada etapa del proceso.',
			'<strong>Estrategia.</strong> Soluciones a la medida de cada empresa, pensadas para su continuidad y la de las personas que dependen de ella.',
		),
		true,
		'is-style-numerada'
	);

	$insolvencia  = canizales_b_p( 'Orientamos y acompañamos a empresas y personas naturales en procesos de insolvencia, con soluciones jurídicas que permiten preservar el patrimonio, reestructurar obligaciones y restablecer la estabilidad financiera conforme a la ley.', 'is-style-destacado' );
	$insolvencia .= canizales_b_p( 'Ley 1116 de 2006', 'is-style-antetitulo' );
	$insolvencia .= canizales_b_h( 'El régimen de insolvencia empresarial en Colombia' );
	$insolvencia .= canizales_b_p( 'La Ley 1116 de 2006 establece el régimen de insolvencia empresarial: un marco jurídico diseñado para recuperar y conservar las empresas viables que enfrentan dificultades económicas o financieras, y para liquidar de forma ordenada las que no pueden continuar.' );
	$insolvencia .= canizales_b_p( 'Su objetivo es proteger el crédito, promover la continuidad de la empresa y preservar el empleo, mediante procesos transparentes y equilibrados entre deudores y acreedores. La ley contempla dos mecanismos principales:' );
	$insolvencia .= canizales_b_cols(
		array(
			canizales_b_group(
				canizales_b_h( 'Reorganización empresarial', 3 ) .
				canizales_b_p( 'Busca reestructurar deudas y compromisos mediante un acuerdo con los acreedores, para restablecer la viabilidad económica de la empresa y permitir que siga operando.' ),
				'is-style-panel'
			),
			canizales_b_group(
				canizales_b_h( 'Liquidación judicial', 3 ) .
				canizales_b_p( 'Permite cerrar de manera ordenada las operaciones cuando la empresa no puede continuar, realizando sus activos para atender las obligaciones según el orden legal.' ),
				'is-style-panel'
			),
		)
	);
	$insolvencia .= canizales_b_p( 'Señales de alerta', 'is-style-antetitulo' );
	$insolvencia .= canizales_b_h( '¿Cuándo conviene evaluar un proceso de insolvencia?' );
	$insolvencia .= canizales_b_p( 'La ley prevé dos situaciones que permiten solicitar la admisión a un proceso de reorganización:' );
	$insolvencia .= canizales_b_list(
		array(
			'<strong>Cesación de pagos:</strong> incumplimiento de dos o más obligaciones con dos o más acreedores por más de noventa días, o existencia de dos o más demandas ejecutivas, cuando su valor represente al menos el 10&nbsp;% del pasivo total.',
			'<strong>Incapacidad de pago inminente:</strong> circunstancias que, razonablemente, impedirán cumplir las obligaciones en el corto plazo.',
		),
		false,
		'is-style-numerada'
	);
	$insolvencia .= canizales_b_p( 'Actuar a tiempo amplía las alternativas. Un diagnóstico temprano permite elegir el mecanismo adecuado antes de que la situación se agrave.' );
	$insolvencia .= canizales_b_p( 'Ley 1564 de 2012', 'is-style-antetitulo' );
	$insolvencia .= canizales_b_h( 'Insolvencia de persona natural no comerciante' );
	$insolvencia .= canizales_b_p( 'El Código General del Proceso regula los procedimientos judiciales civiles y comerciales en Colombia y establece el régimen de insolvencia para personas naturales no comerciantes. Este régimen ofrece tres caminos: la <strong>negociación de deudas</strong>, la <strong>convalidación de acuerdos privados</strong> y la <strong>liquidación patrimonial</strong>.' );
	$insolvencia .= canizales_b_p( 'Aplicamos sus principios para ofrecer una gestión jurídica transparente, técnica y conforme a la ley en cada etapa del procedimiento, con respeto por el debido proceso y los derechos de todas las partes.' );
	$insolvencia .= canizales_b_p( 'Cómo le acompañamos', 'is-style-antetitulo' );
	$insolvencia .= canizales_b_h( 'Mecanismos en los que tenemos experiencia' );
	$insolvencia .= canizales_b_list(
		array(
			'Acuerdos de reorganización.',
			'Procesos de liquidación judicial.',
			'Procesos de insolvencia transfronteriza.',
			'Tránsito de legislación en procesos en curso: concordatos, liquidaciones obligatorias y procesos de reestructuración.',
			'Acuerdos privados y negociaciones individuales con los acreedores.',
			'Validación judicial de acuerdos extrajudiciales de reorganización.',
			'Procesos de insolvencia de personas naturales.',
		),
		true,
		'is-style-numerada'
	);
	$insolvencia .= canizales_b_p( '<em>La información de esta página es de carácter general y no constituye asesoría jurídica para un caso particular. Cada situación requiere un análisis individual.</em>', 'has-small-font-size' );

	return array(
		'inicio'                           => array(
			'title'    => 'Inicio',
			'legacy'   => array( 'inicio' ),
			'template' => '',
			'excerpt'  => 'Asesoría jurídica y financiera en insolvencia y reorganización empresarial en Colombia desde 1999.',
			'content'  => '',
		),
		'la-firma'                         => array(
			'title'    => 'La Firma',
			'legacy'   => array( 'somos' ),
			'template' => 'templates/template-firma.php',
			'excerpt'  => 'Desde 1999 acompañamos a empresas y personas naturales en escenarios de crisis financiera con un enfoque estratégico, técnico y humano.',
			'content'  => $firma,
		),
		'insolvencia-y-reorganizacion'     => array(
			'title'    => 'Insolvencia y reorganización',
			'legacy'   => array( 'insolvencias' ),
			'template' => '',
			'excerpt'  => 'Reorganización empresarial, liquidación judicial e insolvencia de persona natural según la Ley 1116 de 2006 y el Código General del Proceso.',
			'content'  => $insolvencia,
		),
		'servicios'                        => array(
			'title'    => 'Servicios',
			'legacy'   => array( 'portafolio' ),
			'template' => 'templates/template-servicios.php',
			'excerpt'  => 'Un portafolio integral para empresas, personas naturales y organizaciones que enfrentan escenarios de crisis o buscan prevenirlos.',
			'content'  => canizales_b_p( 'Transformamos la experiencia en soluciones efectivas. Nuestro portafolio integra servicios especializados para responder a las necesidades de empresas, personas naturales y organizaciones que enfrentan escenarios de crisis o buscan prevenirlos mediante una gestión responsable.', 'is-style-destacado' ),
		),
		'recursos'                         => array(
			'title'    => 'Recursos',
			'legacy'   => array(),
			'template' => '',
			'excerpt'  => 'Artículos y guías para entender la insolvencia, la reorganización y la salud financiera de su empresa.',
			'content'  => '',
		),
		'contacto'                         => array(
			'title'    => 'Contacto',
			'legacy'   => array( 'contacto' ),
			'template' => 'templates/template-contacto.php',
			'excerpt'  => 'Cuéntenos su caso. Le orientaremos sobre las alternativas que contempla la ley para su empresa o para usted como persona natural.',
			'content'  => '',
		),
		'politica-de-tratamiento-de-datos' => array(
			'title'    => 'Política de tratamiento de datos personales',
			'legacy'   => array(),
			'template' => '',
			'status'   => 'draft',
			'excerpt'  => 'Política de tratamiento de datos personales de Canizales Consultores S.A.S., conforme a la Ley 1581 de 2012.',
			'content'  => canizales_b_p( '<strong>Borrador para revisión interna.</strong> Complete los datos marcados entre corchetes y valide el texto antes de publicar.' )
				. canizales_b_h( 'Responsable del tratamiento' )
				. canizales_b_p( 'Canizales Consultores S.A.S., NIT [NIT], con domicilio en [dirección, ciudad], correo [correo] y teléfono [teléfono].' )
				. canizales_b_h( 'Finalidades' )
				. canizales_b_p( 'Los datos suministrados a través de este sitio se usan para atender consultas, agendar asesorías, prestar los servicios contratados y enviar información relacionada cuando el titular lo autorice.' )
				. canizales_b_h( 'Derechos del titular' )
				. canizales_b_p( 'Conforme a la Ley 1581 de 2012 y el Decreto 1377 de 2013, el titular puede conocer, actualizar, rectificar y suprimir sus datos, solicitar prueba de la autorización, ser informado sobre su uso, presentar quejas ante la Superintendencia de Industria y Comercio y revocar la autorización.' )
				. canizales_b_h( 'Procedimiento para consultas y reclamos' )
				. canizales_b_p( 'Las solicitudes pueden enviarse a [correo]. Las consultas se atenderán en un plazo máximo de diez (10) días hábiles y los reclamos en un máximo de quince (15) días hábiles.' )
				. canizales_b_h( 'Vigencia' )
				. canizales_b_p( 'Esta política rige a partir del [fecha].' ),
		),
	);
}

function canizales_seed_servicios() {
	return array(
		'regimen-de-insolvencia'  => array(
			'title'   => 'Régimen de insolvencia',
			'order'   => 1,
			'excerpt' => 'Reorganización, liquidación judicial, acuerdos privados e insolvencia de persona natural bajo la Ley 1116 de 2006 y el Código General del Proceso.',
			'items'   => array(
				'Acuerdos de reorganización.',
				'Procesos de liquidación judicial.',
				'Procesos de insolvencia transfronteriza.',
				'Tránsito de legislación en procesos en curso: concordatos, liquidaciones obligatorias y procesos de reestructuración.',
				'Acuerdos privados.',
				'Negociaciones individuales con los acreedores.',
				'Validación judicial de acuerdos extrajudiciales de reorganización.',
				'Procesos de insolvencia de personas naturales.',
			),
		),
		'servicios-financieros'   => array(
			'title'   => 'Servicios financieros',
			'order'   => 2,
			'excerpt' => 'Diagnóstico, reestructuración y valoración para recuperar el equilibrio financiero y tomar decisiones con información sólida.',
			'items'   => array(
				'Diagnóstico financiero.',
				'Reestructuración financiera y de deuda.',
				'Presupuestos.',
				'Evaluación de proyectos.',
				'Valoración de empresas.',
				'Estructuración de proyectos de inversión.',
				'Gestiones de apalancamiento financiero.',
				'Constitución de patrimonios.',
			),
		),
		'servicios-tributarios'   => array(
			'title'   => 'Servicios tributarios',
			'order'   => 3,
			'excerpt' => 'Normalización de la empresa ante los organismos del Estado, con planeación tributaria y organización interna.',
			'items'   => array(
				'Planeación tributaria.',
				'Elaboración y revisión de declaraciones de renta.',
				'Solicitud de devolución de saldos a favor ante la DIAN.',
			),
		),
		'servicios-juridicos'     => array(
			'title'   => 'Servicios jurídicos',
			'order'   => 4,
			'excerpt' => 'Acompañamiento societario y jurídico para la constitución, organización y gobierno de su empresa.',
			'items'   => array(
				'Estudio de títulos.',
				'Constitución de sociedades.',
				'Reformas estatutarias.',
				'Conciliación y arbitraje.',
				'Representación en juntas directivas.',
				'Registro de marcas y patentes.',
			),
		),
		'servicios-contables'     => array(
			'title'   => 'Servicios contables',
			'order'   => 5,
			'excerpt' => 'Información contable confiable como base para el diagnóstico, la planeación y los procesos de insolvencia.',
			'items'   => array(
				'Preparación y análisis de estados financieros.',
				'Organización y depuración contable.',
				'Soporte contable en procesos de reorganización y liquidación.',
			),
		),
		'servicios-administrativos' => array(
			'title'   => 'Servicios administrativos',
			'order'   => 6,
			'excerpt' => 'Gestión de cartera y apoyo administrativo para fortalecer el flujo de caja de la organización.',
			'items'   => array(
				'Recuperación de cartera.',
			),
		),
	);
}

function canizales_seed_post() {
	return array(
		'slug'    => 'senales-de-alerta-financiera',
		'title'   => '5 señales de alerta financiera en su empresa',
		'excerpt' => 'Identificar a tiempo estas señales amplía las alternativas disponibles y permite tomar decisiones antes de que la situación se agrave.',
		'content' => canizales_b_p( 'Las dificultades financieras rara vez aparecen de un día para otro. Casi siempre hay señales previas que, identificadas a tiempo, amplían las alternativas disponibles para la empresa.', 'is-style-destacado' )
			. canizales_b_h( '1. El flujo de caja no alcanza para las obligaciones corrientes' )
			. canizales_b_p( 'Cuando la nómina, los proveedores o los impuestos se pagan con créditos de corto plazo o con retrasos recurrentes, la operación está consumiendo más liquidez de la que genera.' )
			. canizales_b_h( '2. Obligaciones vencidas por más de noventa días' )
			. canizales_b_p( 'La Ley 1116 de 2006 considera la cesación de pagos cuando existen dos o más obligaciones vencidas con dos o más acreedores por más de noventa días, que representen al menos el 10&nbsp;% del pasivo total.' )
			. canizales_b_h( '3. Demandas ejecutivas o embargos' )
			. canizales_b_p( 'La llegada de procesos ejecutivos es una alerta seria: los embargos pueden paralizar la operación y afectar activos clave para la continuidad.' )
			. canizales_b_h( '4. Refinanciaciones sucesivas' )
			. canizales_b_p( 'Refinanciar una y otra vez sin cambiar la estructura de costos o de deuda solo aplaza el problema y suele encarecerlo.' )
			. canizales_b_h( '5. Decisiones sin información confiable' )
			. canizales_b_p( 'Si la contabilidad está atrasada o no refleja la realidad, es difícil saber qué tan grave es la situación y qué camino conviene.' )
			. canizales_b_h( '¿Qué hacer?' )
			. canizales_b_p( 'Un diagnóstico jurídico y financiero temprano permite evaluar si conviene una negociación directa con los acreedores, un acuerdo privado o un proceso de reorganización empresarial. Actuar a tiempo es, casi siempre, la mejor decisión.' ),
	);
}

/* -------------------------------------------------------------------------
 * Ejecución
 * ---------------------------------------------------------------------- */

function canizales_find_page( $slugs ) {
	foreach ( (array) $slugs as $slug ) {
		$found = get_posts(
			array(
				'post_type'      => 'page',
				'name'           => $slug,
				'post_status'    => array( 'publish', 'draft', 'private', 'pending' ),
				'posts_per_page' => 1,
			)
		);
		if ( $found ) {
			return $found[0];
		}
	}
	return null;
}

function canizales_run_seed( $replace = true, $permalinks = true ) {
	$log = array();
	$ids = array();

	foreach ( canizales_seed_pages() as $slug => $page ) {
		$existing = canizales_find_page( array_merge( array( $slug ), $page['legacy'] ) );
		$status   = isset( $page['status'] ) ? $page['status'] : 'publish';
		$data     = array(
			'post_type'    => 'page',
			'post_title'   => $page['title'],
			'post_name'    => $slug,
			'post_excerpt' => $page['excerpt'],
			'post_content' => $page['content'],
		);

		if ( $existing ) {
			$ids[ $slug ] = $existing->ID;
			if ( $replace || $existing->post_name !== $slug ) {
				$data['ID'] = $existing->ID;
				if ( ! $replace ) {
					unset( $data['post_content'], $data['post_excerpt'] );
				}
				wp_update_post( wp_slash( $data ) );
				/* translators: %s: título de la página */
				$log[] = sprintf( __( 'Página actualizada: %s (la versión anterior queda en Revisiones)', 'canizales' ), $page['title'] );
			}
		} else {
			$data['post_status'] = $status;
			$ids[ $slug ]        = wp_insert_post( wp_slash( $data ) );
			/* translators: %s: título de la página */
			$log[] = sprintf( __( 'Página creada: %s', 'canizales' ), $page['title'] . ( 'draft' === $status ? ' (borrador)' : '' ) );
		}

		if ( ! empty( $ids[ $slug ] ) && ! is_wp_error( $ids[ $slug ] ) ) {
			update_post_meta( $ids[ $slug ], '_wp_page_template', $page['template'] ? $page['template'] : 'default' );
		}
	}

	foreach ( canizales_seed_servicios() as $slug => $servicio ) {
		$existing = get_page_by_path( $slug, OBJECT, 'servicio' );
		if ( $existing && ! $replace ) {
			continue;
		}
		$data = array(
			'post_type'    => 'servicio',
			'post_status'  => 'publish',
			'post_title'   => $servicio['title'],
			'post_name'    => $slug,
			'post_excerpt' => $servicio['excerpt'],
			'menu_order'   => $servicio['order'],
			'post_content' => canizales_b_p( $servicio['excerpt'], 'is-style-destacado' ) . canizales_b_list( $servicio['items'], true, 'is-style-numerada' ),
		);
		if ( $existing ) {
			$data['ID'] = $existing->ID;
			wp_update_post( wp_slash( $data ) );
		} else {
			wp_insert_post( wp_slash( $data ) );
		}
		/* translators: %s: nombre del servicio */
		$log[] = sprintf( __( 'Servicio listo: %s', 'canizales' ), $servicio['title'] );
	}

	$post = canizales_seed_post();
	if ( ! get_page_by_path( $post['slug'], OBJECT, 'post' ) ) {
		wp_insert_post(
			wp_slash(
				array(
					'post_type'    => 'post',
					'post_status'  => 'publish',
					'post_title'   => $post['title'],
					'post_name'    => $post['slug'],
					'post_excerpt' => $post['excerpt'],
					'post_content' => $post['content'],
				)
			)
		);
		$log[] = __( 'Artículo de ejemplo publicado en Recursos.', 'canizales' );
	}

	if ( ! empty( $ids['inicio'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $ids['inicio'] );
	}
	if ( ! empty( $ids['recursos'] ) ) {
		update_option( 'page_for_posts', $ids['recursos'] );
	}
	if ( ! empty( $ids['politica-de-tratamiento-de-datos'] ) ) {
		update_option( 'wp_page_for_privacy_policy', $ids['politica-de-tratamiento-de-datos'] );
	}
	$log[] = __( 'Portada y página de Recursos asignadas.', 'canizales' );

	$menu_name = 'Principal';
	$menu      = wp_get_nav_menu_object( $menu_name );
	if ( ! $menu ) {
		$menu_id = wp_create_nav_menu( $menu_name );
		foreach ( array( 'la-firma', 'insolvencia-y-reorganizacion', 'servicios', 'recursos', 'contacto' ) as $position => $slug ) {
			if ( empty( $ids[ $slug ] ) ) {
				continue;
			}
			$labels = array(
				'insolvencia-y-reorganizacion' => 'Insolvencia',
			);
			wp_update_nav_menu_item(
				$menu_id,
				0,
				array(
					'menu-item-object-id' => $ids[ $slug ],
					'menu-item-object'    => 'page',
					'menu-item-type'      => 'post_type',
					'menu-item-status'    => 'publish',
					'menu-item-position'  => $position + 1,
					'menu-item-title'     => isset( $labels[ $slug ] ) ? $labels[ $slug ] : '',
				)
			);
		}
		$log[] = __( 'Menú principal creado.', 'canizales' );
	} else {
		$menu_id = $menu->term_id;
	}
	$locations              = get_theme_mod( 'nav_menu_locations', array() );
	$locations['principal'] = $menu_id;
	set_theme_mod( 'nav_menu_locations', $locations );

	if ( $permalinks && '/%postname%/' !== get_option( 'permalink_structure' ) ) {
		global $wp_rewrite;
		$wp_rewrite->set_permalink_structure( '/%postname%/' );
		$log[] = __( 'Enlaces permanentes cambiados a /nombre-de-la-pagina/. Los enlaces antiguos (?page_id=) siguen redirigiendo.', 'canizales' );
	}
	canizales_register_post_types();
	flush_rewrite_rules();

	update_option( 'canizales_seeded', CANIZALES_VERSION );

	return $log;
}

/* -------------------------------------------------------------------------
 * Pantalla de administración
 * ---------------------------------------------------------------------- */

function canizales_setup_menu() {
	add_theme_page(
		__( 'Configurar Canizales', 'canizales' ),
		__( 'Configurar Canizales', 'canizales' ),
		'manage_options',
		'canizales-setup',
		'canizales_setup_screen'
	);
}
add_action( 'admin_menu', 'canizales_setup_menu' );

function canizales_setup_screen() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$log = null;
	if ( isset( $_POST['canizales_setup_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['canizales_setup_nonce'] ) ), 'canizales_setup' ) ) {
		$log = canizales_run_seed( ! empty( $_POST['reemplazar'] ), ! empty( $_POST['permalinks'] ) );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Configurar Canizales Consultores', 'canizales' ); ?></h1>

		<?php if ( $log ) : ?>
			<div class="notice notice-success"><p><strong><?php esc_html_e( 'Listo.', 'canizales' ); ?></strong></p><ul style="list-style:disc;padding-left:20px">
				<?php foreach ( $log as $line ) : ?>
					<li><?php echo esc_html( $line ); ?></li>
				<?php endforeach; ?>
			</ul><p><a class="button button-primary" href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank"><?php esc_html_e( 'Ver el sitio', 'canizales' ); ?></a></p></div>
		<?php endif; ?>

		<p style="max-width:720px"><?php esc_html_e( 'Esta herramienta prepara el sitio con el contenido revisado: páginas (Inicio, La Firma, Insolvencia y reorganización, Servicios, Recursos, Contacto), los seis servicios, un artículo de ejemplo, el menú principal y la portada.', 'canizales' ); ?></p>
		<p style="max-width:720px"><?php esc_html_e( 'Las páginas antiguas (Somos, Portafolio, Insolvencias) se reutilizan y renombran para conservar sus enlaces. El contenido anterior queda guardado en las revisiones de cada página.', 'canizales' ); ?></p>

		<form method="post">
			<?php wp_nonce_field( 'canizales_setup', 'canizales_setup_nonce' ); ?>
			<p><label><input type="checkbox" name="reemplazar" value="1" checked> <?php esc_html_e( 'Reemplazar el contenido de las páginas y servicios existentes', 'canizales' ); ?></label></p>
			<p><label><input type="checkbox" name="permalinks" value="1" checked> <?php esc_html_e( 'Usar enlaces amigables (/la-firma/ en lugar de ?page_id=17)', 'canizales' ); ?></label></p>
			<?php submit_button( __( 'Configurar sitio', 'canizales' ) ); ?>
		</form>

		<h2><?php esc_html_e( 'Después de configurar', 'canizales' ); ?></h2>
		<ol style="max-width:720px">
			<li><?php esc_html_e( 'Complete correo, dirección y redes en Apariencia → Personalizar → Canizales Consultores.', 'canizales' ); ?></li>
			<li><?php esc_html_e( 'Suba el logo vectorial en Apariencia → Personalizar → Identidad del sitio.', 'canizales' ); ?></li>
			<li><?php esc_html_e( 'Revise y publique el borrador de la Política de tratamiento de datos.', 'canizales' ); ?></li>
			<li><?php esc_html_e( 'Desactive los plugins que ya no se necesitan (Stackable, el botón de WhatsApp anterior).', 'canizales' ); ?></li>
		</ol>
	</div>
	<?php
}

function canizales_setup_notice() {
	if ( get_option( 'canizales_seeded' ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( $screen && 'appearance_page_canizales-setup' === $screen->id ) {
		return;
	}
	printf(
		'<div class="notice notice-info"><p><strong>Canizales Consultores:</strong> %s <a class="button button-primary" href="%s">%s</a></p></div>',
		esc_html__( 'el tema está activo. Falta preparar el contenido del sitio.', 'canizales' ),
		esc_url( admin_url( 'themes.php?page=canizales-setup' ) ),
		esc_html__( 'Configurar ahora', 'canizales' )
	);
}
add_action( 'admin_notices', 'canizales_setup_notice' );
