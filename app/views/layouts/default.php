<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $this->meta['title'] ?? 'Lorem' ?></title>

    <meta name="description" content="<?= $this->meta['description'] ?? 'Lorem' ?>">

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">Company name</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/bill/index">Bills</a>
      </nav>
    </div>

    <div class="container">

        <?php if(isset($_SESSION['success'])) : ?>
          <div class="alert alert-success" role="alert">
              <?= $_SESSION['success']; ?>
              <?php unset($_SESSION['success']); ?>
          </div>
        <?php endif ?>
        
      <div class="row">

        <?= $content ?>

      </div>
      
    <?php if (isset($pagination) && isset($orderBy)) : ?>
      <nav aria-label="Pagination">
        <ul class="pagination mt-3 mb-0">
        <?php
          if ( $pagination['page'] <= 1 ) :
            echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
          else :
            $j = $pagination['page'] - 1;
            echo '<li class="page-item"><a class="page-link" href="?page=' . $j . '&orderby=' . $orderBy . '">Previous</a></li>';
          endif;
      
          for( $i = 1; $i <= $pagination['total_pages']; $i++ ) :
            if( $i <> $pagination['page'] ) :
              echo '<li class="page-item"><a class="page-link" href="?page='. $i . '&orderby=' . $orderBy . '">' . $i . '</a></li>';
            else :
              echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
            endif;
          endfor;
      
          if ( $pagination['page'] == $pagination['total_pages'] ) :
            echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
          else :
            $j = $pagination['page'] + 1;
            echo '<li class="page-item"><a class="page-link" href="?page=' . $j . '&orderby=' . $orderBy . '">Next</a></li>';
          endif;
        ?>
        </ul>
      </nav>
    <?php endif; ?>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <img class="mb-2" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
            <small class="d-block mb-3 text-muted">&copy; 2020</small>
          </div>
          
        </div>
      </footer>
    </div>

    <script src="/assets/js/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>

      $("#get-sum").click(function(e) {
        e.preventDefault();
        let href = $(this).attr('href');

        $.ajax({
          url: href,
          dataType: 'JSON',
          success: function(res) {
            $("#sum").text(res.sum)
          },
          error: function(xhr) {
            console.log(xhr);
          },
          beforeSend: function() { 
            $('.spinner-border').show(); 
          },
          beforeSend: function() { 
            $('.spinner-border').hide(); 
          }
        });
      });

    </script>

  </body>
</html>
