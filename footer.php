      <?php $footerQuery = new WP_Query(array('post_type' => 'footer-message', 'posts_per_page' => 1));

      if ($footerQuery->have_posts()): ?>
        <?php while ($footerQuery->have_posts()): $footerQuery->the_post(); ?>
          <footer class="<?php the_field('avatar'); ?> right">
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

  <div id="search-anywhere" class="hidden">
    <p>Search at any time, just start typing.<br>Return submits. ESC exits.</p>
    <?php get_search_form(); ?>
    <a href="#" id="cancel-search"><span class="icon-bar"></span><span class="icon-bar"></span></a>
  </div>

  <?php wp_footer(); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="<?php echo bloginfo('template_url'); ?>/js/jquery.cookie.js"></script>
  <script src="<?php echo bloginfo('template_url'); ?>/js/jquery.resize.js"></script>
  <?php if (is_single()): ?>
    <script src="https://checkout.stripe.com/checkout.js"></script>
  <?php endif; ?>

  <script type="text/javascript">
  var sidebarLoadingMoreContent = false;
  var ignoredCategories; var categories = ['gaming','politics','pop-culture','tech'];
  var refilteringTexts = ['Refiltering posts','Reticulating splines','Dynotherms connecting','Refactoring pixelations','Powering atomic batteries'];
  var headerBottom = 100; var pastHeader = false;
  ;(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery);
    $(function(){
      <?php /* Article Header Image */ ?>
      var selectHeaderImage = function(){
        if ($("div.article-header-image").length > 0) {
          var headerImage = '';
          var bodyWidth = $("#content-body").width();
          if (bodyWidth <= 480 && $("div.article-header-image").data('mobile-image'))
            headerImage = $("div.article-header-image").data('mobile-image');
          if ((headerImage === '' || (bodyWidth > 480 && bodyWidth <= 768)) && $("div.article-header-image").data('tablet-image'))
            headerImage = $("div.article-header-image").data('tablet-image');
          if ((headerImage === '' || (bodyWidth > 768)) && $("div.article-header-image").data('desktop-image'))
            headerImage = $("div.article-header-image").data('desktop-image');
          if (headerImage === '' && $("div.article-header-image").data('featured-image'))
            headerImage = $("div.article-header-image").data('featured-image');
          $("div.article-header-image").css({'background-image':"url('" + headerImage + "')"});
        }
      };
      selectHeaderImage();
      $(window).resize(selectHeaderImage);
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
        };
        $(".page-header").resize(pageHeaderBreakpointSet);
        pageHeaderBreakpointSet();
      }

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
        if (contentBody.hasClass('mobile-width') && contentBody.width() > 750) {
          contentBody.removeClass('mobile-width');
          contentBody.find('article').removeClass('mobile-width');
        }
        if (!contentBody.hasClass('mobile-width') && contentBody.width() <= 750) {
          contentBody.addClass('mobile-width');
          contentBody.find('article').addClass('mobile-width');
        }
        if ($(document).width() <= 750) {
          $("#content-body").css({'margin-right':0});
          $("#content-body").css({'margin-left':0});
        } else {
          if ($("body").hasClass('sidebar-closed'))
          {
            $("#content-body").css({'margin-right':-250});
            $("#content-body").css({'margin-left':250});
          }
          else
          {
            $("#content-body").css({'margin-right':0});
            $("#content-body").css({'margin-left':250});
          }
        }
      }
      $("#content-body").resize(checkBodyColumnWidth);
      checkBodyColumnWidth();

      <?php /* Sidebar Collapse Button */ ?>
      $("#collapse-sidebar").click(function(event){
        event.preventDefault();
        if ($('#content').hasClass('closed')) {
          // Open it up
          $.cookie('sidebar-state','open');
          $("body").toggleClass('sidebar-open').toggleClass('sidebar-closed');
          $("#content").removeClass('closed');
          setTimeout(function(){
            $("#content-body").css({'margin-right':0});
          }, 1);
          setTimeout(function(){
            var newHeight = 10;
            if ($("body").hasClass("admin-bar"))
              newHeight += 32;
            $("#avatar-select").animate({'padding-top':newHeight}, {duration:300, queue:false});
          },300);
        } else {
          // Close it down
          $.cookie('sidebar-state','closed');
          $("body").toggleClass('sidebar-open').toggleClass('sidebar-closed');
          var newHeight = 65;
          if ($("body").hasClass("admin-bar"))
            newHeight += 32;
          $("#avatar-select").animate({'padding-top':newHeight}, {duration:300, queue:false});
          $("#content").addClass('closed');
          setTimeout(function(){
            $("#content-body").css({'margin-right':-250});
          }, 1);
          setTimeout(function(){
            $("#article-sidebar .article.featured").removeAttr('style');
            $("#article-sidebar .article.featured h2").removeAttr('style');
          },300);
        }
        return;
        $(this).toggleClass('closed');
        $("#content").toggleClass('sidebar-hidden');
        $("#content").toggleClass('sidebar-visible');
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
      var mobileScrolling = function() {
        if ($(window).width() <= 750) {
          if ($(window).scrollTop() > 25) {
            $("#menu-open, #mobile-home").addClass('fixed');
          } else {
            $("#menu-open, #mobile-home").removeClass('fixed');
          }

          if ($('body').hasClass('home') || $('body').hasClass('single-post')) {
            if ($(window).scrollTop() < $(".page-header").first().offset().top+parseInt($(".page-header").first().css('padding-bottom'))) {
              $("#mobile-home:visible").fadeOut();
            } else {
              $("#mobile-home:hidden").fadeIn();
            }
          }
        } else {
          $("#mobile-home:visible").hide();
        }
      };

      $(window).scroll(function(){
        mobileScrolling();
      });
      mobileScrolling();

      <?php /* Related Posts Leveling */ ?>
      if ($("#content-body").width() > 750) {
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
      $("a.link-list").each(function(){
        if ($(this).data('primary-category')) {
          $(this).wrap('<article class="primary-' + $(this).data('primary-category') + '"></article>');
          $(this).addClass('article-title');
        }
      });

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
          if ($(data).find('a.load-more-sidebar-pages').length == 0) {
            $("#end-of-the-net").slideDown();
          }
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

      <?php /* Search Anywhere */ ?>
      $("#search-anywhere input[type=search]").attr('autocomplete','off').val('');
      $("#search-anywhere input[type=search]").attr('placeholder','Click here.');
      $("#cancel-search").click(function(e){
        e.preventDefault();
        $("#search-anywhere").fadeOut();
        $("#search-anywhere input[type=search]").val('');
        $("#menu-open").fadeIn();
      });
      $("#search-button").click(function(e){
        e.preventDefault();
        if ($("#menu-open").hasClass('open')) {
          $("#menu-open").toggleClass('open');
          $("#main-menu").toggleClass('onscreen');
        }
        $("#menu-open").fadeOut();
        $("#mobile-home").fadeOut();
        var searchInput = $("#search-anywhere input[type=search]").first();
        $("#search-anywhere:hidden").fadeIn(400, function(){
          searchInput.focus();
          searchInput[0].setSelectionRange(searchInput.val().length*2, searchInput.val().length*2);
        });
      });
      $(document).on('keypress', function(e) {
        var tag = e.target.tagName.toLowerCase();
        var key = e.which;
        if (e.ctrlKey || e.metaKey)
          return;
        var isLetter = (key >= 65 && key <= 90) || (key >= 97 && key <= 122);
        if (isLetter && tag != 'input' && tag != 'textarea') {
          e.preventDefault();
          $("#menu-open").fadeOut();
          var searchInput = $("#search-anywhere input[type=search]").first();
          searchInput.val(searchInput.val() + String.fromCharCode(e.which));
          $("#search-anywhere:hidden").fadeIn(400, function(){
            searchInput.focus();
            searchInput[0].setSelectionRange(searchInput.val().length*2, searchInput.val().length*2);
          });
        }
      });
      $(document).keyup(function(e){
        if (e.keyCode == 27 && $("#search-anywhere:visible").length > 0)
        {
          $("#search-anywhere").fadeOut();
          $("#search-anywhere input[type=text]").val('');
          $("#menu-open").fadeIn();
          if ($(window).width() <= 750) {
            $("#mobile-home").fadeIn();
          }
        }
      });

      <?php /* Body Contact Form */ ?>
      if ($('body').hasClass('page-id-105')) {
        $("span.wpcf7-form-control-wrap.reason").append('<div id="reason-dropdown"><div class="value-select"><span class="value"></span><i class="fa fa-caret-down"></i><div class="value-options hidden"><ul></ul></div></div></div>');
        $("#reason-dropdown span.value").html($("select[name=reason] option:selected").val());
        if ($("#select[name=reason] option:selected").length == 0) {
          $("#reason-dropdown span.value").html("<span class='placeholder'>ask a question.</span>");
        }
        $("select[name=reason] option").each(function(index){
          $("#reason-dropdown ul").append('<li data-index="' + index + '">'+$(this).val()+'</li>');
        });
        $("select[name=reason]").hide();
        $("#reason-dropdown .value-select").click(function(event){
          if ($(event.target).hasClass('value-select') || $(event.target).parent().hasClass('value-select')) {
            var options = $(this).find('.value-options');
            if (options.is(':visible'))
              options.hide();
            else
              options.show();
          }
          if ($(event.target).data('index') !== undefined) {
            var index = $(event.target).data('index');
            var value = $("select[name=reason] option:eq(" + index + ")").prop('selected',true).val();
            $("#reason-dropdown .value-select > span").html(value);
            $("#reason-dropdown .value-options").hide();
          }
        });
      }

      <?php /* Filtering */ ?>
      $.cookie.json = true;
      <?php if (!is_home()): ?>
        ignoredCategories = $.cookie('ignoredCategories');
      <?php else: ?>
        $.cookie('ignoredCategories',[],{path:'/'});
      <?php endif; ?>
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
        if ($("body").hasClass('sidebar-closed')) {
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

        $.cookie('ignoredCategories',ignoredCategories,{path:'/'});
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
            $("#love-it .loader, #love-it .loader-blue").slideDown();
            $.post($("#tip-form").attr('action'), $("#tip-form").serialize(), function(data){
              $("#tip-form").html(data);
            }).done(function(){
              $("#love-it .loader, #love-it .loader-blue").slideUp();
            }).error(function(data){
              $("#love-it .loader, #love-it .loader-blue").slideUp();
              $("#tip-form").find('input, select, a').slideDown();
              $("#tip-form").append($("<p class='error'>Sorry, your card was declined - please try again</p>"));
            });
          }
        });
      }
      $("#tip-form #tip-button").click(function(event){
        event.preventDefault();
        stripeHandler.open({
          name: 'Random Nerds',
          description: '<?php global $stripeDescription; echo $stripeDescription; ?>',
          amount: $("#tip-form input[name=tip_value]").val(),
          panelLabel: 'Patronize {{amount}}'
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
            options.hide();
          else
            options.show();
        }
        if ($(event.target).data('value')) {
          var value = $(event.target).data('value');
          $("#tip-form input[name=tip_value]").val(value*100).trigger('change');
          $("#paypal-amount").val(value.toFixed(2));
          $("#tip-form .value-select > span").html(value);
          $("#tip-form .value-options").hide();
        }
      });
      $("#paypal-tip-button").click(function(e){
        e.preventDefault();
        $("#paypal-tip-form").submit();
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
          // Start confetti
          $("body").append('<div id="confetti" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:10;background-image:url(\'/wp-content/themes/random-nerds/images/confetti.gif\');display:none;"></div>"');
          $("#confetti").fadeIn(1000, function(){
            $("#confetti").fadeOut(1000, function(){$("#confetti").remove();});
          });
        }
      });

      <?php /* Authors Page Leveling */ ?>
      if ($(".authors-page a.author").length > 0) {
        var maxHeight = 0;
        $(".authors-page a.author").each(function(){
          if ($(this).height() > maxHeight)
            maxHeight = $(this).height();
        });
        $(".authors-page a.author").css({'min-height': maxHeight});
      }

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
          setTimeout(function(){tooltip.bind( 'click', remove_tooltip );}, 1000);
      });
    });
  </script>

  </body>
</html>
