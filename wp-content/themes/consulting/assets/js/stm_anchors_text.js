window.onload = function() {
    var anchor_nav_links = document.querySelectorAll( '.stm_anchors_text__nav a' );
    anchor_nav_links.forEach(function(link){
        link.addEventListener('click', function(e){
            e.preventDefault();
            var id = e.target.href.split("#")[1];
            var block = document.getElementById(id);

            block.scrollIntoView({ behavior: 'smooth' });
        })
    });
}

window.onscroll = function() {
    scrollingCategories( document.querySelectorAll( '.stm_anchors_text__nav a' ) );
}

function scrollingCategories(links) {
    let current_category = links[0].getAttribute('href').substr(1);
    links.forEach(link => {
        const section_id = link.getAttribute('href').substr(1);
        const section = document.getElementById(`${section_id}`);

        if (section.getBoundingClientRect().top < 50) {
            current_category = section_id;
        }

        link.classList.remove('active');
        section.classList.remove('active');
    });

    document.querySelector( `.stm_anchors_text__nav a[href="#${ current_category }"], #${ current_category }`).classList.add('active');
    document.getElementById( `${ current_category }`).classList.add('active');
}
