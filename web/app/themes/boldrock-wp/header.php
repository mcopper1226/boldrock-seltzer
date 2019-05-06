<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="alternate" type="application/atom+xml" href="<?php bloginfo('atom_url'); ?>">
  <?php if (has_post_thumbnail() ) :
    $bgid = get_post_thumbnail_id();
    $bgsrc1 = wp_get_attachment_image_src( $bgid, 'medium_large');
    $bgsrc = $bgsrc1[0]; ?>
    <style>
      @media screen and (max-width: 960px) {
        .hero {
          background-image: url('<?php echo $bgsrc; ?>');
        }
      }
    </style>
  <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="pageWrapper">
    <header>
      <div class="top-banner"><a href="http://boldrock.com" target="_blank">Visit Bold Rock Hard Cider</a></div>

      <div class="header-outer">
        <a class="logo-wrap" href="/">
      <img src="<?php echo THEME_IMG_PATH . '/hs-logo.svg';?>" />
        </a>
        <div class="social-links-wrap">
          <ul class="social-links">
            <li class="social_link">
              <a href="http://www.facebook.com/pages/McIntire-School-of-Commerce/25457884806" target="_blank"><svg id="facebook" viewbox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
              <path class="cls-1" d="M13.1,17.42H9v-4.8H13.1V8.83a6.24,6.24,0,0,1,1.69-4.67A6.09,6.09,0,0,1,19.27,2.5,26.24,26.24,0,0,1,23,2.71V7H20.43a2.41,2.41,0,0,0-1.95.64,2.69,2.69,0,0,0-.42,1.68v3.32h4.48l-.63,4.8H18.06V29.5h-5Z"></path></svg></a>
            </li>

            <li class="social_link">
              <a href="http://instagram.com/uvamcintire" target="_blank"><svg viewbox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g id="instagram">
                  <path class="cls-1" d="M29,10.58c0,1.09.05,2.9.05,5.42s0,4.34-.08,5.44a11.19,11.19,0,0,1-.5,2.89,6.81,6.81,0,0,1-4.13,4.13,11.19,11.19,0,0,1-2.89.5C20.34,29,18.52,29,16,29s-4.34,0-5.44-.08a9.63,9.63,0,0,1-2.89-.56,6.18,6.18,0,0,1-2.53-1.54,6.78,6.78,0,0,1-1.6-2.53A11.19,11.19,0,0,1,3,21.44C3,20.34,3,18.52,3,16s0-4.34.08-5.44a11.19,11.19,0,0,1,.5-2.89A6.81,6.81,0,0,1,7.67,3.54,11.19,11.19,0,0,1,10.56,3C11.66,3,13.48,3,16,3s4.34,0,5.44.08a11.19,11.19,0,0,1,2.89.5,6.81,6.81,0,0,1,4.13,4.13A12.11,12.11,0,0,1,29,10.58Zm-2.8,13.11a12.49,12.49,0,0,0,.47-3.15c0-.85.05-2.06.05-3.61V15.07c0-1.59,0-2.8-.05-3.61a11.87,11.87,0,0,0-.47-3.15,4.23,4.23,0,0,0-2.5-2.5,11.87,11.87,0,0,0-3.15-.47c-.85,0-2.06,0-3.61,0H15.07c-1.55,0-2.76,0-3.61,0a12.49,12.49,0,0,0-3.15.47,4.23,4.23,0,0,0-2.5,2.5,11.87,11.87,0,0,0-.47,3.15c0,.85,0,2.06,0,3.61v1.86c0,1.55,0,2.76,0,3.61a12.49,12.49,0,0,0,.47,3.15,4.42,4.42,0,0,0,2.5,2.5,12.49,12.49,0,0,0,3.15.47c.85,0,2.06.05,3.61.05h1.86c1.59,0,2.8,0,3.61-.05a11.87,11.87,0,0,0,3.15-.47A4.42,4.42,0,0,0,26.19,23.69ZM16,9.3a6.46,6.46,0,0,1,3.35.91,6.64,6.64,0,0,1,2.44,2.44,6.62,6.62,0,0,1,0,6.7,6.64,6.64,0,0,1-2.44,2.44,6.62,6.62,0,0,1-6.7,0,6.64,6.64,0,0,1-2.44-2.44,6.62,6.62,0,0,1,0-6.7,6.64,6.64,0,0,1,2.44-2.44A6.46,6.46,0,0,1,16,9.3Zm0,11.07A4.37,4.37,0,0,0,20.37,16,4.37,4.37,0,0,0,16,11.63,4.37,4.37,0,0,0,11.63,16,4.37,4.37,0,0,0,16,20.37ZM24.56,9A1.57,1.57,0,1,0,23,10.58a1.41,1.41,0,0,0,1.07-.46A1.78,1.78,0,0,0,24.56,9Z"></path>
                </g></svg></a>
            </li>

          </ul>
        </div>
      </div>

  </header>
