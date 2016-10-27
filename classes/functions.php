<?php
class lh_functions {

  //配列結合
  public static function mymerge($arr1, $arr2)
  {
    foreach($arr2 as $key=>$value) {
      if(!is_array($arr1)) {
        $arr1 = array($arr1);
      }
      if(is_array($value)) {
        $arr1[$key] = lh_functions::mymerge($arr1[$key], $value);
      } else {
        $arr1[$key] = $value;
      }
    }
    return $arr1;
  }

  //エラー表示
  public static function display_messages( $_messages, $_state ) {
  ?>
      <div id="setting-error-settings_updated" class="<?php echo $_state; ?> settings-error notice is-dismissible">
          <p>
              <?php foreach ( $_messages as $message ): ?>
                  <strong><?php echo esc_html( $message ); ?></strong>
              <?php endforeach; ?>
              <button type="button" class="notice-dismiss"><span class="screen-reader-text">この通知を非表示にする</span></button>
          </p>
      </div>
  <?php
  }

  //配列結合
  public static function lh_calendar_options_flg($_state)
  {
    if($_state == 0){
      echo '◯';
    } elseif($_state == 1){
      echo '☓';
    } elseif($_state == 2){
      echo '△';
    } elseif($_state == 3){
      echo '--';
    }else{
      echo '--';
    }
  }


}
?>