<?php
/*
Plugin Name: lh Lending Hall
Author: tashimax
Plugin URI:https://github.com/tashimax222/lh-lending-hall
Description: 簡単貸しホール状況管理
Version: 1.0.0
Author URI: http://www.tashimax.com
*/

include_once( plugin_dir_path( __FILE__ ) . 'classes/functions.php' );
include_once( plugin_dir_path( __FILE__ ) . 'classes/config.php' );

class LendingHall {

  public function __construct(){
    // 管理画面処理メニュー登録
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
    add_action( 'admin_menu', array($this, 'my_admin_menu'));
    add_action( 'admin_init', array($this, 'my_admin_init'));
    add_action( 'admin_notices', array($this, 'my_admin_notices'));
    add_shortcode( 'lh_add_shortcode', array($this, 'lh_add_shortcode') );
    //echo do_shortcode('[lh_add_shortcode]');
	}


  /**
	 * 共通CSSの読み込み
	 */
	public function admin_enqueue_scripts() {
		$url = plugins_url( lh_config::name );
		wp_enqueue_style( lh_config::name . '-admin-common', $url . '/css/admin-common.css' );
	}


  /**
	 * 管理画面メニュー登録
	 */
  public function my_admin_menu() {

    add_menu_page(
      __('貸し施設管理', 'lh-lending-hall'),
      __('貸し施設管理', 'lh-lending-hall'),
      lh_config::capability,
      lh_config::name,
      array(&$this, 'show_admin_page')
    );

    //貸し施設設定メニュー
    add_submenu_page(
      'lh-lending-hall',
      __('貸し施設設定', 'lh-lending-hall'),
      __('貸し施設設定', 'lh-lending-hall'),
      lh_config::capability,
      lh_config::name . '-master',
      array( &$this, 'master_admin_page')
		);


	}


  public function show_admin_page() {
		include_once( dirname(__FILE__) . '/includes/lh-calendar-admin-view.php');
	}

// 貸し施設設定
  public function master_admin_page() {
		include_once( dirname(__FILE__) . '/includes/admin-view.php');
	}



// 保存
public function my_admin_init()
{

  if ( isset ($_POST['lh-lending-hall']) && $_POST['lh-lending-hall']) {
    if ( check_admin_referer( 'my-nonce-key', 'lh-lending-hall')) {
      $e = new WP_Error();

      $lh_calendar_options = $_POST['lh_calendar_options'];
      if ( is_array ($_POST['lh_calendar_options']) && $_POST['lh_calendar_options']) {

        $options = get_option( lh_config::options );
        $lh_calendar_options_name = 'lh_calendar_options';
    		$options_calendar = get_option( $lh_calendar_options_name );


        //終了した月のデータを削除

      	$dtday_old = new DateTime('first day of this month');
      	$lh_nextmonthlimit_old = esc_attr( $options['lh-nextmonthlimit'] ) +2;
      	$dtday_old->modify('-' . $lh_nextmonthlimit_old . ' month')->format('Y-m');

      	$year_old = $dtday_old->format('Y');
        $month_old = $dtday_old->format('m');
        //var_dump($_POST['lh_facility']);
        //var_dump($month_old);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item1"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item2"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item3"][$year_old][$month_old]);
        unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item4"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item5"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item6"][$year_old][$month_old]);
        unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item7"][$year_old][$month_old]);
        unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item8"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item9"][$year_old][$month_old]);
      	unset($options_calendar['lh-calendar'][$_POST['lh_facility']]["lh-item10"][$year_old][$month_old]);

        $options_calendar = lh_functions::mymerge($options_calendar, $_POST['lh_calendar_options']);
        //var_dump($options_calendar);

        update_option( 'lh_calendar_options', $options_calendar);
      } else {
        //update_option( 'lh_calendar_options', '');
      }

      //成功時
      $e->add( 'error', esc_attr( __( '設定を保存しました。', 'lh-lending-hall' ) ) );
      set_transient( 'post-updated', $e->get_error_messages(), 3 );

      wp_safe_redirect( menu_page_url( 'lh-lending-hall', false ). '&lh-facility=' . $_GET['lh-facility'] . '&t=' . $_GET['t'] );
    }
  }

  if ( isset ($_POST['lh-lending-hall-master']) && $_POST['lh-lending-hall-master']) {
    if ( check_admin_referer( 'my-nonce-key', 'lh-lending-hall-master')) {
      $e = new WP_Error();

      if ( is_array ($_POST[lh_config::options]) && $_POST[lh_config::options]) {
        update_option( 'lh_options', $_POST[lh_config::options]);
      } else {
        update_option( 'lh_options', '');
      }

      //成功時
      $e->add( 'error', esc_attr( __( '設定を保存しました。', 'lh-lending-hall' ) ) );
      set_transient( 'post-updated', $e->get_error_messages(), 3 );

      wp_safe_redirect( menu_page_url( 'lh-lending-hall-master', false ) );
    }
  }
}



public function my_admin_notices() {
  $lh_calendar_options_master_name = lh_config::name. '-master';
  if ($_GET['page'] == lh_config::name || $_GET['page'] == $lh_calendar_options_master_name) {

    //保存成功
    if ( $messages = get_transient( 'post-updated' ) ) {
      lh_functions::display_messages( $messages, 'updated' );
    }

    //初期設定ができていない
  	if (!get_option(lh_config::options)) {
      echo '<div class="message error"><p>初期設定が完了していません。</p></div>';
    }
  }
}

public function lh_add_shortcode() {
		include_once( dirname(__FILE__) . '/includes/front-view.php');
}

}

$LendingHall = new LendingHall();

?>
