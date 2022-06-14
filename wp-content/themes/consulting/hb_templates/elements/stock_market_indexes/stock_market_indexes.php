<?php
$stocks_list = consulting_theme_option( 'stocks', '' );
$stocks_list = wp_list_pluck( $stocks_list, 'value' );
$stocks_list = implode( ', ', $stocks_list  );

wp_enqueue_script( 'vue' );
wp_enqueue_script( 'vue-resource' );

$ticker = (bool)consulting_theme_option( 'stocks_ticker', false );

if( !$ticker ) {
    wp_enqueue_script( 'stocks-header' );
    wp_enqueue_script( 'owl.carousel' );
    wp_enqueue_style( 'owl.carousel' );

} else {
    wp_enqueue_script( 'simplemarquee' );
}

?>

<div class="consulting_stocks_box">
    <?php if( !$ticker ): ?>
        <div class="row">
            <div class="container">
                <div class="consulting_stocks_list stocks_list" data-indexes="<?php echo esc_attr($stocks_list); ?>">
                    <div class="owl-carousel">
                        <template v-for="currency in data">
                            <div class="single-item" v-if="currency.regularMarketChangePercent || currency.regularMarketPrice || currency.regularMarketChange">
                                <div class="currency_column">
                                    <div class="stock-exchange" v-text="currency.symbol"></div>
                                </div>
                                <div class="currency_column">
                                    <div class="regular-price" v-text="currency.regularMarketPrice.toFixed(2)"></div>
                                    <div class="regular-change" v-bind:class="isNegative(currency.regularMarketChangePercent)">
                                        <span v-text="currency.regularMarketChange.toFixed(2)"></span>
                                        <span>({{currency.regularMarketChangePercent.toFixed(2)}}%)</span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="consulting_stocks_list stocks_list" data-indexes="<?php echo esc_attr($stocks_list); ?>">
            <div class="stocks_list_box">
                <template v-for="currency in data">
                    <div class="single-item" v-if="currency.regularMarketChangePercent || currency.regularMarketPrice || currency.regularMarketChange">
                        <div class="currency_column">
                            <div class="stock-exchange" v-text="currency.symbol"></div>
                        </div>
                        <div class="currency_column" v-bind:class="isNegative(currency.regularMarketChangePercent)">
                            <div class="regular-price" v-text="currency.regularMarketPrice.toFixed(2)"></div>
                            <div class="regular-change" v-bind:class="isNegative(currency.regularMarketChangePercent)">
                                <span v-text="currency.regularMarketChange.toFixed(2)"></span>
                                <span>({{currency.regularMarketChangePercent.toFixed(2)}}%)</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    var stocks = "<?php echo esc_attr($stocks_list); ?>";
</script>