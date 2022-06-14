<?php

class STM_Theme_Changelog {
	private static $chlgTransientName = 'theme_changelog';

	public static function init() {
		add_action( 'admin_init', array( self::class, 'request_theme_changelog' ) );
	}

	public static function request_theme_changelog() {
		$res = get_transient( self::$chlgTransientName );

		if ( ! $res ) {
			$res = wp_remote_request( SERVICE_URL . strtolower( STM_THEME_NAME ) . '.json', array( 'sslverify' => false ) );

			if ( isset( $res['body'] ) && ! empty( $res['body'] ) ) {
				set_transient( self::$chlgTransientName, $res['body'], DAY_IN_SECONDS );
			}
		}
	}

	public static function get_theme_changelog() {
		$res = get_transient( self::$chlgTransientName );

		$newChangelogData = array();
		$chlg             = array();

		foreach ( json_decode( $res )->document->document->nodes as $node ) {
			if ( $node->type == 'heading-1' ) {
				$chlg['heading'] = $node->nodes[0]->ranges[0]->text;
			} elseif ( $node->type == 'paragraph' ) {
				$chlg['date'] = $node->nodes[0]->ranges[0]->text;
			} elseif ( $node->type == 'list-unordered' ) {
				foreach ( $node->nodes as $node_2 ) {
					foreach ( $node_2->nodes as $node_2 ) {
						$str = '';
						foreach ( $node_2->nodes as $k => $node_3 ) {
							if ( ! empty( $node_3->ranges ) ) {
								foreach ( $node_3->ranges as $list_item ) {
									if ( count( $list_item->marks ) > 0 && ! preg_match( "/[0-9]+$/", $list_item->text ) ) {
										$str .= sprintf( '<b>%s:</b>', str_replace( array(
											':',
											'ED'
										), '', $list_item->text ) );
									} else {
										$str .= str_replace( ':', '', $list_item->text );
									}
								}
							} else {
								foreach ( $node_3->nodes as $node_4 ) {
									if ( ! empty( $node_4->ranges ) ) {
										foreach ( $node_4->ranges as $list_item ) {
											$str .= str_replace( ':', '', $list_item->text );
										}
									}
								}

							}

						}

						$chlg['list'][] = $str;
					}
				}
				$newChangelogData[] = $chlg;
				$chlg               = array();
			}

		}

		return $newChangelogData;
	}
}