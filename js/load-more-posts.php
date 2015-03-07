$("#content-body").on('click', '.more-posts-link a', function(event){
  event.preventDefault();

  var linkHolder = $(this).parents(".more-posts-link");
  $(this).parents(".more-posts-link").find('a.load-more').hide();
  $(this).parents(".more-posts-link").find('.loader').show();
  var targetURL = $(this).attr('href');
  $.get(targetURL, function(data){
    linkHolder.remove();
    var newPosts = $(data).find("#content-body article:not(.first-article)");
    newPosts.each(function(){
      var post = $(this);
      post.find('filterable').addClass('hidden');
    });
    newPosts.insertBefore($("#content-body footer"));
    updateIgnoredCategories(true, false);
    $(data).find('.more-posts-link').insertBefore($("#content-body footer"));
  });
});
