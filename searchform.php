<div id="searchBar" data-toggler=".expanded" data-animate="fade-in fade-out" class="small-12 medium-6 columns search" expanded-mobile>

          <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <label>
                <input type="search" class="search-field"
                placeholder="<?php echo esc_attr_x( 'Search…', 'placeholder', 'timber-news' ) ?>"
                value="<?php echo get_search_query() ?>" name="s"
                title="<?php echo esc_attr_x( 'Search for:', 'label', 'timber-news' ) ?>" />
            </label>
            <input type="submit"
            value="<?php echo esc_attr_x( 'Search', 'submit button', 'timber-news' ) ?>" />
          </form>

  </div>
