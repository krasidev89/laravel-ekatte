<script>
    $('.settlements-select2').select2({
        allowClear: true
    });

    var selectMunicipalityID = $('#municipality_id');
    var selectTownHallID = $('#town_hall_id');

    $('#district_id').on('change', function() {
        var element = $(this);
        var value = parseInt(element.val());

        if (value) {
            $.ajax({
                type: 'GET',
                url: '{{ route('panel.settlements.data-municipalities') }}',
                data: {
                    'district_id': value
                },
                dataType: 'json',
                success: function(data) {
                    initDropdown(selectMunicipalityID, data);
                }
            });
        } else {
            selectMunicipalityID.empty().select2().prop('disabled', true);
            selectTownHallID.empty().select2().prop('disabled', true);
        }
    });

    selectMunicipalityID.on('change', function() {
        var element = $(this);
        var value = parseInt(element.val());

        if (value) {
            $.ajax({
                type: 'GET',
                url: '{{ route('panel.settlements.data-town-halls') }}',
                data: {
                    'municipality_id': value
                },
                dataType: 'json',
                success: function(data) {
                    initDropdown(selectTownHallID, data);
                }
            });
        } else {
            selectTownHallID.empty().select2().prop('disabled', true);
        }
    });

    function initDropdown(select, data) {
        var options = [{
            id: '',
            text: select.data('placeholder')
        }];

        $.each(data, function(key, object) {
            options.push({
                id: object.id,
                text: object.name
            });
        });

        select.empty().select2({
            allowClear: true,
            data: options
        }).prop('disabled', false);
    }
</script>
