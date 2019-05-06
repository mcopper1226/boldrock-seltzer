export default function lazy() {
  var placeholder = document.getElementsByClassName('placeholder');

      if (placeholder.length) {
        var small = placeholder[0].querySelector('.img-small');
        // 1: load small image and show it
        var img = new Image();
        img.src = small.src;
        img.onload = function () {
         small.classList.add('loaded');
        };

        // 2: load large image
        var imgLarge = new Image();
        imgLarge.src = placeholder[0].dataset.large;
        imgLarge.onload = function () {
          imgLarge.classList.add('loaded');
        };
        placeholder[0].appendChild(imgLarge);
      }

}
