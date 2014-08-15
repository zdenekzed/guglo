(function ($) {
  Drupal.behaviors.rate = {
    attach: function(context) {
      $('.like-widget:not(.like-processed)', context).addClass('like-processed').each(function () {
        var widget = $(this);
        // as we use drupal_html_id() to generate unique ids
        // we have to truncate the '--<id>'
        var ids = widget.attr('id').split('--');
        ids = ids[0].match(/^like\-([a-z]+)\-([0-9]+)\-([0-9]+)\-([0-9])$/);
        var data = {
          content_type: ids[1],
          content_id: ids[2],
          widget_id: ids[3],
          widget_mode: ids[4]
        };

        $('a.like-button', widget).click(function() {
          var token = this.getAttribute('href').match(/like\=([a-zA-Z0-9\-_]{32,64})/)[1];
          return Drupal.likeVote(widget, data, token);
        });
      });
    }
  };

  Drupal.likeVote = function(widget, data, token) {
    // Invoke JavaScript hook.
    
    widget.trigger('eventBeforeRate', [data]);
     
    //$(".rate-info", widget).text(Drupal.t('Saving vote...'));
    var content_id = data.content_id;
    $(".likesresult-" + content_id).html('<span class="likesresult-' + content_id + '">' + Drupal.t('Saving...') + '</span>');
    $(".like-info").html(Drupal.t('Saving...'));

    // Random number to prevent caching, see http://drupal.org/node/1042216#comment-4046618
    var random = Math.floor(Math.random() * 99999);

    var q = (Drupal.settings.rate.basePath.match(/\?/) ? '&' : '?') + 'widget_id=' + data.widget_id + '&content_type=' + data.content_type + '&content_id=' + data.content_id + '&widget_mode=' + data.widget_mode + '&token=' + token + '&destination=' + encodeURIComponent(Drupal.settings.rate.destination) + '&r=' + random;
    if (data.value) {
      q = q + '&value=' + data.value;
    }

    // fetch all widgets with this id as class
    widget = $('.' + widget.attr('id'));

    $.get(Drupal.settings.basePath + 'like/vote/js' + q, function(response) {
      if (response.match(/^https?\:\/\/[^\/]+\/(.*)$/)) {
        // We got a redirect.
        document.location = response;
      }
      else {
        // get parent object
        var p = widget.parent();

        // Invoke JavaScript hook.
        widget.trigger('eventAfterRate', [data]);
        $(".likesresult-" + content_id).html(response);
        $(".like-info").html(response);
        
        widget.before(response);

        // remove widget
        widget.remove();
        widget = undefined;

        Drupal.attachBehaviors(p);
      }
    });

    return false;
  }
})(jQuery);



