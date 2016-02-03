$(document).ready(function(){
  $('.scrollspy').scrollSpy();

  // Initialize collapse button
  $(".button-collapse").sideNav();
  $('.button-collapse').sideNav({
      edge: 'left', // Choose the horizontal origin
    }
  );
  });
