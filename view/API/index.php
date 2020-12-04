<?php

namespace Anax\View;

?>

<!-- API INFO -->
<h3>
    Geo Position API
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

<!-- API INFO -->
<h3>
    Weather API
</h3>
<p>
    The API receives GET requests at <code>weather-json</code>.
</p>
<p>
    Example how to enter query string: <code>?ip=216.58.217.36</code>.
</p>
<p>
    Result is returned in JSON format:
</p>

<pre>
{
    "location": {
        "city": "Herndon",
        "country": "United States"
    },
    "currentWeather": {
        "date": "2020-12-03",
        "description": "overcast clouds",
        "temperature": 11.32,
        "wind": 0.45,
        "humidity": 36,
        "iconUrl": "http://openweathermap.org/img/wn/04d@2x.png"
    },
    "weatherHistory": [
        {
            "date": "2020-12-02",
            "description": "overcast clouds",
            "temperature": 4.47,
            "wind": 8.7,
            "humidity": 64,
            "iconUrl": "http://openweathermap.org/img/wn/04d@2x.png"
        },
        {
            "date": "2020-12-01",
            "description": "broken clouds",
            "temperature": 5.38,
            "wind": 6.2,
            "humidity": 52,
            "iconUrl": "http://openweathermap.org/img/wn/04d@2x.png"
        },
        ...
    ]
}
</pre>

<!-- TEST ROUTES -->
<h3>Test route</h3>
<ul>
    <li>
        <a href="<?= url("weather-json?ip=216.58.217.36") ?>">Valid IP</a>
    </li>
</ul>