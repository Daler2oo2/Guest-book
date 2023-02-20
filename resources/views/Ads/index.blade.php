@extends('layouts.app')
@section('title')
     
@endsection

@section('content')
    <style>
       .upload__box {
        padding: 40px;
        }
        .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        }
        .upload__btn {
        display: inline-block;
        font-weight: 600;
        color: #fff;
        text-align: center;
        width: 100%;
        padding: 5px;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;
        line-height: 26px;
        font-size: 14px;
        }
        .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
        }
        .upload__btn-box {
        margin-bottom: 10px;
        }
        .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
        }
        .upload__img-box {
        width: 200px;
        padding: 0 10px;
        margin-bottom: 12px;
        }
        .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
        }
        .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
        }
        
        .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
        }
    </style>
   
    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center mb-1">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                         <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить</button>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-head pt-2 ">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <div class="card-body p-4">

                            <div class="row ">

                                @forEach($adss as $ads )
                              
                                <div class="col-md-6 col-lg-4 col-xl-3 ">
                                    <div class=" m-1">
                                        @if($ads->images)
                                           <img src="storage/{{$ads->images[0]}}" alt="..." class="img-thumbnail">
                                        @else
                                        <img src="images/noImage.png" alt="Not Found!" class="img-thumbnail">
                                        @endif
                                        <h3>{{$ads->price}}</h3>
                                        <h5>{{$ads->title}}</h5>
                                    </div>
                                </div>
                                @endforeach
                               
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal for add --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить объявления</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('ads.store', [ $slug ])}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                    <div class="modal-body">
                    
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Имя:</label>
                            <input type="text" class="form-control" id="recipient-name" name="user" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Телефон:</label>
                            <input type="text" class="form-control" id="recipient-name" name="tel" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Объявления:</label>
                            <input type="text" class="form-control" id="recipient-name" name="title" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Сумма:</label>
                            <input type="text" class="form-control" id="recipient-name" name="price" >
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Город:</label>
                            <input type="text" class="form-control" id="recipient-name" name="city" >
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Описания:</label>
                            <textarea class="form-control" id="message-text" name="text" ></textarea >
                        </div>

                        <div class="upload__box">
                            <div class="upload__btn-box">
                                <label class="upload__btn">
                                    <p>Upload images</p>
                                    <input type="file"  multiple="multiple"  data-max_length="20" class="upload__inputfile" name="images[]">
                                </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </div>
                    </form>
                </div>
                </div>
            </div>
            {{-- End Model --}}




    </section>


@endsection

@section('script')
<script id="rendered-js" >
    jQuery(document).ready(function () {
      ImgUpload();
    });
    
    function ImgUpload() {
      var imgWrap = "";
      var imgArray = [];
    
      $('.upload__inputfile').each(function () {
        $(this).on('change', function (e) {
          imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
          var maxLength = $(this).attr('data-max_length');
    
          var files = e.target.files;
          var filesArr = Array.prototype.slice.call(files);
          var iterator = 0;
          filesArr.forEach(function (f, index) {
    
            if (!f.type.match('image.*')) {
              return;
            }
    
            if (imgArray.length > maxLength) {
              return false;
            } else {
              var len = 0;
              for (var i = 0; i < imgArray.length; i++) {if (window.CP.shouldStopExecution(0)) break;
                if (imgArray[i] !== undefined) {
                  len++;
                }
              }window.CP.exitedLoop(0);
              if (len > maxLength) {
                return false;
              } else {
                imgArray.push(f);
    
                var reader = new FileReader();
                reader.onload = function (e) {
                  var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                  imgWrap.append(html);
                  iterator++;
                };
                reader.readAsDataURL(f);
              }
            }
          });
        });
      });
    
      $('body').on('click', ".upload__img-close", function (e) {
        var file = $(this).parent().data("file");
        for (var i = 0; i < imgArray.length; i++) {if (window.CP.shouldStopExecution(1)) break;
          if (imgArray[i].name === file) {
            imgArray.splice(i, 1);
            break;
          }
        }window.CP.exitedLoop(1);
        $(this).parent().parent().remove();
      });
    }
    //# sourceURL=pen.js
        </script>
@endsection
