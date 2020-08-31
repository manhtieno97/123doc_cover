<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  @if (Session::has('success'))
                    <p class="alert alert-success">{{Session::get('success')}}</p>
                    @endif
                    @if (Session::has('error'))
                    <p class="alert alert-danger">{{Session::get('error')}}</p>
                    @endif
                  <div class="card">
                      <div class="card-header">
                          Imagick
                      </div>
                      <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/image" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="">List ảnh</label>
                                        </div>
                                        <input required  id="img" type="file" class=" d-none" name="images[]"  multiple onchange="changeImg(this)">
                                        <img id="avatar" class="img-thumbnail" width="200px" src="{{url('img')}}/no-ig.png">
                                        <div class="row" id="list-img">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Ghép</button>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Đường dẫn</th>
                                                <th>Tên ảnh</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($items))
                                                @foreach($items as $key => $value)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $value['url'] }}</td>
                                                    <td><a href="{{ route('detailImage',['id'=>$value->id]) }}">{{ $value['image_cover'] }}</a></td>
                                                </tr>
                                                
                                                @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                    <div class="text-center">
                                        {!! $items->links() !!}
                                    </div>
                                </div>
                            </div>
                      </div>
                      
                  </div>
                    
              </div>
          </div>
          
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#avatar').click(function(){
            $('#img').click();
        });
    });
    function changeImg(input){
        //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
        if(input.files ){
            var fileList = input.files;
            for (let i = 0, numFiles = fileList.length; i < numFiles; i++) {
                const file = fileList[i];
                var reader = new FileReader();
                var img_1 = '';
                //Sự kiện file đã được load vào website
                reader.onload = function(e){
                    //Thay đổi đường dẫn ảnh
                    //$('#avatar').attr('src',e.target.result);
                    img_1 += '<div class="col-md-3"><a class="thumbnail multi-select"><img width="100%" src="'+e.target.result+'" alt=""></a></div>';
                    $('#list-img').html(img_1);
                }
                reader.readAsDataURL(file);
            // ...
            }

            
        }
    }
    
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>