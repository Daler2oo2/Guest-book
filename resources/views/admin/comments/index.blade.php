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
            <div class="row">
              <div class="col">
                <h3 class="text-start text-success mb-4 pb-2"> Комментария -{{$data->count()}} </h3>
                @foreach($data as $comment)
                  <div class="d-flex flex-start border-bottom mt-3 " >
                    <img class="rounded-circle shadow-1-strong me-3"
                      src="../images/user.png" alt="avatar" width="65"
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
                          <p class="mb-0">Нравиться</p>
                        </a>
                        <a href="#!" class="d-flex align-items-center me-3">
                            <i class="bi bi-pencil-square me-2"></i>
                            <p class="mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalUpdate{{$comment->id}}">Изменить</p>
                          </a>
                          <a href="#!" class="d-flex align-items-center me-3 ">
                            <i class="bi bi-trash3 me-2"></i>
                            <p class="mb-0"  data-bs-toggle="modal" data-bs-target="#exampleModalDelete{{$comment->id}}">Удалить</p>
                          </a>
                      </div>
                      @foreach($comment->answers as $answer)
                        <div class="d-flex flex-start mt-4">
                          <a class="me-3" href="#">
                            <img class="rounded-circle shadow-1-strong"
                              src="../images/user.png" alt="avatar"
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
                                  <p class="mb-0">Нравиться</p>
                                </a>
                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="bi bi-pencil-square me-2"></i>
                                    <p class="mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalUpdateAnswer{{$answer->id}}">Изменить</p>
                                  </a>
                                  <a href="#!" class="d-flex align-items-center me-3 ">
                                    <i class="bi bi-trash3 me-2"></i>
                                    <p class="mb-0" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteAnswer{{$answer->id}}">Удалить</p>
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>

                         {{-- Modal  для изменить текушие ответь --}}
                            <div class="modal fade" id="exampleModalUpdateAnswer{{$answer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Изменить ответь</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="{{ route('admin.answers.update',  [$answer->id]) }}" method="POST">
                                      @csrf
                                    <div class="modal-body">
                                    
                                        <div class="mb-3">
                                          <label for="recipient-name" class="col-form-label">Имя:</label>
                                          <input type="text" class="form-control" id="recipient-name" name="name" value="{{$answer->name}} " disabled>
                                        </div>
                                        <div class="mb-3">
                                          <label for="message-text" class="col-form-label">Комментария:</label>
                                          <textarea class="form-control" id="message-text" name="text">{{ $answer->text }}</textarea >
                                        </div>
                                      
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                      <input type="submit" class="btn btn-primary" value="Изменить">
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          {{-- End Modal --}}
                          <!-- Modal для удаления текушие ответь -->
                            <div class="modal fade" id="exampleModalDeleteAnswer{{$answer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Подтвердите удаления ответь</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    Удалить  {{$answer->text}}
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <a class="btn btn-danger" href="{{ route('admin.answers.destroy',  [$answer->id]) }}">Удалить</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                   {{-- End Modal --}}
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
                  {{-- Modal  для изменить текушие коменария --}}
                  <div class="modal fade" id="exampleModalUpdate{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Изменить</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.comments.update',  [$comment->id]) }}" method="POST">
                            @csrf
                          <div class="modal-body">
                          
                              <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Имя:</label>
                                <input type="text" class="form-control" id="recipient-name" name="name" value="{{$comment->name}} " disabled>
                              </div>
                              <div class="mb-3">
                                <label for="message-text" class="col-form-label">Комментария:</label>
                                <textarea class="form-control" id="message-text" name="text">{{ $comment->text }}</textarea >
                              </div>
                            
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                            <input type="submit" class="btn btn-primary" value="Изменить">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                {{-- End Modal --}}
                <!-- Modal для удаления текушие коменария -->
                  <div class="modal fade" id="exampleModalDelete{{$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Подтвердите удаления</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Удалить  {{$comment->text}}
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                          <a class="btn btn-danger" href="{{ route('admin.comments.destroy',  [$comment->id]) }}">Удалить</a>
                        </div>
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


</section>

       
@endsection
