@extends('layouts.app')
@section('title')
    Posts
@endsection

@section('content')
       
<section class="gradient-custom">
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card">
          <div class="card-head pt-2 " >
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
          <div class="card-head p-4">
            <h3 class="text-center text-warning mb-4 pb-2"> Заказ комната </h3>
            <img class="rounded shadow-1-strong me-3"
                src="images/img.jpg" alt="avatar" width="100%"
                height="200" />
                      <p class="small mb-0">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quo aliquam consequatur explicabo placeat mollitia neque enim laboriosam at libero autem consequuntur sed, deleniti voluptates voluptate ab atque? Cumque, amet perspiciatis.
                      </p>
                      <div class="small d-flex justify-content-start mb-3">
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="bi bi-hand-thumbs-up me-2"></i>
                          <p class="mb-0">Like</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="bi bi-chat-dots me-2"></i>
                          <p class="mb-0" data-bs-toggle="modal" data-bs-target="#exampleModal">Comment</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="bi bi-share-fill me-2"></i>
                          <p class="mb-0">Share</p>
                        </a>
                      </div>
            <div class="row">
              <div class="col">
                <h3 class="text-start text-success mb-4 pb-2"> Комментария -{{$data->count()}} </h3>
                @foreach($data as $comment)
                  <div class="d-flex flex-start border-bottom mt-3 " >
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="images/user.png" alt="avatar" width="65"
                      height="65" />
                    <div class="flex-grow-1 flex-shrink-1">
                      <div>
                        <div class="d-flex justify-content-between align-items-center">
                          <p class="mb-1">{{$comment->name}} <span class="small">- {{$comment->created_at->diffForHumans()}}</span></p>
                          <a href="#!"><i class="bi bi-reply-fill fa-xs"></i><span class="small" data-bs-toggle="modal" data-bs-target="#exampleModal{{$comment->id}}"> Ответить</span></a>
                        </div>
                        <p class="small mb-0">
                          {{ $comment->text }}
                        </p>
                      </div>
                      <div class="small d-flex justify-content-start">
                        <a href="#!" class="d-flex align-items-center me-3">
                          <i class="bi bi-hand-thumbs-up me-2"></i>
                          <p class="mb-0">Like</p>
                        </a>
                      </div>
                      @foreach($comment->answers as $answer)
                        <div class="d-flex flex-start mt-4">
                          <a class="me-3" href="#">
                            <img class="rounded-circle shadow-1-strong"
                              src="images/user.png" alt="avatar"
                              width="65" height="65" />
                          </a>
                          <div class="flex-grow-1 flex-shrink-1">
                            <div>
                              <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1">{{ $answer->name }} <span class="small">- {{$answer->created_at->diffForHumans()}}</span></p>
                              </div>
                              <p class="small mb-0">
                               {{ $answer->text }}
                              </p>
                              <div class="small d-flex justify-content-start">
                                <a href="#!" class="d-flex align-items-center me-3">
                                  <i class="bi bi-hand-thumbs-up me-2"></i>
                                  <p class="mb-0">Like</p>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforeach

                    </div>
                  </div>
                    {{-- Modal  для ответить текушие коменария --}}
                    <div class="modal fade" id="exampleModal{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ответить {{ $comment->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="{{ route('answers.store',  [$comment->id]) }}" method="POST">
                              @csrf
                            <div class="modal-body">
                            
                                <div class="mb-3">
                                  <label for="recipient-name" class="col-form-label">Имя:</label>
                                  <input type="text" class="form-control" id="recipient-name" name="name" >
                                </div>
                                <div class="mb-3">
                                  <label for="message-text" class="col-form-label">Комментария:</label>
                                  <textarea class="form-control" id="message-text" name="text"></textarea >
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
                  {{-- End Modal --}}
                @endforeach

             
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

{{-- Modal for add new comment --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавить комментария</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('comments.store')}}" method="POST" >
          @csrf
        <div class="modal-body">
        
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Имя:</label>
              <input type="text" class="form-control" id="recipient-name" name="name" >
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Комментария:</label>
              <textarea class="form-control" id="message-text" name="text"></textarea >
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
</section>

       
@endsection
