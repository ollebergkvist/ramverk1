<?php

namespace Anax\View;

?>

<!-- API INFO -->
<h3>
    API
</h3>
<p>
    The API receives GET requests at <code>geo-json</code>.
</p>
<p>
    Example how to enter query string: <code>?ip=216.58.217.36</code>.
</p>
<p>
    Result is returned in JSON format:
</p>
<pre>
    [
        {
        "ip": "216.58.217.36",
        "isValidIP": true,
        "ipProtocol": "IPv4",
        "ipHost": "den03s10-in-f36.1e100.net",
        "latitude": 38.98371887207031,
        "longitude": -77.38275909423828,
        "country": "United States",
        "city": "Herndon",
        "urlMap": "https://www.google.com/maps/search/?api=1&query=38.98371887207,-77.382759094238"
        }
    ]
</pre>

<!-- TEST ROUTES -->
<h3>Test route</h3>
<ul>
    <li>
        <a href="<?= url("geo-json?ip=216.58.217.36") ?>">Valid IP address</a>
    </li>
    <li>
        <a href="<?= url("geo-json?ip=127.0") ?>">Invalid IP address</a>
    </li>
</ul>
