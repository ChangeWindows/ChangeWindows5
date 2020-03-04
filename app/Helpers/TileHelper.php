<?php

function getTile( $flight ) {
    ?>
    <a href="<?php echo '/milestones/'.$flight->milestone.'/'.getPlatformClass($flight->platform) ?>" class="tile <?php echo $flight->class ?>">
        <span class="ring"><?php echo $flight->flight ?></span>
        <span class="build"><?php echo $flight->build ?>.<?php echo $flight->delta ?></span>
        <span class="date"><?php echo $flight->format ?></span>
    </a>
    <?php
}
