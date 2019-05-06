/* global IS_DEV */


import lazy from './components/lazy';
import animations from './components/animations';
import scroll from './components/smoothScroll';
function loaded() {

  lazy();
  animations();
  scroll(); 
}

document.addEventListener('DOMContentLoaded', loaded);
