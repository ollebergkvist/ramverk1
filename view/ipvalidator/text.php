<?php

namespace Anax\View;

?>

<h1>
    Validate IP adress
</h1>

<h4>IP</h4>
<p>
    <b><?php echo $ip . " " . $message; ?></b>
</p>

<h4>Hostname</h4>
<p>
    <b><?php echo $hostname ?></b>
</p>

<a href="<?= url("ip") ?>">Return</a>