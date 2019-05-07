<?php
// Template Name: Homepage

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
?>

<main>

  <section class="intro">
    <div class="headerSpacer"></div>
    <video autoplay muted loop id="bubblesVideo">
      <source src="<?php echo THEME_IMG_PATH . '/preview.mp4'?>" type="video/mp4">
    </video>
    <div class="outer-container">
      <div class="flex flex-wrap flex-40-60 flex-items-center rl">
        <div class="content content__text centered">


            <h4>Launching June 2019</h4>
            <h1>Bold Rock Hard Seltzer</h1>
          <a class="button" href="#flavors">See the Styles</a>

        </div>
        <div class="content content__image">
          <div class="content__imageInner">
            <div class="content__imageWrap"><img src="<?php echo THEME_IMG_PATH . '/can-gf.png';?>" /></div>
            <div class="content__imageWrap"><img src="<?php echo THEME_IMG_PATH . '/can-cucMelon.png';?>" /></div>
          </div>

        </div>
      </div>
    </div>
    <div class="outer-container">
      <div class="flex flex-2">
        <div class="content content__image">
          <div class="content__imageAbs"></div>
          <svg viewBox="0 0 5 3" class="aspect"><rect x="0" y="0" width="5" height="3" /></svg>
        </div>
        <div class="content content__text">
          <h2>All-natural, crafted from real fruit and fresh Blue Ridge Mountain water</h2>
          <p>From the creators of the best selling independent cider brand in the US comes Bold Rock Hard Seltzer, a hand crafted refreshment that delivers a clean, effervescent taste with all-natural ingredients, just 82 calories and only 1 gram of sugar. <span class="scroll">Scroll for More</span></p>

        </div>

      </div>
    </div>
  </section>
  <section class="panel" id="flavors">
    <div class="outer-container">
      <div class="flex flex-2 flex-items-center lr">
        <div class="content content__text fade-in-up animated">
          <div class="seltzer__title">
            <h3>Cucumber Melon</h3>
            <div class="bar"></div>
          </div>
          <p class="white">Cucumber Melon features a juicy splash of melon paired with incredibly crisp and light cumber notes that are sure to make this Bold Rock Hard Seltzer a fan favorite. Lift your spirits with a cold Cucumber Melon and invigorate with this bubbly goodness.</p>
          <div class="facts">
            <h5><span class="facts__number">82</span>Calories</h5>
              <h5><span class="facts__number">1g</span>Sugar</h5>
                <h5><span class="facts__number">GF</span>Gluten Free</h5>
                  <h5><span class="facts__number">4%</span>Alcohol by Volume</h5>
          </div>
        </div>
        <div class="content content__image">
          <div class="content__imageInner">
            <div class="content__imageWrap fade-in-left animated"><img src="<?php echo THEME_IMG_PATH . '/package-cm.png';?>" /></div>

          </div>

        </div>
      </div>
    </div>
    <div class="outer-container">
      <div class="flex flex-2 flex-items-center rl">
        <div class="content content__image">
          <div class="content__imageInner">
            <div class="content__imageWrap fade-in-right animated"><img src="<?php echo THEME_IMG_PATH . '/package-gf.png';?>" /></div>

          </div>

        </div>
        <div class="content content__text fade-in-up animated">
          <div class="seltzer__title">
            <h3>Grapefruit</h3>
            <div class="bar"></div>
          </div>
          <p class="white">Grapefruit channels a pleasant citrus zest paired with a clean and refreshingly effervescent Bold Rock Hard Seltzer finish. Enjoy Grapefruit for any occasion and stay light on your feet with just 82 calories per serving.</p>
          <div class="facts">
            <h5><span class="facts__number">82</span>Calories</h5>
              <h5><span class="facts__number">1g</span>Sugar</h5>
                <h5><span class="facts__number">GF</span>Gluten Free</h5>
                <h5><span class="facts__number">4%</span>Alcohol by Volume</h5>
          </div>
        </div>

      </div>
    </div>
  </section>
  <section class="cta">
    <div class="outer-container np centered">
      <div class="inner-container">
        <h4>Available June 2019</h4>
        <h2>Follow Bold Rock Hard Seltzer on Social Media</h2>
        <ul class="social-links">
          <li class="social_link">
            <a href="https://www.facebook.com/mcintireuva/" target="_blank"><svg id="facebook" viewbox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path class="cls-1" d="M13.1,17.42H9v-4.8H13.1V8.83a6.24,6.24,0,0,1,1.69-4.67A6.09,6.09,0,0,1,19.27,2.5,26.24,26.24,0,0,1,23,2.71V7H20.43a2.41,2.41,0,0,0-1.95.64,2.69,2.69,0,0,0-.42,1.68v3.32h4.48l-.63,4.8H18.06V29.5h-5Z"></path></svg></a>
          </li>

          <li class="social_link">
            <a href="https://www.instagram.com/uvamcintire/" target="_blank"><svg viewbox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
              <g id="instagram">
                <path class="cls-1" d="M29,10.58c0,1.09.05,2.9.05,5.42s0,4.34-.08,5.44a11.19,11.19,0,0,1-.5,2.89,6.81,6.81,0,0,1-4.13,4.13,11.19,11.19,0,0,1-2.89.5C20.34,29,18.52,29,16,29s-4.34,0-5.44-.08a9.63,9.63,0,0,1-2.89-.56,6.18,6.18,0,0,1-2.53-1.54,6.78,6.78,0,0,1-1.6-2.53A11.19,11.19,0,0,1,3,21.44C3,20.34,3,18.52,3,16s0-4.34.08-5.44a11.19,11.19,0,0,1,.5-2.89A6.81,6.81,0,0,1,7.67,3.54,11.19,11.19,0,0,1,10.56,3C11.66,3,13.48,3,16,3s4.34,0,5.44.08a11.19,11.19,0,0,1,2.89.5,6.81,6.81,0,0,1,4.13,4.13A12.11,12.11,0,0,1,29,10.58Zm-2.8,13.11a12.49,12.49,0,0,0,.47-3.15c0-.85.05-2.06.05-3.61V15.07c0-1.59,0-2.8-.05-3.61a11.87,11.87,0,0,0-.47-3.15,4.23,4.23,0,0,0-2.5-2.5,11.87,11.87,0,0,0-3.15-.47c-.85,0-2.06,0-3.61,0H15.07c-1.55,0-2.76,0-3.61,0a12.49,12.49,0,0,0-3.15.47,4.23,4.23,0,0,0-2.5,2.5,11.87,11.87,0,0,0-.47,3.15c0,.85,0,2.06,0,3.61v1.86c0,1.55,0,2.76,0,3.61a12.49,12.49,0,0,0,.47,3.15,4.42,4.42,0,0,0,2.5,2.5,12.49,12.49,0,0,0,3.15.47c.85,0,2.06.05,3.61.05h1.86c1.59,0,2.8,0,3.61-.05a11.87,11.87,0,0,0,3.15-.47A4.42,4.42,0,0,0,26.19,23.69ZM16,9.3a6.46,6.46,0,0,1,3.35.91,6.64,6.64,0,0,1,2.44,2.44,6.62,6.62,0,0,1,0,6.7,6.64,6.64,0,0,1-2.44,2.44,6.62,6.62,0,0,1-6.7,0,6.64,6.64,0,0,1-2.44-2.44,6.62,6.62,0,0,1,0-6.7,6.64,6.64,0,0,1,2.44-2.44A6.46,6.46,0,0,1,16,9.3Zm0,11.07A4.37,4.37,0,0,0,20.37,16,4.37,4.37,0,0,0,16,11.63,4.37,4.37,0,0,0,11.63,16,4.37,4.37,0,0,0,16,20.37ZM24.56,9A1.57,1.57,0,1,0,23,10.58a1.41,1.41,0,0,0,1.07-.46A1.78,1.78,0,0,0,24.56,9Z"></path>
              </g></svg></a>
          </li>
        </ul>
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
