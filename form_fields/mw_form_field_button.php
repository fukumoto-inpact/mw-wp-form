<?php
/**
 * Name: MW Form Field Button
 * URI: http://2inc.org
 * Description: ボタンを出力。
 * Version: 1.2.3
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created : December 14, 2012
 * Modified: December 22, 2013
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
class mw_form_field_button extends mw_form_field {

	/**
	 * String $shortcode_name
	 */
	protected $shortcode_name = 'mwform_button';

	/**
	 * __construct
	 */
	public function __construct() {
		parent::__construct();
		$this->set_qtags(
			$this->shortcode_name,
			'Button',
			$this->shortcode_name . ' name=""'
		);
	}

	/**
	 * setDefaults
	 * $this->defaultsを設定し返す
	 * @return	Array	defaults
	 */
	protected function setDefaults() {
		return array(
			'name'  => '',
			'value' => '',
		);
	}

	/**
	 * inputPage
	 * 入力ページでのフォーム項目を返す
	 * @return	String	HTML
	 */
	protected function inputPage() {
		return $this->Form->button( $this->atts['name'], $this->atts['value'] );
	}

	/**
	 * confirmPage
	 * 確認ページでのフォーム項目を返す
	 * @return	String	HTML
	 */
	protected function confirmPage() {
		return $this->inputPage();
	}
}
