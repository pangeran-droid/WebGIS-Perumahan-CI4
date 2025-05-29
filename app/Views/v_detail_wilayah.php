<div id="map" style="width: 100%; height: 600px;"></div>

<script>
    var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
    });

    var peta3 = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
    });

    var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://carto.com/">CartoDB</a>',
        subdomains: 'abcd',
        maxZoom: 19
    });

    var peta5 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Earthstar Geographics',
        maxZoom: 19
    });

    var peta6 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://carto.com/">CartoDB</a>',
        subdomains: 'abcd',
        maxZoom: 19
    });

    var map = L.map('map', {
        center: [<?= $web['coordinat_wilayah'] ?>],
        zoom: <?= $web['zoom_view'] ?>,
        layers: [peta1]
    });

    var baseMaps = {
        'Streets': peta1,
        'OpenStreetMap.HOT': peta2,
        'OpenTopoMap': peta3,
        'Carto Light': peta4,
        'Esri Satellite': peta5,
        'Carto Dark': peta6
    };

    L.control.layers(baseMaps).addTo(map);

    var wilayah = L.geoJSON(<?= $detailwilayah['geojson'] ?>, {
        fillColor: '<?= $detailwilayah['warna'] ?>',
        fillOpacity: 1
    }).bindPopup("<b><?= $detailwilayah['nama_wilayah'] ?></b>").addTo(map);

    map.fitBounds(wilayah.getBounds());

    // <?php foreach ($sekolah as $key => $value) { ?>
    //     var Icon = L.icon({
    //         iconUrl: '<?= base_url('marker/' . $value['marker']) ?>',
    //         iconSize: [35, 50]
    //     });

    //     L.marker([<?= $value['coordinat'] ?>], { icon: Icon })
    //         .bindPopup(
    //             "<img src='<?= base_url('foto/' . $value['foto']) ?>' width='210px' height='150px'><br>" +
    //             "<b><?= $value['nama_sekolah'] ?></b><br>" +
    //             "Akreditasi <?= $value['akreditasi'] ?><br>" +
    //             "<?= $value['status'] ?><br><br>" +
    //             "<a href='<?= base_url('Home/DetailSekolah/' . $value['id_sekolah']) ?>' class='btn btn-primary btn-xs text-white' href='#'>Detail</a>"
    //         ).addTo(map);
    // <?php } ?>
</script>
