<?php
	$options = get_option( lh_config::options );
	$lh_calendar_options_name = 'lh_calendar_options';
	$options_calendar = get_option( $lh_calendar_options_name );
?>
<div class="wrap">
	<h2>空き状況管理</h2>
  <h3>
		施設名:
		<?php
			if ( isset ($_GET['lh-facility']) && $_GET['lh-facility']) {
				echo esc_attr( $options[ $_GET['lh-facility'] ] );
				$lh_facility = $_GET['lh-facility'];
			}else{
				echo esc_attr( $options['lh-facility1'] );
				$lh_facility = 'lh-facility1';
			}
		?>
	</h3>


  <?php

  try {
    if (!isset($_GET['t']) || !preg_match('/\A\d{4}-\d{2}\z/', $_GET['t'])) {
      throw new Exception();
    }
    $thisMonth = new DateTime($_GET['t']);
  } catch (Exception $e) {
    $thisMonth = new DateTime('first day of this month');
  }


  $dtday = new DateTime('first day of this month');
	$lh_nextmonthlimit = esc_attr( $options['lh-nextmonthlimit'] ) +1;
	$lh_prev_limit = $dtday->modify('-' . $lh_nextmonthlimit . ' month')->format('Y-m');

	$dtday = new DateTime('first day of this month');
	$lh_prevmonthlimit = esc_attr( $options['lh-prevmonthlimit'] ) +1;
	$lh_next_limit = $dtday->modify( '+' . $lh_prevmonthlimit . ' month')->format('Y-m');


  $dt = clone $thisMonth;
  $prev = $dt->modify('-1 month')->format('Y-m');

  $dt = clone $thisMonth;
  $next = $dt->modify('+1 month')->format('Y-m');


  /* 現在の年、月を取得 */
  $year = $thisMonth->format('Y');
  $month = $thisMonth->format('m');


  /* 現在の月の1日目の曜日を割り出すため現在の日付を1日目として設定する */
  $thisMonth->setDate($year, $month, 1);
  $firstWeekDay = (int)$thisMonth->format('w');
  $lastDay = (int)$thisMonth->format('t');
  ?>

	<div class="lh_hall_box">
		<ul>
	    <li <?php if($lh_facility == 'lh-facility1'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility1&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility1'] ); ?>
				</a>
			</li>
			<li <?php if($lh_facility == 'lh-facility2'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility2&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility2'] ); ?>
				</a>
			</li>
			<li <?php if($lh_facility == 'lh-facility3'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility3&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility3'] ); ?>
				</a>
			</li>
			<li <?php if($lh_facility == 'lh-facility4'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility4&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility4'] ); ?>
				</a>
			</li>
			<li <?php if($lh_facility == 'lh-facility5'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility5&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility5'] ); ?>
				</a>
			</li>
			<li <?php if($lh_facility == 'lh-facility6'): ?>class="current_link"<?php endif; ?>>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=lh-facility6&t=<?php echo $year . '-' . $month; ?>">
				<?php echo esc_attr( $options['lh-facility6'] ); ?>
				</a>
			</li>
	  </ul>
	</div>

	<div class="lh_ym_box">
		<ul>
		  <li>
				<?php if($prev != $lh_prev_limit): ?>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=<?php echo $lh_facility; ?>&t=<?php echo $prev; ?>">< <?php echo $prev; ?></a>
				<?php else: ?>
				<?php endif; ?>
			</li>
			<li><strong><?php echo $year.'年'.$month.'月'; ?></strong></li>
			<li>
				<?php if($next != $lh_next_limit): ?>
				<a href="./admin.php?page=lh-lending-hall&lh-facility=<?php echo $lh_facility; ?>&t=<?php echo $next; ?>"><?php echo $next; ?> ></a>
				<?php else: ?>
				<?php endif; ?>
			</li>
		</ul>
	</div>



	<form id="lh-lending-hall-form" action="" method="post">
		<?php wp_nonce_field( 'my-nonce-key' , 'lh-lending-hall'); ?>

	  <table class="wp-list-table widefat fixed striped posts">
	    <tr>
	      <th>日付</th>
	      <th>曜日</th>
	      <th><?php echo esc_attr( $options['lh-item1'] ); ?></th>
	      <th><?php echo esc_attr( $options['lh-item2'] ); ?></th>
	      <th><?php echo esc_attr( $options['lh-item3'] ); ?></th>
				<th><?php echo esc_attr( $options['lh-item4'] ); ?></th>
	    </tr>
	    <?php
	    for ($i=1; $i<=$lastDay; $i++) {
	      $week = date("w", mktime(0, 0, 0, $month, $i, $year));
	      $weekjp_array = array('日', '月', '火', '水', '木', '金', '土');
	      $weekjp = $weekjp_array[$week];
	    ?>
	      <tr class="<?php if($week == 0):?> sunday_color<?php endif; ?><?php if($week == 6):?> saturday_color<?php endif; ?>">
	        <th><?php echo $i; ?></th>
	        <td><?php echo $weekjp; ?></td>
	        <td>
						<select name="<?php echo $lh_calendar_options_name; ?>[lh-calendar][<?php echo $lh_facility; ?>][lh-item1][<?php echo $year; ?>][<?php echo $month; ?>][<?php echo $i; ?>]" id="lh_calendar">
								<option value="0" <?php selected( 0, $options_calendar['lh-calendar'][$lh_facility]['lh-item1'][$year][$month][$i] ); ?> >◯</option>
								<option value="1" <?php selected( 1, $options_calendar['lh-calendar'][$lh_facility]['lh-item1'][$year][$month][$i] ); ?> >☓</option>
								<option value="2" <?php selected( 2, $options_calendar['lh-calendar'][$lh_facility]['lh-item1'][$year][$month][$i] ); ?> >△</option>
								<option value="3" <?php selected( 3, $options_calendar['lh-calendar'][$lh_facility]['lh-item1'][$year][$month][$i] ); ?> >--</option>
						</select>
					</td>
					<td>
						<select name="<?php echo $lh_calendar_options_name; ?>[lh-calendar][<?php echo $lh_facility; ?>][lh-item2][<?php echo $year; ?>][<?php echo $month; ?>][<?php echo $i; ?>]" id="lh_calendar">
								<option value="0" <?php selected( 0, $options_calendar['lh-calendar'][$lh_facility]['lh-item2'][$year][$month][$i] ); ?> >◯</option>
								<option value="1" <?php selected( 1, $options_calendar['lh-calendar'][$lh_facility]['lh-item2'][$year][$month][$i] ); ?> >☓</option>
								<option value="2" <?php selected( 2, $options_calendar['lh-calendar'][$lh_facility]['lh-item2'][$year][$month][$i] ); ?> >△</option>
								<option value="3" <?php selected( 3, $options_calendar['lh-calendar'][$lh_facility]['lh-item2'][$year][$month][$i] ); ?> >--</option>
						</select>
					</td>
					<td>
						<select name="<?php echo $lh_calendar_options_name; ?>[lh-calendar][<?php echo $lh_facility; ?>][lh-item3][<?php echo $year; ?>][<?php echo $month; ?>][<?php echo $i; ?>]" id="lh_calendar">
								<option value="0" <?php selected( 0, $options_calendar['lh-calendar'][$lh_facility]['lh-item3'][$year][$month][$i] ); ?> >◯</option>
								<option value="1" <?php selected( 1, $options_calendar['lh-calendar'][$lh_facility]['lh-item3'][$year][$month][$i] ); ?> >☓</option>
								<option value="2" <?php selected( 2, $options_calendar['lh-calendar'][$lh_facility]['lh-item3'][$year][$month][$i] ); ?> >△</option>
								<option value="3" <?php selected( 3, $options_calendar['lh-calendar'][$lh_facility]['lh-item3'][$year][$month][$i] ); ?> >--</option>
						</select>
					</td>
					<td>
						<select name="<?php echo $lh_calendar_options_name; ?>[lh-calendar][<?php echo $lh_facility; ?>][lh-item4][<?php echo $year; ?>][<?php echo $month; ?>][<?php echo $i; ?>]" id="lh_calendar">
								<option value="0" <?php selected( 0, $options_calendar['lh-calendar'][$lh_facility]['lh-item4'][$year][$month][$i] ); ?> >◯</option>
								<option value="1" <?php selected( 1, $options_calendar['lh-calendar'][$lh_facility]['lh-item4'][$year][$month][$i] ); ?> >☓</option>
								<option value="2" <?php selected( 2, $options_calendar['lh-calendar'][$lh_facility]['lh-item4'][$year][$month][$i] ); ?> >△</option>
								<option value="3" <?php selected( 3, $options_calendar['lh-calendar'][$lh_facility]['lh-item4'][$year][$month][$i] ); ?> >--</option>
						</select>
					</td>
	      </tr>
	    <?php
	    }
	    ?>
	  </table>

		<input type="hidden" name="lh-facility" value="<?php echo $lh_facility; ?>">

		<p class="submit">
			<input name="Submit" type="submit" class="button button-primary button-large" value="<?php echo esc_attr( __( '更新', 'lh-lending-hall') ); ?>" />
		</p>
	</form>