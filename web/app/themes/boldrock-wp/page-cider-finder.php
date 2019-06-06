<?php

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

<main>

  <section class="finder np">

      <div class="flex flex-wrap">
        <div class="search-col">
          <div class="search-wrap">
            <h3>Find Bold Rock Hard Cider</h3>
            <form class="search-form">
                <div class="location-qwrap container">
                  <div class="card-holder">
                    <div class="card card-front">
                      <div class="marker-icon-btn">
                        <span>Use current location?</span>
                        <div class="location-btn-wrap">
                          <button id="useLocation">Yes</button>
                          <button id="useZip">No</button>
                        </div>
                      </div>
                    </div>
                    <div class="card card-back">
                      <span>Fetching your locaiton</span>

                    </div>
                  </div>
                </div>
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
            </form>
            <div class="cider_finder_button slideButton" id="find" data-hover="Find Bold Rock"><span>Find Bold Rock</span></div>
            <div id="error"></div>
          </div>
          <div class="content-wrap">
            <div class="content">
              <h3>Results</h3>
              <div id="locationResults"></div>
              <div class="pagination">
                <button id="next">Next</button>
                <button id="previous">Prev</button>
              </div>
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
