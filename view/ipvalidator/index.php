<?php

namespace Anax\View;

?>

<h1>IP Validator</h1>

<!-- Validate IP in textformat -->
<h3>
    Validate IP: text
</h3>

<form method="post" action="<?= url("ip/text") ?>">
    <input type="text" name="ip" placeholder="Enter IP adress">
    <button type="submit" class="btn">Validate</button>
</form>

<!-- Validate JSON in json -->
<h3>
    Validate IP: json
</h3>

<form method="post" action="<?= url("ip/json") ?>">
    <input type="text" name="ip" placeholder="Enter IP adress">
    <button type="submit" class="btn">Validate</button>
</form>

<!-- API INFO -->
<h3>
    API
</h3>
<p>
    The API receives GET requests at <b>ip/json</b>.
</p>
<p>
    Example how to enter query string: <b>?ip=216.58.217.36</b>.
</p>
<p>
    Result is returned in JSON format:
</p>
<p>
    <code>
    [
        {
        "ip": "127.0.0.1",
        "message": "is a valid IPv4 address",
        "hostname": "me.linux.se"
        }
    ]
    </code>
</p>

<!-- TEST ROUTES -->
<h3>Test routes</h3>
<ul>
    <li>
        <a href="<?= url("ip/json?ip=127.0.0.1") ?>">Valid IPv4 address</a>
    </li>
    <li>
        <a
            href="<?= url("ip/json?ip=2001:0db8:0000:0000:0000:ff00:0042:7879") ?>">Valid
            IPv6 adress</a>
    </li>
    <li>
        <a href="<?= url("ip/json?ip=127.0") ?>">Invalid IP adress</a>
    </li>
</ul>