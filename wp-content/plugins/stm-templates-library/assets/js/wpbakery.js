jQuery(document).ready(function($) {
    $("#vc_templates-editor-button, #vc_templates-more-layouts").on("click", function() {
        setTimeout(function(){ template_isotope(); }, 500);
    });

    let template_isotope = function template_isotope() {
        let $grid = $('.grid').isotope({filter: '*'});

        $('.filter-button-group').on('click', 'button', function () {
            let filterValue = $(this).attr('data-filter');
            $grid.isotope({filter: filterValue});
        });

        $('.filter-button-group button').on('click', function () {
            $('.filter-button-group button').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    };

});