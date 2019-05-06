export default function animations() {
  console.log('im ready!');
  var fir = document.querySelectorAll('.fade-in-right');
  for (var i = 0; i < fir.length; i++) {
    var waypoint = new Waypoint({
    element:fir[i],
    handler: function() {
      this.element.classList.add('fadeInRight');
    },
    offset: '100%'
  })
  }

  var fi = document.querySelectorAll('.fade-in');
  for (var i = 0; i < fi.length; i++) {
    var waypoint = new Waypoint({
    element:fi[i],
    handler: function() {
      this.element.classList.add('fadeIn');
    },
    offset: '100%'
  })
  }

  var fiu = document.querySelectorAll('.fade-in-up');
  for (var i = 0; i < fiu.length; i++) {
    var waypoint = new Waypoint({
    element:fiu[i],
    handler: function() {
      this.element.classList.add('fadeInUp');
    },
    offset: '100%'
  })
  }

  var fil = document.querySelectorAll('.fade-in-left');
  for (var i = 0; i < fil.length; i++) {
    var waypoint = new Waypoint({
    element:fil[i],
    handler: function() {
      this.element.classList.add('fadeInLeft');
    },
    offset: '75%'
  })
  }
}
