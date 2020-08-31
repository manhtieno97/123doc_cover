<!doctype html>
<html lang="en">
  <head>
    <title>Detail</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
      <div class="container">
          <div class="row">
                <div class="">
                    <div class=" col-md-12">
                        <img class="img-thumbnail" width="250" height="250" src="{{ asset("images/small/$image->image_cover.jpg") }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Size:small</h4>
                            <p class="card-text">{{ $image->image_cover }}</p>
                        </div>
                    </div>
                    <div class=" col-md-12">
                        <img class="img-thumbnail" width="500" height="500" src="{{ asset("images/medium/$image->image_cover.jpg") }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Size:medium</h4>
                            <p class="card-text">{{ $image->image_cover }}</p>
                        </div>
                    </div>
                    
                    <div class=" col-md-12">
                        <img class="img-thumbnail" width="720" height="720" src="{{ asset("images/lagger/$image->image_cover.jpg") }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">Size:lagger</h4>
                            <p class="card-text">{{ $image->image_cover }}</p>
                        </div>
                    </div>
                    
                </div>
          </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>