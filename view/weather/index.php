<?php

namespace Anax\View;

?>

<h1>Weather</h1>

<h3>Get weather forecast</h3>

<form method="get" action="<?= url("weather") ?>">
    <input type="text" name="ip" placeholder="Enter IP address" required
        value="<?= htmlentities($ip) ?>">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<p>Enter IP address to get forecast</p>

<h3>Location</h3>
<?php if ($city && $country) : ?>
<p>City: <?= $city ?></p>
<p>Country: <?= $country ?></p>
<?php endif; ?>


<?php if (!$isValidIP) : ?>
<span>The ip-address entered is unfortunately not valid, please try again</span>
<?php else : ?>
<div>
    <h3>Map</h3>
    <div>
        <?php if ($latitude && $longitude) : ?>
        <div id="map" style="height: 500px"></div>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=<?= $apiKeyMap ?>&callback=initMap&libraries=&v=weekly"
            defer></script>
        <script>
        // Initialize and add the map
        function initMap() {
            // The location
            const location = {
                lat: <?= $latitude ?>,
                lng: <?= $longitude ?>
            };
            // The map, centered at location
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });
            // The marker, positioned at location
            const marker = new google.maps.Marker({
                position: location,
                map: map,
            });
        }
        </script>
        <?php endif; ?>
    </div>
    <div>

    </div>
    <?php if ($temperature) : ?>
    <div>
        <h3>Current weather</h3>
        <div>
            <div>
                <img src="<?= $iconUrl ?>">
            </div>
            <div>
                Temperature: <?= $temperature ?> °C
            </div>
            <div>
                Humidity: <?= $humidity ?> %
            </div>
            <div>
                Wind: <?= $wind  ?> m/s
            </div>
        </div>
        <?php if ($weatherHistory) : ?>
        <h3>Weather History</h3>
        <?php foreach ($weatherHistory as $day) : ?>
        <div>
            <h4> <?= $day["date"] ?> </h4>
            <img src="<?= $day["iconUrl"] ?>">
            <h4> <?= $day["description"] ?> </h4>
            <h4> <?= $day["temperature"] ?> °C </h4>
            <h4> <?= $day["wind"] ?> m/s </h4>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php else : ?>
    <div>
        <h3>Current weather</h3>
        <p>Forecast could not be generated for given location</p>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>