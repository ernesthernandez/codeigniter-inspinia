
    <div class='{column}'>
        <div style='{height}' id='{id}'></div>
    </div>



 <script>
    var mapData = $.parseJSON('<?=json_encode($json) ?>');

    $('#{id}').vectorMap({
        map: 'world_mill_en',
        zoomOnScroll: false,
        backgroundColor: 'transparent',
        regionStyle: {
            initial: {
                'fill': '#E4E4E4',
                'fill-opacity': 1,
                stroke: 'none',
                'stroke-width': 0,
                'stroke-opacity': 0
            }
        },
        series: {
            regions: [{
                values: mapData,
                scale: ['#FAF1E6', '#FC9924'],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionClick: function (e, code)
        {
               
        },
        onRegionTipShow: function(e, label, code){
            var ecpm;
            if (is_defined(mapData[code])) {
                ecpm = parseFloat(mapData[code]).toFixed(2);
            } else {
                ecpm = 0.00;
            }

          label.html('<p class="text-center" style="font-size: 1.3em;">'+label.html()+'</p><p class="text-center" style="font-size: 1.3em;"> eCPM: $ ' + ecpm + '</p>');
        }
    });
    </script>