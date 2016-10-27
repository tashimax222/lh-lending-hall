<div class="wrap">
	<h2>貸し施設設定</h2>


	<form id="lh-lending-hall-master-form" action="" method="post">
		<?php wp_nonce_field( 'my-nonce-key' , 'lh-lending-hall-master'); ?>
		<h3>施設名</h3>
		<?php $options = get_option( lh_config::options ); ?>
		<p>施設1： <input type="text" name="lh_options[lh-facility1]" value="<?php echo esc_attr( $options['lh-facility1'] ); ?>"></p>
		<p>施設2： <input type="text" name="lh_options[lh-facility2]" value="<?php echo esc_attr( $options['lh-facility2'] ); ?>"></p>
		<p>施設3： <input type="text" name="lh_options[lh-facility3]" value="<?php echo esc_attr( $options['lh-facility3'] ); ?>"></p>
		<p>施設4： <input type="text" name="lh_options[lh-facility4]" value="<?php echo esc_attr( $options['lh-facility4'] ); ?>"></p>
		<p>施設5： <input type="text" name="lh_options[lh-facility5]" value="<?php echo esc_attr( $options['lh-facility5'] ); ?>"></p>
		<p>施設6： <input type="text" name="lh_options[lh-facility6]" value="<?php echo esc_attr( $options['lh-facility6'] ); ?>"></p>
		<p>施設7： <input type="text" name="lh_options[lh-facility7]" value="<?php echo esc_attr( $options['lh-facility7'] ); ?>"></p>
		<p>施設8： <input type="text" name="lh_options[lh-facility8]" value="<?php echo esc_attr( $options['lh-facility8'] ); ?>"></p>
		<p>施設9： <input type="text" name="lh_options[lh-facility9]" value="<?php echo esc_attr( $options['lh-facility9'] ); ?>"></p>
		<p>施設10：<input type="text" name="lh_options[lh-facility10]" value="<?php echo esc_attr( $options['lh-facility10'] ); ?>"></p>

		<h3>時間帯</h3>
		<p>項目1：<input type="text" name="lh_options[lh-item1]" value="<?php echo esc_attr( $options['lh-item1'] ); ?>"></p>
		<p>項目2：<input type="text" name="lh_options[lh-item2]" value="<?php echo esc_attr( $options['lh-item2'] ); ?>"></p>
		<p>項目3：<input type="text" name="lh_options[lh-item3]" value="<?php echo esc_attr( $options['lh-item3'] ); ?>"></p>
		<p>項目4：<input type="text" name="lh_options[lh-item4]" value="<?php echo esc_attr( $options['lh-item4'] ); ?>"></p>

		<h3>月送り制限</h3>

		<p>次の月：
			<select name="lh_options[lh-nextmonthlimit]" id="lh-nextmonthlimit">
					<option value="0" <?php selected( 0, $options['lh-nextmonthlimit'] ); ?> >0</option>
					<option value="1" <?php selected( 1, $options['lh-nextmonthlimit'] ); ?> >1</option>
					<option value="2" <?php selected( 2, $options['lh-nextmonthlimit'] ); ?> >2</option>
					<option value="3" <?php selected( 3, $options['lh-nextmonthlimit'] ); ?> >3</option>
					<option value="4" <?php selected( 4, $options['lh-nextmonthlimit'] ); ?> >4</option>
					<option value="5" <?php selected( 5, $options['lh-nextmonthlimit'] ); ?> >5</option>
					<option value="6" <?php selected( 6, $options['lh-nextmonthlimit'] ); ?> >6</option>
					<option value="7" <?php selected( 7, $options['lh-nextmonthlimit'] ); ?> >7</option>
					<option value="8" <?php selected( 8, $options['lh-nextmonthlimit'] ); ?> >8</option>
					<option value="9" <?php selected( 9, $options['lh-nextmonthlimit'] ); ?> >9</option>
					<option value="10" <?php selected( 10, $options['lh-nextmonthlimit'] ); ?> >10</option>
					<option value="11" <?php selected( 11, $options['lh-nextmonthlimit'] ); ?> >11</option>
					<option value="12" <?php selected( 12, $options['lh-nextmonthlimit'] ); ?> >12</option>
			</select>ヶ月先まで
		</p>

		<p>前の月：
			<select name="lh_options[lh-prevmonthlimit]" id="lh-prevmonthlimit">
					<option value="0" <?php selected( 0, $options['lh-prevmonthlimit'] ); ?> >0</option>
					<option value="1" <?php selected( 1, $options['lh-prevmonthlimit'] ); ?> >1</option>
					<option value="2" <?php selected( 2, $options['lh-prevmonthlimit'] ); ?> >2</option>
					<option value="3" <?php selected( 3, $options['lh-prevmonthlimit'] ); ?> >3</option>
					<option value="4" <?php selected( 4, $options['lh-prevmonthlimit'] ); ?> >4</option>
					<option value="5" <?php selected( 5, $options['lh-prevmonthlimit'] ); ?> >5</option>
					<option value="6" <?php selected( 6, $options['lh-prevmonthlimit'] ); ?> >6</option>
					<option value="7" <?php selected( 7, $options['lh-prevmonthlimit'] ); ?> >7</option>
					<option value="8" <?php selected( 8, $options['lh-prevmonthlimit'] ); ?> >8</option>
					<option value="9" <?php selected( 9, $options['lh-prevmonthlimit'] ); ?> >9</option>
					<option value="10" <?php selected( 10, $options['lh-prevmonthlimit'] ); ?> >10</option>
					<option value="11" <?php selected( 11, $options['lh-prevmonthlimit'] ); ?> >11</option>
					<option value="12" <?php selected( 12, $options['lh-prevmonthlimit'] ); ?> >12</option>
			</select>ヶ月先まで
		</p>


		<p class="submit">
			<input name="Submit" type="submit" class="button button-primary button-large" value="<?php echo esc_attr( __( '更新', 'lh-lending-hall') ); ?>" />
		</p>
	</form>
</div>

<?php
/*
function setting_nextmonthlimit() {
	$options = 'arr-lending-hall';
	$items = array("0", "1", "2", "3","4", "5", "6", "7", "8", "9", "10", "11", "12");
	echo "<select id='nextmonthlimit' name='lending_hall_options[nextmonthlimit]'>";
	foreach($items as $item) {
		$selected = ($options['nextmonthlimit'] == $item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
	echo "ヶ月先まで";
}
*/

?>