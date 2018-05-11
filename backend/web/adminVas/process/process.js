$(document).ready(function() {
      $('body').on('click', '#linkFunction', function(event) {
        event.preventDefault();
        var url = $(this).data('target');
        location.replace(url);
      });
  });

  