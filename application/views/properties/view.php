<style>
    #map {
        height: 50%;
    }
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>

<h2><?php echo $title ?></h2>
<hr>
<p>Property Address : <span class="label label-success"><?php echo $property['address']; ?></span></p>
<p>Property Type : <span class="label label-success"><?php echo $property['type']; ?></span></p>
<div id="map"></div>
<script>
    function initMap() {
        var uluru = {lat: <?php echo $property['latitude']; ?>, lng: <?php echo $property['longitude']; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>
<script src="<?php echo 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDa-XT0rj1nv2YZ5jBY2ya8E-QjDYWmQ_g&callback=initMap' ?>"></script>

<hr>
<a class="btn btn-default btn-xs" href="<?php echo site_url('/properties/') ?>">Back</a>

<div class="pull-right">

    <?php echo form_open('/properties/order/'.$property['id'])?>
    <input class="btn btn-primary btn-xs" type="submit" value="Order">
    </form>

</div>