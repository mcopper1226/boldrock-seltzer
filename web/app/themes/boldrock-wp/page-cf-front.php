<?php

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

<main>
  <?php
  if (has_post_thumbnail() ): ?>
  <div class="hero fh-400">
    <?php
      $id = get_post_thumbnail_id();
      $src1 = wp_get_attachment_image_src( $id, 'full' );
      $src = $src1[0];
      $srcset = wp_get_attachment_image_srcset( $id, 'full');
      $thumb = wp_get_attachment_image_src( $id, 'blur-thumb');
      $alt = get_post_meta($id, '_wp_attachment_image_alt', true);
    ?>
    <div class="placeholder hero-wrapper" data-large="<?php echo $src; ?>">
      <img src="<?php echo $thumb[0]; ?>" class="img-small">

        <div class="hero-content">
        <?php the_content(); ?>



        </div>


    </div>
    <svg viewBox="0 0 3 1" class="aspect"><rect x="0" y="0" width="3" height="1" /></svg>

  </div>
  <?php endif; ?>
  <section class="search">
    <form class="search-form flex flex-wrap">

        <div class="marker-icon-btn" id="useLocation">Use Current Location?</div>
        <input id="zip" name="zip" type="text" pattern="[0-9]*" placeholder="Zip Code">

        <div class="custom-select">
          <select id="brand" name="brand">
            <option data-type="brand" value="apple, br apple">Apple</option>
            <option data-type="brand" value="draft, br draft">Draft</option>
            <option data-type="brand" value="br pear">Pear</option>
            <option data-type="brand" value="br india pressed apple">IPA</option>
            <option data-type="brand" value="br premium dry">Premium Dry</option>
            <option data-type="brand" value="br rose">Rose</option>
            <option data-type="category" value="ginger turmeric">Ginger Turmeric</option>
            <option data-type="brand" value="variety crate">Variety Crate</option>
          </select>
        </div>
        <div class="custom-select">
          <select id="distance" name="distance">
            <option value="5">5 miles</option>
            <option value="10">10 miles</option>
            <option value="15">15 miles</option>
            <option value="25">25 miles</option>
            <option value="50">50 miles</option>
          </select>
        </div>

        <div class="custom-select">
          <select id="storeType" name="storeType">
            <option value="">Any Vendor</option>
            <option value="23,26,28,32">Restaurant/Bar</option>
            <option value="01,02,05,08,09,10">Store</option>
          </select>
        </div>
        <input type="submit" class="cider_finder_button slideButton" value="Find Bold Rock" id="find" data-hover="Cider Finder"/>

      <div id="error"></div>
    </form>
  </section>

  <section class="finder np">

      <div class="flex flex-wrap">
        <div class="search-col">
          <div class="content">
            <h3>Results</h3>
            <div id="locationResults"></div>
            <div class="pagination">
              <button id="next">Next</button>
              <button id="previous">Prev</button>
            </div>
          </div>
        </div>
        <div class="map-col">
          <div id="map"></div>
        </div>
      </div>
  </section>

  <?php
    }
  }
  ?>
  </main>
  <?php
  get_footer();
