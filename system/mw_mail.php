<?php
/**
 * Name: MW Mail
 * URI: http://2inc.org
 * Description: メールクラス
 * Version: 1.3
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created: July 20, 2012
 * Modified: May 29, 2013
 * License: GPL2
 *
 * Copyright 2013 Takashi Kitajima (email : inc@2inc.org)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
class MW_Mail {

	public $to;				// 宛先
	public $from;			// 送信元
	public $sender;			// 送信者
	public $subject;		// 題名
	public $body;			// 本文
	public $attachments;	// 添付
	// private $targetEncodeing = 'ISO-2022-JP';
	private $ENCODE = 'utf-8';

	/**
	 * send
	 * メール送信
	 */
	public function send() {
		if ( !$this->to ) return;
		/*
		mb_language( 'ja' );
		mb_internal_encoding( $this->ENCODE );
		$subject = mb_encode_mimeheader( $this->subject );
		$body = base64_encode( $this->body );
		$body = mb_convert_encoding( $this->body, $this->targetEncodeing, $this->ENCODE );
		*/
		$subject = $this->subject;
		$body = $this->body;

		$fromHeader = '';
		if ( !empty( $this->from ) ) {
			if ( empty( $this->sender ) ) {
				$fromHeader = $this->from;
			} else if ( !empty( $this->sender ) ) {
				// $sender = mb_encode_mimeheader( $this->sender );
				$sender = $this->sender;
				$fromHeader = $sender.' <'.$this->from.'>';
			}
		}

		$header = '';
		/*
		$header .= "Content-Type: text/plain;charset=".$this->targetEncodeing."\n";
		$header .= "Content-Transfer-Encoding: 7bit\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "X-Mailer:PHP\n";
		*/
		$header .= "From:" . $fromHeader . "\n";
		$to = explode( ',', $this->to );
		if ( isset( $to[0] ) ) {
			$to = trim( $to[0] );
			wp_mail( $to, $subject, $body, $header, $this->attachments );
			// mail( $to, $subject, $body, $header );
		}
	}

	/**
	 * createBody
	 * 配列からbodyを生成
	 * @param	Array ( 見出し => 内容, … )
	 * 			Array ( 'exclude' => array( 除外したいキー1, … ) )
	 */
	public function createBody( Array $array, Array $options = array() ) {
		$_ret = '';
		$defaults = array(
			'exclude' => array()
		);
		$options = array_merge( $defaults, $options );
		foreach( $array as $key => $value ) {
			if ( in_array( $key, $options['exclude'] ) ) continue;
			if ( is_array( $value ) && array_key_exists( 'data', $value ) && array_key_exists( 'separator', $value ) ) {
				if ( is_array( $value['data'] ) ) {
					foreach ( $value['data'] as $_val ) {
						if ( !( $_val === '' || $_val === null ) ) {
							$value = implode( $value['separator'], $value['data'] );
							break;
						}
						$value = '';
					}
				} else {
					$value = $value['data'];
				}
			}
			$_ret .= sprintf( "▼%s\n%s\n\n", $this->e( $key ), $this->e( $value ) );
		}
		return $_ret;
	}

	/**
	 * e
	 * htmlサニタイズ
	 * @param	Mixed
	 * @return	Mixed
	 */
	public function e( $str ){
		if ( is_array( $str ) ) {
			return array_map( array( $this, 'e' ), $str );
		} else {
			$str = stripslashes( $str );
			return htmlspecialchars( $str, ENT_QUOTES, $this->ENCODE );
		}
	}
}
?>