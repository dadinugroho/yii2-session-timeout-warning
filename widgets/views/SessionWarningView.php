<?php

use yii\helpers\Url;

/** @var \yii\web\View $this */
/** @var string|integer $userId */
/** @var array|string $extendUrl */
/** @var integer $warnBefore */
/** @var array|string $logoutUrl */
?>

<div id="session-warning-modal" class="modal fade" tabindex="-1" role="dialog" data-warn-before="<?= $warnBefore; ?>" data-user-id="<?= $userId; ?>" data-extend-url="<?= Url::to($extendUrl); ?>">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center btn-warning">
                <h1 id="countdown" class="text-warning"></h1>
                <div class="message"></div>
            </div>
            <div class="modal-footer">
                <?php if ($logoutUrl): ?>
                    <a href="<?= Url::to($logoutUrl) ?>" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> <?= Yii::t('dadinugroho/sessionWarning', 'Logout') ?></a>
                <?php endif; ?>
                <button type="button" onClick= "contTimer();" class="btn btn-warning continue"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> <?= Yii::t('dadinugroho/sessionWarning', 'Continue') ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var timeleft = <?= Yii::$app->user->authTimeout ?>;
    var downloadTimer = setInterval(function () {
        timeleft--;
        document.getElementById("countdown").textContent = timeleft;
        if (timeleft <= 0) {
            timeleft = parseInt($('#session-warning-modal').data('warn-before'));

            if (timeleft <= -30) {
                clearInterval(downloadTimer);
            }
        }
    }, 1000);

    function contTimer() {
        timeleft = <?= Yii::$app->user->authTimeout ?>;
        return true;
    }
</script>

<?php
\dadinugroho\sessionWarning\assets\SessionWarningAsset::register($this)
        ->initPlugin($this, [
            'logoutUrl' => $logoutUrl,
        ]);
