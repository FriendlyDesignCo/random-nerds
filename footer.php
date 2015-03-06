      <?php $footerQuery = new WP_Query(array('post_type' => 'footer-message', 'posts_per_page' => 1));

      if ($footerQuery->have_posts()): ?>
        <?php while ($footerQuery->have_posts()): $footerQuery->the_post(); ?>
          <footer class="category-gaming">
            <div class="footer-content">
              <h3><?php the_title(); ?>:</h3>
              <hr class="tiny">
              <?php the_content(); ?>
            </div>
          </footer>
        <?php endwhile; ?>
      <?php endif; ?>
    </section> <!-- END content-body -->

  </section>

  <div class="mobile-only" id="filtering">
    Refiltering Posts <div class="loader"></div>
  </div>

  <?php wp_footer(); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="<?php echo bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>

  <script type="text/javascript">
  var sidebarLoadingMoreContent = false;
  var ignoredCategories; var categories = ['gaming','politics','pop-culture','tech'];
  var headerBottom = 100; var pastHeader = false;
  (function(m){m.fn.textfill=function(r){function f(){a.debug&&"undefined"!=typeof console&&"undefined"!=typeof console.debug&&console.debug.apply(console,arguments)}function s(){"undefined"!=typeof console&&"undefined"!=typeof console.warn&&console.warn.apply(console,arguments)}function p(a,b,e,k,n,g){function d(a,b){var c=" / ";a>b?c=" > ":a==b&&(c=" = ");return c}f("[TextFill] "+a+" { font-size: "+b.css("font-size")+",Height: "+b.height()+"px "+d(b.height(),e)+e+"px,Width: "+b.width()+d(b.width(),
k)+k+",minFontPixels: "+n+"px, maxFontPixels: "+g+"px }")}function q(a,b,e,k,f,g,d,h){for(p(a,b,f,g,d,h);d<h-1;){var l=Math.floor((d+h)/2);b.css("font-size",l);if(e.call(b)<=k){if(d=l,e.call(b)==k)break}else h=l;p(a,b,f,g,d,h)}b.css("font-size",h);e.call(b)<=k&&(d=h,p(a+"* ",b,f,g,d,h));return d}var a=m.extend({debug:!1,maxFontPixels:40,minFontPixels:4,innerTag:"span",widthOnly:!1,success:null,callback:null,fail:null,complete:null,explicitWidth:null,explicitHeight:null,changeLineHeight:!1},r);f("[TextFill] Start Debug");
this.each(function(){var c=m(a.innerTag+":visible:first",this),b=a.explicitHeight||m(this).height(),e=a.explicitWidth||m(this).width(),k=c.css("font-size"),n=parseFloat(c.css("line-height"))/parseFloat(k);f("[TextFill] Inner text: "+c.text());f("[TextFill] All options: ",a);f("[TextFill] Maximum sizes: { Height: "+b+"px, Width: "+e+"px }");var g=a.minFontPixels,d=0>=a.maxFontPixels?b:a.maxFontPixels,h=void 0;a.widthOnly||(h=q("Height",c,m.fn.height,b,b,e,g,d));var l=void 0,l=q("Width",c,m.fn.width,
e,b,e,g,d);a.widthOnly?(c.css({"font-size":l,"white-space":"nowrap"}),a.changeLineHeight&&c.parent().css("line-height",n*l+"px")):(g=Math.min(h,l),c.css("font-size",g),a.changeLineHeight&&c.parent().css("line-height",n*g+"px"));f("[TextFill] Finished { Old font-size: "+k+", New font-size: "+c.css("font-size")+" }");c.width()>e||c.height()>b&&!a.widthOnly?(c.css("font-size",k),a.fail&&a.fail(this),f("[TextFill] Failure { Current Width: "+c.width()+", Maximum Width: "+e+", Current Height: "+c.height()+
", Maximum Height: "+b+" }")):a.success?a.success(this):a.callback&&(s("callback is deprecated, use success, instead"),a.callback(this))});a.complete&&a.complete(this);f("[TextFill] End Debug");return this}})(window.jQuery);
$(".fittext").textfill({maxFontPixels: 100});
    $(function(){
      $(".fittext").textfill({maxFontPixels: 100});
      $(window).resize(function(){
        $(".fittext").textfill({maxFontPixels: 100});
      });
      $("#collapse-sidebar").click(function(event){
        event.preventDefault();
        $(this).toggleClass('closed');
        $("#content").toggleClass('sidebar-hidden');
        $("#content").toggleClass('sidebar-visible');
        setTimeout(function(){
          $(".fittext").textfill({maxFontPixels: 100});
        }, 100);
        setTimeout(function(){
          $(".fittext").textfill({maxFontPixels: 100});
        }, 525);
      });
      $("#menu-open, #menu-close").click(function(){
        $(this).toggleClass('open');
        $("#main-menu").toggleClass('onscreen');
        $("#home-signature").toggleClass('menu-open');
      });

      <?php /* Scroll for header */ ?>
      headerBottom = $(".page-header").offset().top+$(".page-header").height()-32;
      if ($(window).scrollTop() > headerBottom-32) {
        $("body").addClass('past-header');
        pastHeader = true;
      }
      $(window).scroll(function(){
        if ($(window).scrollTop() > headerBottom-32) {
          if (!pastHeader) {
            $("body").addClass('past-header');
            pastHeader = true;
          }
        }
        else
        {
          if (pastHeader) {
            $("body").removeClass('past-header');
            pastHeader = false;
          }
        }
      });

      <?php /* Async Disqus */ ?>
      <?php if (is_single()): ?>
      $(".comment-async").click(function(event){
        event.preventDefault();
        var disqus_shortname = '<?php echo ot_get_option('disqus_shortname'); ?>';
        var disqus_identifier = $(this).data('identifier');
        $.ajax({
          type: "GET",
          url: "http://" + disqus_shortname + ".disqus.com/embed.js",
          dataType: "script",
          cache: true
        });
        $("div.plus a").addClass('comments-loaded');
        $("a.load-comments").slideUp();
      });
      <?php endif; ?>

      <?php /* Related Posts Leveling */ ?>
      if ($(window).width() > 640) {
        if ($("#related-posts").length > 0) {
          var lowest = 0;
          $("#related-posts span.yuzo_text").each(function(){
            if ($(this).position().top > lowest)
              lowest = $(this).position().top;
          });
          $("#related-posts span.yuzo_text").each(function(){
            if ($(this).position().top != lowest) {
              $(this).css('margin-top',20+lowest-$(this).position().top);
            }
          });
        }
      }

      <?php /* Inifinite Scroll */ ?>
      $.fn.whenScrolledToBottom = function (cback_fxn, offset) {
        this.on('scroll',this,function(ev){
         if(!sidebarLoadingMoreContent && ev.data.scrollTop() >= ev.data[0].scrollHeight - ev.data.height() - offset){
           sidebarLoadingMoreContent = true;
             return cback_fxn.apply(ev.data, arguments)
         }
       });
      };
      var $fixed = $("#article-sidebar");
      var loadMoreSidebarPosts = function(){
        var targetURL = $("a.load-more-sidebar-pages").last().attr('href');
        if (targetURL == undefined)
          return;
        $("a.load-more-sidebar-pages").remove();
        $("#article-sidebar .loader-container").toggleClass('hidden');
        $fixed.animate({scrollTop:$fixed.get(0).scrollHeight},400);
        $.get(targetURL, function(data){
          var newPosts = $(data).find('#sidebar-posts div.post');
          newPosts.each(function(){
            var post = $(this);
            post.find('filterable').addClass('hidden');
          });
          $("#sidebar-posts").append(newPosts);
          updateIgnoredCategories(true, false);
          $("#article-sidebar .loader-container").slideUp(300,function(){$("#article-sidebar .loader-container").addClass("hidden").removeAttr('style');});
          $(data).find('a.load-more-sidebar-pages').insertBefore($(".loader-container"));
          window.sidebarLoadingMoreContent = false;
        });
      };
      $("#article-sidebar").on('click','a.load-more-sidebar-pages', function(event){
        event.preventDefault();
        loadMoreSidebarPosts();
      });
      $fixed.whenScrolledToBottom(loadMoreSidebarPosts, 0);

      <?php /* Filtering */ ?>
      $.cookie.json = true;
      ignoredCategories = $.cookie('ignoredCategories');
      if (ignoredCategories === undefined)
        ignoredCategories = [];

      function updateIgnoredCategories(animate, addFilteringClass) {
        var selector = '';
        $(categories).each(function(index,value){
          if ($.inArray(value, ignoredCategories) == -1) {
            selector = selector + ':not(.category-'+value+')';
            $(".filterable.category-"+value+".hidden").slideDown().removeClass('hidden');
          }
        });
        if (animate) {
          if (addFilteringClass)
            $("body").addClass('filtering');
          setTimeout(function(){ $("body").removeClass('filtering'); },1000);
          $(".filterable" + selector + ":not(.hidden)").slideUp(400,function(){
            $(this).addClass('hidden').removeAttr('style');
          });
        } else {
          $(".filterable" + selector).addClass('hidden').removeAttr('style');
        }
      }

      $("#avatar-select").on('click','a.apply-filter',function(event){
        event.preventDefault();
        var category = $(this).data('category');
        if ($.inArray(category, ignoredCategories) != -1) {
          ignoredCategories.splice($.inArray(category, ignoredCategories), 1);
        } else {
          ignoredCategories.push(category);
        }
        $(this).toggleClass('disabled');
        $.cookie('ignoredCategories',ignoredCategories,{path:'/',expires:365});
        updateIgnoredCategories(true, true);
      });
      updateIgnoredCategories(false, false);

      $("#main-menu").removeAttr('style');
    });
  </script>

  <?php /* Comment Counts */ ?>
  <?php if (is_single()): ?>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES * * */
        var disqus_shortname = '<?php echo ot_get_option('disqus_shortname'); ?>';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>
  <?php endif; ?>

  </body>
</html>
