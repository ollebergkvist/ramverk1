<?php

namespace Anax\View;

?>

<h1>Geo-tag IP</h1>

<!-- Validate IP in textformat -->
<h3>Validate IP</h3>

<form method="get" action="<?= url("geo") ?>">
    <input type="text" name="ip" placeholder="Enter IP address" required value="<?= htmlentities($ip) ?>">
    <button type="submit" class="btn">Validate</button>
</form>

<p>Enter IP address to validate and geo tag</p>

<h3>Result for IP: <?= $ip ?> </h3>
<div>
    <span>Validation:</span>
    <?php if ($isValidIP) : ?>
        <span>Valid IP</span>
    <?php else : ?>
        <span>Invalid IP</span>
    <?php endif; ?>

    <?php if ($ipProtocol) : ?>
        <div>
            <span>IP protocol:</span>
            <span><?= $ipProtocol ?></span>
        </div>
    <?php endif; ?>

    <?php if ($ipHost) : ?>
        <div>
            <span>Host:</span>
            <span><?= $ipHost ?></span>
        </div>
    <?php endif; ?>

    <?php if ($latitude) : ?>
        <div>
            <span>Latitude:</span>
            <span><?= $latitude ?></span>
        </div>
    <?php endif; ?>

    <?php if ($longitude) : ?>
        <div>
            <span>Longitude:</span>
            <span><?= $longitude ?></span>
        </div>
    <?php endif; ?>

    <?php if ($city) : ?>
        <div>
            <span>City:</span>
            <span><?= $city ?></span>
        </div>
    <?php endif; ?>

    <?php if ($country) : ?>
        <div>
            <span>Country:</span>
            <span><?= $country ?></span>
        </div>
    <?php endif; ?>

    <?php if ($latitude && $longitude) : ?>
        <h3>Map</h3>
        <div id="map" style="height: 500px"></div>
        <script  src="https://maps.googleapis.com/maps/api/js?key=<?= $googleAPIKey ?>&callback=initMap&libraries=&v=weekly" defer></script>
        <script>
        // Initialize and add the map
        function initMap() {
            // The location
            const location = { lat: <?= $latitude ?>, lng: <?= $longitude ?> };
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
