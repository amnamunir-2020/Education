<?php

function getTemplates() {
    return array(
        "About Careers" => array(
            'id' => "templates-careers",
            'image' => "about_careers.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/careers/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/careers/careers.json', true ),
        ),
        "About Careers 2" => array(
            'id' => "templates-careers",
            'image' => "about_careers_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/careers-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/careers/careers_2.json', true ),
        ),
        "Faq" => array(
            'id' => "templates-miscellaneous",
            'image' => "about_faq.jpg",
            'url' => "https://consulting.stylemixthemes.com/faq/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/miscellaneous/faq.json', true ),
        ),
        "Faq 2" => array(
            'id' => "templates-miscellaneous",
            'image' => "about_faq_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/faq-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/miscellaneous/faq_2.json', true ),
        ),
        "Listing Grid" => array(
            'id' => "templates-careers",
            'image' => "about_listing_grid.jpg",
            'url' => "https://consulting.stylemixthemes.com/job-listing-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/careers/listing_grid.json', true ),
        ),
        "About Our Approach" => array(
            'id' => "templates-about",
            'image' => "about_our_approach.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/our-approach/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/about/about_our_approach.json', true ),
        ),
        "Partners" => array(
            'id' => "templates-our_team",
            'image' => "about_our_partners.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/our-partners/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/our_team/our_partners.json', true ),
        ),
        "Our Team Grid" => array(
            'id' => "templates-our_team",
            'image' => "about_our_team_grid.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/our-team-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/our_team/our_team_grid.json', true ),
        ),
        "Our Team List" => array(
            'id' => "templates-our_team",
            'image' => "about_our_team_list.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/our-team-list/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/our_team/our_team_list.json', true ),
        ),
        "Our Team List 2" => array(
            'id' => "templates-our_team",
            'image' => "about_our_team_list_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/our-team-list-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/our_team/our_team_list_2.json', true ),
        ),
        "Our Team Member" => array(
            'id' => "templates-our_team",
            'image' => "about_our_team_single.jpg",
            'url' => "https://consulting.stylemixthemes.com/staff/brandon-copperfield/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/our_team/our_team_single.json', true ),
        ),
        "About Page 1" => array(
            'id' => "templates-about",
            'image' => "about_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/company-overview/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/about/about_template_1.json', true ),
        ),
        "About Page 2" => array(
            'id' => "templates-about",
            'image' => "about_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/about-layout-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/about/about_template_2.json', true ),
        ),
        "About Page 3" => array(
            'id' => "templates-about",
            'image' => "about_template_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/about-layout-3/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/about/about_template_3.json', true ),
        ),
        "About Page 4" => array(
            'id' => "templates-about",
            'image' => "about_template_4.jpg",
            'url' => "https://consulting.stylemixthemes.com/about-layout-4/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/about/about_template_4.json', true ),
        ),
        "Vacancy Page 1" => array(
            'id' => "templates-careers",
            'image' => "about_vacancy_page_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/careers_archive/deputy-principal-construction-manager-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/careers/vacancy_page_1.json', true ),
        ),
        "Vacancy Page 2" => array(
            'id' => "templates-careers",
            'image' => "about_vacancy_page_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/careers_archive/senior-industrial-planner-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/careers/vacancy_page_2.json', true ),
        ),
        "Privacy Policy Page" => array(
            'id' => "templates-miscellaneous",
            'image' => "privacy_policy.jpg",
            'url' => "https://consulting.stylemixthemes.com/privacy-policy/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/miscellaneous/privacy_policy.json', true ),
        ),
        "Solutions" => array(
            'id' => "templates-miscellaneous",
            'image' => "about_solutions.jpg",
            'url' => "https://consulting.stylemixthemes.com/solutions/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/miscellaneous/solutions.json', true ),
        ),
        "Single Services Layout 1" => array(
            'id' => "templates-services",
            'image' => "service_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/services/turnaround-consulting/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_1.json', true ),
        ),
        "Single Services Layout 2" => array(
            'id' => "templates-services",
            'image' => "service_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/services/bonds-commodities/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_2.json', true ),
        ),
        "Single Services Layout 3" => array(
            'id' => "templates-services",
            'image' => "service_template_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/services/audit-assurance/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_3.json', true ),
        ),
        "Single Services Layout 4" => array(
            'id' => "templates-services",
            'image' => "service_template_4.jpg",
            'url' => "https://consulting.stylemixthemes.com/service-layout-4/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_4.json', true ),
        ),
        "Single Services Layout 5" => array(
            'id' => "templates-services",
            'image' => "service_template_5.jpg",
            'url' => "https://consulting.stylemixthemes.com/service-layout-5/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_5.json', true ),
        ),
        "Single Services Layout 6" => array(
            'id' => "templates-services",
            'image' => "service_template_6.jpg",
            'url' => "https://consulting.stylemixthemes.com/services/local-business-opportunities/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/service_template_6.json', true ),
        ),
        "Services Grid 1" => array(
            'id' => "templates-services",
            'image' => "services_grid_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_1.json', true ),
        ),
        "Services Grid 2" => array(
            'id' => "templates-services",
            'image' => "services_grid_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_2.json', true ),
        ),
        "Services Grid 3" => array(
            'id' => "templates-services",
            'image' => "services_grid_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid-3/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_3.json', true ),
        ),
        "Services Grid 4" => array(
            'id' => "templates-services",
            'image' => "services_grid_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid-4/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_4.json', true ),
        ),
        "Services Grid 6" => array(
            'id' => "templates-services",
            'image' => "services_grid_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid-6/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_6.json', true ),
        ),
        "Services Grid 7" => array(
            'id' => "templates-services",
            'image' => "services_grid_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-grid-7/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_7.json', true ),
        ),
        "Services With Icons" => array(
            'id' => "templates-services",
            'image' => "services_with_icons.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-with-icons/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_grid_8.json', true ),
        ),
        "Services List" => array(
            'id' => "templates-services",
            'image' => "services_list.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-list/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_list.json', true ),
        ),
        "Services With Tabs" => array(
            'id' => "templates-services",
            'image' => "services_with_tabs.jpg",
            'url' => "https://consulting.stylemixthemes.com/services-with-tabs/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/services/services_with_tabs.json', true ),
        ),
        "Single Case Layout 1" => array(
            'id' => "templates-cases",
            'image' => "case_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/works/applying-commercial-excellence-in-chemicals/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/case_template_1.json', true ),
        ),
        "Single Case Layout 2" => array(
            'id' => "templates-cases",
            'image' => "case_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/works/constructing-a-best-in-class-global/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/case_template_2.json', true ),
        ),
        "Single Case Layout 3" => array(
            'id' => "templates-cases",
            'image' => "case_template_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/works/healthcare-giant-overcomes-merger-risks-for-growth-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/case_template_3.json', true ),
        ),
        "Single Case Layout 4" => array(
            'id' => "templates-cases",
            'image' => "case_template_4.jpg",
            'url' => "https://consulting.stylemixthemes.com/works/focus-on-core-delivers-growth-for-retailer-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/case_template_4.json', true ),
        ),
        "Single Case Layout 5" => array(
            'id' => "templates-cases",
            'image' => "case_template_5.jpg",
            'url' => "https://consulting.stylemixthemes.com/works/transformation-sparks-financial-leaders-turnaround-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/case_template_5.json', true ),
        ),
        "Cases Grid 1" => array(
            'id' => "templates-cases",
            'image' => "cases_grid_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/our-work-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/cases_grid_1.json', true ),
        ),
        "Cases Grid 2" => array(
            'id' => "templates-cases",
            'image' => "cases_grid_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/cases-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/cases_grid_2.json', true ),
        ),
        "Cases Grid 3" => array(
            'id' => "templates-cases",
            'image' => "cases_grid_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/our-work-grid-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/cases_grid_3.json', true ),
        ),
        "Cases List" => array(
            'id' => "templates-cases",
            'image' => "cases_list.jpg",
            'url' => "https://consulting.stylemixthemes.com/cases-list/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/cases_list.json', true ),
        ),
        "Cases With Filter" => array(
            'id' => "templates-cases",
            'image' => "cases_with_filter.jpg",
            'url' => "https://consulting.stylemixthemes.com/our-work-with-filter/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cases/cases_with_filter.json', true ),
        ),
        "News Grid" => array(
            'id' => "templates-news",
            'image' => "news_grid.jpg",
            'url' => "https://consulting.stylemixthemes.com/blog/?layout=grid&sidebar_id=none",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/news/news_grid.json', true ),
        ),
        "News List" => array(
            'id' => "templates-news",
            'image' => "news_list.jpg",
            'url' => "https://consulting.stylemixthemes.com/news-list/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/news/news_list.json', true ),
        ),
        "News Masonry" => array(
            'id' => "templates-news",
            'image' => "news_masonry.jpg",
            'url' => "https://consulting.stylemixthemes.com/news-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/news/news_masonry.json', true ),
        ),
        "Single News Layout 1" => array(
            'id' => "templates-news",
            'image' => "news_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/within-the-construction-industry-as-their-overdraft/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/news/news_template_1.json', true ),
        ),
        "Single News Layout 2" => array(
            'id' => "templates-news",
            'image' => "news_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/a-digital-prescription-for-the-pharma-industry-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/news/news_template_2.json', true ),
        ),
        "Portfolio Grid 1" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_grid_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_grid_1.json', true ),
        ),
        "Portfolio Grid 2" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_grid_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_grid_2.json', true ),
        ),
        "Portfolio With Filter" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_with_filter.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio-with-filter/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_grid_3.json', true ),
        ),
        "Portfolio Masonry" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_masonry.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio-masonry/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_grid_4.json', true ),
        ),
        "Single Portfolio Layout 1" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio/beff-baffer-construction/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_template_1.json', true ),
        ),
        "Single Portfolio Layout 2" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio/focus-on-core-delivers-growth-for-retailer/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_template_2.json', true ),
        ),
        "Single Portfolio Layout 3" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_template_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio/construction-of-railways/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_template_3.json', true ),
        ),
        "Single Portfolio Layout 4" => array(
            'id' => "templates-portfolio",
            'image' => "portfolio_template_4.jpg",
            'url' => "https://consulting.stylemixthemes.com/portfolio/business-planning-strategy-execution/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/portfolio/portfolio_template_4.json', true ),
        ),
        "Events Classic" => array(
            'id' => "templates-events",
            'image' => "events_classic.jpg",
            'url' => "https://consulting.stylemixthemes.com/events-classic/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/events/events_classic.json', true ),
        ),
        "Events Grid" => array(
            'id' => "templates-events",
            'image' => "events_grid.jpg",
            'url' => "https://consulting.stylemixthemes.com/events-grid/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/events/events_grid.json', true ),
        ),
        "Events Modern" => array(
            'id' => "templates-events",
            'image' => "events_modern.jpg",
            'url' => "https://consulting.stylemixthemes.com/events-modern/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/events/events_modern.json', true ),
        ),
        "Events Single" => array(
            'id' => "templates-events",
            'image' => "events_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/events/i-spent-68440-testing-different-blog-posts/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/events/events_template_1.json', true ),
        ),
        "Testimonials Page 1" => array(
            'id' => "templates-testimonials",
            'image' => "testimonials_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/testimonials-page/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/testimonials/testimonials_1.json', true ),
        ),
        "Testimonials Page 2" => array(
            'id' => "templates-testimonials",
            'image' => "testimonials_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/layout-2/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/testimonials/testimonials_2.json', true ),
        ),
        "Webinars Grid" => array(
            'id' => "templates-webinars",
            'image' => "webinars_grid.jpg",
            'url' => "https://consulting.stylemixthemes.com/webinars/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/webinars/webinars_grid.json', true ),
        ),
        "Cost Calculator" => array(
            'id' => "templates-calculator",
            'image' => "cost_calculator.jpg",
            'url' => "https://consulting.stylemixthemes.com/cost-calculator/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/cost_calculator/cost_calculator.json', true ),
        ),
        "Contacts Page 1" => array(
            'id' => "templates-contacts",
            'image' => "contacts_template_1.jpg",
            'url' => "https://consulting.stylemixthemes.com/contact-us/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/contacts/contacts_template_1.json', true ),
        ),
        "Contacts Page 2" => array(
            'id' => "templates-contacts",
            'image' => "contacts_template_2.jpg",
            'url' => "https://consulting.stylemixthemes.com/contact-two/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/contacts/contacts_template_2.json', true ),
        ),
        "Contacts Page 3" => array(
            'id' => "templates-contacts",
            'image' => "contacts_template_3.jpg",
            'url' => "https://consulting.stylemixthemes.com/contact-three/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/contacts/contacts_template_3.json', true ),
        ),
        "Contacts Page 4" => array(
            'id' => "templates-contacts",
            'image' => "contacts_template_4.jpg",
            'url' => "https://consulting.stylemixthemes.com/contact-four/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/contacts/contacts_template_4.json', true ),
        ),
        "Contacts Page 5" => array(
            'id' => "templates-contacts",
            'image' => "contacts_template_5.jpg",
            'url' => "https://consulting.stylemixthemes.com/contact-five/",
            'content' => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/contacts/contacts_template_5.json', true ),
        ),
        "Under Construction Page" => array(
            "id" => "templates-miscellaneous",
            "image" => "under_construction.jpg",
            "url" => "https://consulting.stylemixthemes.com/under-construction/",
            "content" => file_get_contents( plugin_dir_path( __FILE__ ) . 'files/miscellaneous/under_construction.json', true )
        )
    );

}

function getTemplatesFile() {

    $template_files = array();

    $templates = getTemplates();

    foreach ( $templates as $template_name => $template ) :
        $data = array();
        $data[ 'name' ] = $template_name;
        $data[ 'image_path' ] = 'https://consulting.stylemixthemes.com/wp-content/stm-templates-library/screenshots/' . $template[ "image" ];
        $data[ 'template_url' ] = $template[ "url" ];
        $data[ 'custom_class' ] = $template[ "id" ];
        $data[ 'disabled' ] = true;
        $data[ 'content' ] = plugins_url( 'files/' . $template[ "content" ] . '', __FILE__ );
        $template_files[] = $data;
    endforeach;

    return $template_files;
}

function getCategoryTemplatesCount() {
    $count = array_count_values(
        array_column(getTemplates(), 'id')
    );

    return $count;
}

function getCategoryTemplatesTotal() {
    $totals = count( getTemplates() );

    return $totals;
}