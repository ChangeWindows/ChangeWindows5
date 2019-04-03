<?php

function getBadge( $badge ) {
    if ($badge) {
        ?>
        <span class="badge badge-user badge-<?php echo $badge[1] ?>"><i class="fal fa-fw <?php echo $badge[0] ?>"></i></span>
        <?php
    }
}