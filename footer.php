      <?php $footerQuery = new WP_Query(array('post_type' => 'footer-message', 'posts_per_page' => 1));

      if ($footerQuery->have_posts()): ?>
        <?php while ($footerQuery->have_posts()): $footerQuery->the_post(); ?>
          <footer class="<?php foreach (wp_get_post_categories(get_the_ID()) as $categoryID): $category = get_category($categoryID); ?>category-<?php echo $category->slug; ?><?php endforeach; ?>">
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

  <div class="mobile-only sidebar-loading-message" id="filtering">
    <span>Refiltering Posts</span> <div class="loader"></div>
  </div>

  <?php wp_footer(); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="<?php echo bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>
  <script src="<?php echo bloginfo('template_url'); ?>/js/jquery.resize.js"></script>
  <?php if (is_single()): ?>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script type="text/javascript">var confetti;</script>
    <script src="<?php echo bloginfo('template_url'); ?>/js/confetti.js"></script>
  <?php endif; ?>

  <script type="text/javascript">
  var confetti;
  var sidebarLoadingMoreContent = false;
  var ignoredCategories; var categories = ['gaming','politics','pop-culture','tech'];
  var refilteringTexts = ['Refiltering posts','Reticulating splines','Dynotherms connecting','Refactoring pixelations','Powering atomic batteries'];
  var headerBottom = 100; var pastHeader = false;
  (function(m){m.fn.textfill=function(r){function f(){a.debug&&"undefined"!=typeof console&&"undefined"!=typeof console.debug&&console.debug.apply(console,arguments)}function s(){"undefined"!=typeof console&&"undefined"!=typeof console.warn&&console.warn.apply(console,arguments)}function p(a,b,e,k,n,g){function d(a,b){var c=" / ";a>b?c=" > ":a==b&&(c=" = ");return c}f("[TextFill] "+a+" { font-size: "+b.css("font-size")+",Height: "+b.height()+"px "+d(b.height(),e)+e+"px,Width: "+b.width()+d(b.width(),
k)+k+",minFontPixels: "+n+"px, maxFontPixels: "+g+"px }")}function q(a,b,e,k,f,g,d,h){for(p(a,b,f,g,d,h);d<h-1;){var l=Math.floor((d+h)/2);b.css("font-size",l);if(e.call(b)<=k){if(d=l,e.call(b)==k)break}else h=l;p(a,b,f,g,d,h)}b.css("font-size",h);e.call(b)<=k&&(d=h,p(a+"* ",b,f,g,d,h));return d}var a=m.extend({debug:!1,maxFontPixels:40,minFontPixels:4,innerTag:"span",widthOnly:!1,success:null,callback:null,fail:null,complete:null,explicitWidth:null,explicitHeight:null,changeLineHeight:!1},r);f("[TextFill] Start Debug");
this.each(function(){var c=m(a.innerTag+":visible:first",this),b=a.explicitHeight||m(this).height(),e=a.explicitWidth||m(this).width(),k=c.css("font-size"),n=parseFloat(c.css("line-height"))/parseFloat(k);f("[TextFill] Inner text: "+c.text());f("[TextFill] All options: ",a);f("[TextFill] Maximum sizes: { Height: "+b+"px, Width: "+e+"px }");var g=a.minFontPixels,d=0>=a.maxFontPixels?b:a.maxFontPixels,h=void 0;a.widthOnly||(h=q("Height",c,m.fn.height,b,b,e,g,d));var l=void 0,l=q("Width",c,m.fn.width,
e,b,e,g,d);a.widthOnly?(c.css({"font-size":l,"white-space":"nowrap"}),a.changeLineHeight&&c.parent().css("line-height",n*l+"px")):(g=Math.min(h,l),c.css("font-size",g),a.changeLineHeight&&c.parent().css("line-height",n*g+"px"));f("[TextFill] Finished { Old font-size: "+k+", New font-size: "+c.css("font-size")+" }");c.width()>e||c.height()>b&&!a.widthOnly?(c.css("font-size",k),a.fail&&a.fail(this),f("[TextFill] Failure { Current Width: "+c.width()+", Maximum Width: "+e+", Current Height: "+c.height()+
", Maximum Height: "+b+" }")):a.success?a.success(this):a.callback&&(s("callback is deprecated, use success, instead"),a.callback(this))});a.complete&&a.complete(this);f("[TextFill] End Debug");return this}})(window.jQuery);
  ;(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery);
$(".fittext").textfill({maxFontPixels: 100});
    if ($(window).width() <= 640) {
      $(".mobile-fittext").textfill({maxFontPixels: 100});
      setTimeout(function(){$(".mobile-fittext").textfill({maxFontPixels: 100});}, 300);
    }
    $(function(){
      <?php /* Page header */ ?>
      if ($("body").hasClass('page') || $("body").hasClass('error404')) {
        var pageHeaderBreakpointSet = function(){
          var pageHeader = $(".page-header");
          if (pageHeader.width() < 875) {
            pageHeader.addClass('skinny');
            pageHeader.removeClass('fat');
            $(".page-header img.skinny-only").animate({left:0},300);
          }
          else
          {
            pageHeader.addClass('fat');
            pageHeader.removeClass('skinny');
            $(".page-header img.fat-only").animate({left:0},300);
          }
          $(".fittext").textfill({maxFontPixels: 100});
        };
        $(".page-header").resize(pageHeaderBreakpointSet);
        pageHeaderBreakpointSet();
      }

      // Text size filling
      $(".fittext").textfill({maxFontPixels: 100});
      $(window).resize(function(){
        $(".fittext").textfill({maxFontPixels: 100});
      });

      // Form submission
      $("a.send-form").click(function(event){
        event.preventDefault();
        $(this).parents('form').submit();
      });

      <?php /* Authors need to set the category on the articles to colorize, and profile image nonsense */ ?>
      if ($("body").hasClass('author')) {
        $("span.colorize-categories a").each(function(){
          $(this).addClass('category-'+$(this).html().toLowerCase().replace(' ','-'));
        });
      }
      var checkBodyColumnWidth = function(){
        var contentBody = $("#content-body");
        if (contentBody.hasClass('sub-1000') && contentBody.width() > 1000) {
          contentBody.removeClass('sub-1000');
        }
        if (!contentBody.hasClass('sub-1000') && contentBody.width() <= 1000) {
          contentBody.addClass('sub-1000');
        }
        if (contentBody.hasClass('mobile-width') && contentBody.width() > 640) {
          contentBody.removeClass('mobile-width');
          contentBody.find('article').removeClass('mobile-width');
        }
        if (!contentBody.hasClass('mobile-width') && contentBody.width() <= 640) {
          contentBody.addClass('mobile-width');
          contentBody.find('article').addClass('mobile-width');
        }
      }
      $("#content-body").resize(checkBodyColumnWidth);
      checkBodyColumnWidth();

      <?php /* Sidebar Collapse Button */ ?>
      var sidePosition = $("#article-sidebar").offset().left+$("#article-sidebar").width()-$("#collapse-sidebar").width();
      if (sidePosition < 0)
        sidePosition = 2;
      $("#collapse-sidebar").css('left',sidePosition);
      $("#collapse-sidebar").click(function(event){
        event.preventDefault();
        if ($('#content').hasClass('closed')) {
          // Open it up
          $.cookie('sidebar-state','open',{expires:7, path:'/'});
          $("#content").removeClass('closed');
          $("#collapse-sidebar").animate({left:$("#article-sidebar").width()}, {duration:300,queue:false,done:function(){$(this).toggleClass('closed');}});
          $("#article-sidebar").animate({'margin-left':0},{duration:300,queue:false});
          $("#content-body").animate({'margin-left':$("#article-sidebar").width()},{duration:300,queue:false});
          setTimeout(function(){
            var newHeight = 0;
            if ($("body").hasClass("admin-bar"))
              newHeight += 32;
            $("#avatar-select").animate({'padding-top':newHeight}, {duration:300, queue:false});
          },300);
        } else {
          // Close it down
          $.cookie('sidebar-state','closed',{expires:7, path:'/'});
          $("#article-sidebar").animate({'margin-left':-1*$("#article-sidebar").width()}, {duration: 300, queue: false}, function(){
          });
          $("#content-body").animate({'margin-left':0}, {duration:300, queue:false});
          $("#collapse-sidebar").animate({left:0}, {duration:300,queue:false}).toggleClass('closed');
          var newHeight = $("#collapse-sidebar").height();
          if ($("body").hasClass("admin-bar"))
            newHeight += 32;
          $("#avatar-select").animate({'padding-top':newHeight}, {duration:300, queue:false});
          $("#content").addClass('closed');
          setTimeout(function(){
            $("#article-sidebar .article.featured").removeAttr('style');
            $("#article-sidebar .article.featured h2").removeAttr('style');
          },300);
        }
        return;
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
        } else {
          if (pastHeader) {
            $("body").removeClass('past-header');
            pastHeader = false;
          }
        }
      });

      <?php /* Related Posts Leveling */ ?>
      if ($("#content-body").width() > 640) {
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

      <?php /* Infinite Scroll */ ?>
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

      <?php /* Animated pull quotes */ ?>
      $.fn.blockQuoteBecomesVisible = function (cback_fxn, offset) {
        var $blockQuote = this;
        $(window).bind('scroll.blockquote-'+$blockQuote.offset().top,function(ev){
         if($blockQuote.offset().top <= $(window).scrollTop()+$(window).height()-offset){
           $(window).unbind('scroll.blockquote-'+$blockQuote.offset().top);
           return cback_fxn.apply($blockQuote, arguments);
         }
       });
      };
      $("article blockquote").each(function(){
        if (!$(this).visible()){
          $(this).find('p').css({top:50,opacity:0,position:'relative'},1000);
          $(this).blockQuoteBecomesVisible(function(){
            $(this).find('p').animate({top:0,opacity:1},300);
          }, 200);
        }
      });

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
        if ($("#collapse-sidebar").hasClass('closed')) {
          $("#collapse-sidebar").click();
        }
        $(".sidebar-loading-message > span").html(refilteringTexts[Math.floor(Math.random()*refilteringTexts.length)]);
        var category = $(this).find('.avatar-icon').data('category');

        if ($("#avatar-select").hasClass('none-selected')) {
          ignoredCategories = categories.slice(0);
          ignoredCategories.splice($.inArray(category, ignoredCategories), 1);
          $("#avatar-select").removeClass('none-selected');
          $("#avatar-select").find('.avatar-icon').addClass('disabled');
          $(this).find('.avatar-icon').removeClass('disabled');
        } else {
          // If there is a category selected, and it's this one...
          if ($.inArray($(this).find('.avatar-icon').data('category'), ignoredCategories) == -1) {
            console.log("Un-disabling everything");
            ignoredCategories = [];
            $("#avatar-select").find('.avatar-icon.disabled').removeClass('disabled');
          } else {
            ignoredCategories = categories.slice(0);
            ignoredCategories.splice($.inArray(category, ignoredCategories), 1);
            $("#avatar-select").find('.avatar-icon').addClass('disabled');
            $(this).find('.avatar-icon').removeClass('disabled');
          }
        }

        if (ignoredCategories.length == 0)
          $("#avatar-select").addClass('none-selected');

        $.cookie('ignoredCategories',ignoredCategories,{path:'/',expires:365});
        updateIgnoredCategories(true, true);
      });
      updateIgnoredCategories(false, false);

      <?php include('js/load-more-posts.php'); ?>
      <?php include('js/responsive-iframes.php'); ?>

      <?php /* Mailchimp Subscription Form */ ?>
      $("#mailchimp-subscribe a").click(function(event){
        event.preventDefault();
        $(this).parents("form").find('.submit').click();
      });
      $("#mailchimp-subscribe").submit(function(event){
        event.preventDefault();
        $(this).find('input').animate({'width':0}, 300, function(){ $(this).hide(); });
        $.post('/', $(this).serialize(), function(data){
          $("#mailchimp-subscribe").html("<p><i class='fa fa-thumbs-up'></i> Thanks for subscribing! <i class='fa fa-thumbs-up'></i></p>");
        }).error(function(){
          $("#mailchimp-subscribe").append($("<p>Something went wrong, try again!</p>"));
          $("#mailchimp-subscribe input").animate({'width':215});
        });
      });

      $("#main-menu").removeAttr('style');

      <?php /* Tipping */ ?>
      if ($("body").hasClass('single')) {
        var stripeHandler = StripeCheckout.configure({
          key: <?php include_once('extra-config.php'); ?>'<?php echo STRIPE_PUBLISHABLE_KEY; ?>',
          token: function(token) {
            $("#love-it h3").fadeOut();
            $("#tip-form input[name=token]").val(token.id);
            $("#tip-form input[name=email]").val(token.email);
            $("#tip-form").find('input, select, a').slideUp();
            $("#love-it .loader").slideDown();
            $.post($("#tip-form").attr('action'), $("#tip-form").serialize(), function(data){
              $("#tip-form").html(data);
            }).done(function(){
              $("#love-it .loader").slideUp();
            }).error(function(data){
              $("#love-it .loader").slideUp();
              $("#tip-form").find('input, select, a').slideDown();
              $("#tip-form").append($("<p class='error'>Sorry, your card was declined - please try again</p>"));
            });
          }
        });
      }
      $("#tip-form #tip-button").click(function(event){
        event.preventDefault();
        stripeHandler.open({
          name: 'RandomNerds',
          description: '<?php global $stripeDescription; echo $stripeDescription; ?>',
          amount: $("#tip-form input[name=tip_value]").val(),
          panelLabel: 'Tip {{amount}}'
        })
      });
      $("#tip-form").on('click', '#one-click-subscribe', function(event){
        event.preventDefault();
        $.post('/',{'mailchimp_email_subscribe':$(this).data('email')}, function(data){
          $("#one-click-subscribe").fadeOut(300, function(){
            $("#tip-form").html("<h3>Sweet. Done. Thank you.</h3>").hide().fadeIn();;
          });
        });
      });
      $("#tip-form .value-select").click(function(event){
        if ($(event.target).hasClass('value-select') || $(event.target).parent().hasClass('value-select')) {
          var options = $(this).find('.value-options');
          if (options.is(':visible'))
            options.slideUp();
          else
            options.slideDown();
        }
        if ($(event.target).data('value')) {
          var value = $(event.target).data('value');
          $("#tip-form input[name=tip_value]").val(value*100).trigger('change');
          $("#tip-form .value-select > span").html(value);
          $("#tip-form .value-options").slideUp();
        }
      });
      $("#tip-form input[name=tip_value]").change(function(){
        if ($(this).val() > 9000*100) {
          $("#over-9000").fadeIn();
        } else {
          if ($("#over-9000").is(':visible')) {
            $("#over-9000").fadeOut();
          }
        }
        if ($(this).val() > 499 && $(this).val() < 9000*100) {
          $("body").append($("<canvas id='confetti' style='position:fixed;top:0;z-index:5;height:'+$(window).height()+';width:'+window.width()+'></canvas>"));
          window.confettiPaperCount = $("#tip-form input[name=tip_value]").val();
          window.speed = 100;
          confetti = getConfettiContext();
          confetti = new confetti.Context('confetti');
          confetti.start();
          setTimeout(function(){
            confetti.stop(); confetti = null;
            $("canvas#confetti").remove();
          }, 5000);
        }
      });

      <?php /* Hide menu on clicking elsewhere */ ?>
      $(document).on('click',function(event){
        if (!$(event.target).closest('#main-menu').length && $(event.target).attr('id') !== 'menu-open' && !$(event.target).hasClass('icon-bar')) {
          if ($("#menu-open").hasClass('open')) {
            $("#menu-open").toggleClass('open');
            $("#main-menu").toggleClass('onscreen');
          }
        }
      });

      <?php /* 404 */ ?>
      if ($("body").hasClass('error404')) {
        $.get('http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC&tag=fail&rating=pg', function(data){
          $(".giphy").append('<img src=' + data.data.image_url + '>');
        });
      }

      <?php /* Citation tooltips */ ?>
      $("article").each(function(){
        var i = 1;
        $(this).find('cite').each(function(){
          $(this).html(i++);
        });
      });
      var targets = $( '[rel~=tooltip]' ),
        target  = false,
        tooltip = false,
        title   = false;
      targets.bind( 'mouseenter', function() {
          target  = $(this);
          tip     = target.attr( 'title' );
          tooltip = $( '<div id="tooltip"></div>' );
          if( !tip || tip == '' )
              return false;
          target.removeAttr( 'title' );
          tooltip.css( 'opacity', 0 )
                 .html( tip )
                 .appendTo($(this));
          var init_tooltip = function() {
              if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                  tooltip.css( 'max-width', $( window ).width() / 2 );
              else
                  tooltip.css( 'max-width', 340 );
              width = 340;
              if ($(window).width() < width)
                width = $(window).width()-40;

              var pos_left = -170-target.outerWidth()/2+5,
                  pos_top  = 0 - tooltip.outerHeight() - 20;

              if( target.offset().left + pos_left < 0 ) {
                  pos_left = 0 + target.outerWidth() / 2 - 20;
                  tooltip.addClass( 'left' );
                  tooltip.css('max-width', $(window).width()-target.offset().left-20);
              }
              else
                  tooltip.removeClass( 'left' );

              if( pos_left + target.offset().left + 370 > $( window ).width() && !tooltip.hasClass('left') ) {
                if (target.offset().left-width < 0) {
                  width = target.offset().left-10;
                  pos_left = -width;
                  tooltip.addClass( 'right' );
                }
              }
              else
                  tooltip.removeClass( 'right' );

              if( pos_top < 0 ) {
                  var pos_top  = 0 + target.outerHeight();
                  tooltip.addClass( 'top' );
              }
              else
                  tooltip.removeClass( 'top' );
              tooltip.css( { left: pos_left, top: pos_top, width: width } ).animate( { top: '+=10', opacity: 1 }, 50 );
          };

          init_tooltip();
          $( window ).resize( init_tooltip );

          var remove_tooltip = function() {
              tooltip.animate( { top: '-=10', opacity: 0 }, 50, function() {
                  $( this ).remove();
              });
              target.attr( 'title', tip );
          };

          target.bind( 'mouseleave', remove_tooltip );
          tooltip.bind( 'click', remove_tooltip );
      });
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
