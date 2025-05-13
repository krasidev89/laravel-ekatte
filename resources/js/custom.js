/**
 * jQuery columnCount plugin
 */
(function ($) {
    $.fn.columnCount = function (options) {
        var gridBreakpoints = {
            xl: '(min-width: 1200px)',
            lg: '(min-width: 992px)',
            md: '(min-width: 768px)',
            sm: '(min-width: 576px)'
        };

        var counts = $.extend({
            xl: 0, lg: 0, md: 0, sm: 0, xs: 1
        }, options);

        var breakpoints = [];
        var maxColumnCount = 1;

        for (i in counts) {
            if (counts[i] && i != 'xs') {
                breakpoints.push({
                    media: window.matchMedia(gridBreakpoints[i]),
                    count: counts[i]
                });

                if (counts[i] > maxColumnCount) {
                    maxColumnCount = counts[i];
                }
            }
        }

        return this.each(function () {
            var row = $(this);
            var cols = row.find('> [class*="col"]');
            var prependCols = '';

            for (var c = 0; c < maxColumnCount; c++) {
                prependCols += '<div class="col d-none"><div class="row"></div></div>';
            }

            row.prepend(prependCols);

            function responsiveMedia() {
                var col = counts['xs'];

                for (var i in breakpoints) {
                    if (breakpoints[i]['media'].matches) {
                        col = breakpoints[i]['count'];
                        break;
                    }
                }

                if (typeof col !== 'undefined') {
                    row.find('> .col').removeClass('d-none');
                    row.find('> .col:nth-child(n+' + (col + 1) + ')').addClass('d-none');

                    for (var i = 0; i < cols.length; i++) {
                        $(cols[i]).appendTo(
                            row.find('> .col:nth-child(' + ((i % col) + 1) + ') > .row')
                        );
                    }
                }
            }

            for (var i in breakpoints) {
                breakpoints[i]['media'].addListener(responsiveMedia);
            }

            responsiveMedia();
        });
    };
})(jQuery);

/**
 * Function that initializes a image after upload.
 */
$(function () {
    $('[type="file"]').on('change', function (e) {
        var url = URL.createObjectURL(e.target.files[0]);

        $(this).parent().find('img').attr('src', url);
        URL.revokeObjectURL(url);
    });
});

/**
 * Function that initializes a button to delete text in an input field.
 */
$(function () {
    $('.btn-clear').on('click', function () {
        $(this).closest('.has-clear').find('input[type="text"]').val('').trigger('propertychange').focus();
    });
});

/**
 * Function that initializes a search box in collapse.
 */
$(function () {
    $('.searchbar').on('input propertychange', function () {
        var element = $(this);
        var text = element.val().toUpperCase();
        var uls = $(element.data('target') + ' ul');

        if (text != '') {
            uls.find('a').map(function () {
                if (this.text.trim().toUpperCase().indexOf(text) > -1) {
                    var parentItems = $(this).parents('li');

                    parentItems.find('[data-toggle="collapse"]').removeClass('collapsed').attr('aria-expanded', true);
                    parentItems.removeClass('d-none').find('.collapse').addClass('show');
                } else {
                    var link = $(this);

                    if (link.attr('data-toggle') == 'collapse') {
                        link.addClass('collapsed').attr('aria-expanded', false);
                    }

                    link.parent().addClass('d-none').find('.collapse').removeClass('show');
                }
            });
        } else {
            var ulsItems = uls.find('li');
            var parentItems = uls.find('a.active').parents('li');

            ulsItems.removeClass('d-none');
            ulsItems.find('[data-toggle="collapse"].default-expanded').removeClass('collapsed').attr('aria-expanded', true).closest('li').find('.collapse').addClass('show');
            ulsItems.find('[data-toggle="collapse"]:not(.default-expanded)').addClass('collapsed').attr('aria-expanded', false).closest('li').find('.collapse').removeClass('show');

            parentItems.find('[data-toggle="collapse"]').removeClass('collapsed').attr('aria-expanded', true);
            parentItems.find('.collapse').addClass('show');
        }
    });
});

/**
 * Function that initializes a blur effect on main content when side nav is open on a mobile resolution.
 */
$(function () {
    var buttonSideNavbarNav = $('[data-target="#sideNavbarContent"]');
    var sideNavbar = $('#sideNavbarContent');
    var main = $('#panel main');

    sideNavbar.on('show.bs.collapse hide.bs.collapse', function (e) {
        if ($(this).is(e.target)) {
            main.toggleClass('blur', !$(this).hasClass('show'));
        }
    });

    main.on('click', function () {
        if (buttonSideNavbarNav.is(':visible') && sideNavbar.is(':visible')) {
            sideNavbar.collapse('hide');
        }
    });
});
