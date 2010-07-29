<?php

define("JW_PLAYER_LTAS_DESC",
  "The LongTail AdSolution (LTAS) is a service which allows you to monetize your content through pre-roll, post-roll and overlay ads from premium video advertisers.  " .
  "To use this service you must have an account.  For more information visit <a href=http://www.longtailvideo.com/adsolution" . JW_PLAYER_GA_VARS . " target=_blank>http://www.longtailvideo.com/adsolution</a>." .
  "<br/><br/><strong>To sign up for this service, <a href=https://dashboard.longtailvideo.com/signup.aspx" . JW_PLAYER_GA_VARS . " target=_blank>click here to create an account</a>.</strong>"
);

/**
 * Responsible for the display of LTAS configuration.
 * @file Class definition of LTASState
 * @see AdminState
 */
class LTASState extends WizardState {

  /**
   * @see AdminState::__construct()
   */
  public function __construct($player, $post_values = "") {
    parent::__construct($player, $post_values);
  }

  /**
   * @see AdminState::getID()
   */
  public static function getID() {
    return "ltas";
  }

  /**
   * @see AdminState::getNextState()
   */
  public function getNextState() {
    LongTailFramework::setConfig($this->current_player);
    return new PluginState($this->current_player, $this->current_post_values);
  }

  /**
   * @see AdminState::getPreviousState()
   */
  public function getPreviousState() {
    LongTailFramework::setConfig($this->current_player);
    return new AdvancedState($this->current_player);
  }

  /**
   * @see AdminState::getCancelState()
   */
  public function getCancelState() {
    return new PlayerState("");
  }

  /**
   * @see AdminState::getSaveState()
   */
  public function getSaveState() {
    return new PlayerState("");
  }

  public static function getTitle() {
    return WizardState::LTAS_STATE;
  }

  /**
   * @see AdminState::render()
   */
  public function render() {
    $ltas = LongTailFramework::getLTASConfig(); ?>
    <div class="wrap">
      <form name="<?php echo LONGTAIL_KEY . "form" ?>" method="post" action="">
        <?php parent::getBreadcrumbBar(); ?>
        <?php $this->selectedPlayer(); ?>
        <p/>
        <div id="poststuff">
          <div id="post-body">
            <div id="post-body-content">
              <div class="stuffbox">
                <h3 class="hndle"><span><?php echo "LTAS Settings"; ?></span></h3>
                <div class="inside" style="margin: 15px;">
                  <table class="form-table">
                    <tr>
                      <?php $value = $_POST["jwplayermodule_plugin_ltas_enable"] ? $_POST["jwplayermodule_plugin_ltas_enable"] : $ltas["enabled"]; ?>
                      <?php unset($_POST["jwplayermodule_plugin_ltas_enable"]); ?>
                      <td><input name="jwplayermodule_plugin_ltas_enable" type="checkbox" value="1" <?php checked(true , $value); ?> />
                      <span>Enable LTAS</span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="description"><?php echo JW_PLAYER_LTAS_DESC; ?></span></td>
                    </tr>
                    <tr>
                      <?php $value = $_POST["jwplayermodule_plugin_ltas_cc"] ? $_POST["jwplayermodule_plugin_ltas_cc"] : $ltas["channel_code"]; ?>
                      <?php unset($_POST["jwplayermodule_plugin_ltas_cc"]); ?>
                      <th>ltas.cc</th>
                      <td>
                        <input type="text" value="<?php echo $value; ?>" name="jwplayermodule_plugin_ltas_cc" />
                        <span class="description"><?php echo "Your LTAS channel code.  Obtained from the <a href=https://dashboard.longtailvideo.com/" . JW_PLAYER_GA_VARS . " target=_blank>AdSolution Dashboard.</a>"; ?></span>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php $this->buttonBar(LTASState::getID()); ?>
      </form>
    </div>
    <?php
  }

}
?>
