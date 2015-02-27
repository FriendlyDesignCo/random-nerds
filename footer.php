  </section>

  <?php wp_footer(); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script type="text/javascript">
    $(function(){
      $("#collapse-sidebar").click(function(){
        $(this).toggleClass('closed');
        $("#content").toggleClass('sidebar-hidden');
        $("#content").toggleClass('sidebar-visible');
      });
    });
  </script>

  </body>
</html>
