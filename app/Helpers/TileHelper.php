<?php

function getTile( $flight ) {
    ?>
    <div class="tile <?php echo $flight->class ?>">
        <span class="ring"><?php echo $flight->flight ?></span>
        <span class="build"><?php echo $flight->build ?>.<?php echo $flight->delta ?></span>
        <span class="date"><?php echo $flight->format ?></span>
    </div>
    <?php
}