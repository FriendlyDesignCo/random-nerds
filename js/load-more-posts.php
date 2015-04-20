$("#content-body").on('click', '.more-posts-link a', function(event){
  event.preventDefault();
  if ($(this).hasClass('disabled'))
    return false;

  var linkHolder = $(this).parents(".more-posts-link");
  var addDividerRow = linkHolder.hasClass('add-divider-row');
  $(this).parents(".more-posts-link").find('a.load-more').hide();
  $(this).parents(".more-posts-link").find('.loader, .loader-blue').show();
  var targetURL = $(this).attr('href');
  $.get(targetURL, function(data){
    linkHolder.remove();
    var newPosts = $(data).find("#content-body article:not(.first-article)");
    newPosts.each(function(){
      var post = $(this);
      post.find('filterable').addClass('hidden');
    });

    // Insert a divider row where appropriate
    if (addDividerRow) {
      console.log("Adding divider");
      $("#end-of-posts-marker").prev().append($('<div class="divider-row"><hr class="divider"></div>'));
    }
    newPosts.insertBefore($("#end-of-posts-marker"));
    updateIgnoredCategories(true, false);
    $(data).find('.more-posts-link').insertBefore($("#end-of-posts-marker"));
  });
});
