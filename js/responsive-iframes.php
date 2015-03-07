var resizeIframes = function(){
  $("body iframe").each(function(){
    var width = $(this).parent().width();
    var height = width*(this.height / this.width);
    $(this).width(width).height(height);
  });
};
$(window).resize(resizeIframes);
resizeIframes();
