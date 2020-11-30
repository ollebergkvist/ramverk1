<?php

namespace Anax\View;

?>

<h1>Geo-tag IP</h1>

<!-- Validate IP in textformat -->
<h3>Validate IP</h3>

<form method="get" action="<?= url("geo") ?>">
    <input type="text" name="ip" placeholder="Enter IP address" required value="<?= $ip ?>">
    <button type="submit" class="btn">Validate</button>
</form>

<p>Enter IP address to validate and geo tag</p>

<h3>Result for IP: <?= $ip ?> </h3>
<div>
    <span style="display:inline-block;">Valid:</span>
    <?php if ($isValidIP): ?>
    <span style="display:inline-block;">Valid</span>
    <?php else: ?>
    <span style="display:inline-block;">Invalid</span>
    <?php endif ?>
</div>
<div>
    <span>IP protocol:</span>
    <span><?= $ipProtocol ?></span>
</div>
<div>
    <span>Host:</span>
    <span><?= $ipHost ?></span>
</div>
<div>
    <span>Latitude:</span>
    <span><?= $latitude ?></span>
</div>
<div>
    <span>Longitude:</span>
    <span><?= $longitude ?></span>
</div>
<div>
    <span>City:</span>
    <span><?= $city ?></span>
</div>
<div>
    <span>Country:</span>
    <span><?= $country ?></span>
</div>

<?php if ($latitude && $longitude ) : ?>
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

