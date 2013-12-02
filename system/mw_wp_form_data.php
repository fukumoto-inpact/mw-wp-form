<?php
/**
 * Name: MW WP Form Data
 * URI: http://2inc.org
 * Description: mw_wp_form のデータ操作用
 * Version: 1.0.1
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : October 10, 2013
 * Modified: November 22, 2013
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
class mw_wp_form_data {
	private $data;
	private $Session;

	/**
	 * __construct
	 * @param    String    $key    データのキー
	 */
	public function __construct( $key ) {
		$this->Session = MW_Session::start( $key );
	}

	/**
	 * getValue
	 * データを取得
	 * @param    String    $key    データのキー
	 * @return   String    データ
	 */
	public function getValue( $key ) {
		if ( isset( $this->data[$key] ) )
			return $this->data[$key];
	}

	/**
	 * getValues
	 * 全てのデータを取得
	 * @return   Array   データ
	 */
	public function getValues() {
		if ( $this->data === null)
			return array();
		return $this->data;
	}

	/**
	 * setValue
	 * データを追加
	 * @param    String    $key    データのキー
	 * @param    String    $value  値
	 */
	public function setValue( $key, $value ){
		$this->data[$key] = $value;
		$this->Session->setValue( $key, $value );
	}

	/**
	 * setValue
	 * 複数のデータを一括で追加
	 * @param    Array    値
	 */
	public function setValues( Array $array ) {
		foreach ( $array as $key => $value ) {
			$this->data[$key] = $value;
			$this->Session->setValue( $key, $value );
		}
	}

	/**
	 * clearValue
	 * データを消す
	 * @param    String    $key    データのキー
	 */
	public function clearValue( $key ) {
		unset( $this->data[$key] );
		$this->Session->clearValue( $key );
	}

	/**
	 * clearValues
	 * データを消す
	 * @param    String    $key    データのキー
	 */
	public function clearValues() {
		unset( $this->data );
		$this->Session->clearValues();
	}

	/**
	 * pushValue
	 * 指定した $key をキーと配列にデータを追加
	 * @param    String    $key    データのキー
	 * @param    String    $value  値
	 */
	public function pushValue( $key, $value ) {
		$this->data[$key][] = $value;
		$this->Session->pushValue( $key, $value );
	}
}
