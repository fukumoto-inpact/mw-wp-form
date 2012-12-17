<?php
/**
 * Name: MW Form Field Password
 * URI: http://2inc.org
 * Description: パスワードフィールドを出力。
 * Version: 1.0
 * Author: Takashi Kitajima
 * Author URI: http://2inc.org
 * Created: December 14, 2012
 * License: GPL2
 *
 * Copyright 2012 Takashi Kitajima (email : inc@2inc.org)
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
class mw_form_field_password extends mw_form_field {

	/**
	 * setDefaults
	 * $this->defaultsを設定し返す
	 * @return	Array	defaults
	 */
	protected function setDefaults() {
		return array(
			'name'       => '',
			'size'       => 60,
			'maxlength'  => 255,
			'value'      => '',
			'show_error' => 'true',
		);
	}

	/**
	 * inputPage
	 * 入力ページでのフォーム項目を返す
	 * @return	String	HTML
	 */
	protected function inputPage() {
		$_ret = $this->Form->password( $this->atts['name'], array(
			'size'      => $this->atts['size'],
			'maxlength' => $this->atts['maxlength'],
			'value'     => $this->atts['value'],
		) );
		if ( $this->atts['show_error'] !== 'false' )
			$_ret .= $this->getError( $this->atts['name'] );
		return $_ret;
	}

	/**
	 * previewPage
	 * 確認ページでのフォーム項目を返す
	 * @return	String	HTML
	 */
	protected function previewPage() {
		$value = $this->Form->getValue( $this->atts['name'] );
		return '*****' . $this->Form->hidden( $this->atts['name'], $this->atts );
	}
}
