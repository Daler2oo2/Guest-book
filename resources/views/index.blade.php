@extends('layouts.app')
@section('title')
    Somon.tj
@endsection

@section('content')
    <style>
            .wrapper {
        padding: 15px;
        position: relative;
        overflow-x: hidden;
        max-width: 1100px;
        background: #fff;
        border-radius: 13px;

      }
      .wrapper .icon {
        position: absolute;
        top: 0;
        height: 100%;
        width: 120px;
        display: flex;
        align-items: center;
      }
      .icon:first-child {
        left: 0;
        display: none;
        background: linear-gradient(90deg, #fff 70%, transparent);
      }
      .icon:last-child {
        right: 0;
        justify-content: flex-end;
        background: linear-gradient(-90deg, #fff 70%, transparent);
      }
      .icon i {
        width: 55px;
        height: 55px;
        cursor: pointer;
        font-size: 1.2rem;
        text-align: center;
        line-height: 55px;
        border-radius: 50%;
      }
      .icon i:hover {
        background: #efedfb;
      }
      .icon:first-child i {
        margin-left: 15px;
      } 
      .icon:last-child i {
        margin-right: 15px;
      } 
      .wrapper .tabs-box {
        display: flex;
        margin-top: 20px;
        gap: 12px;
        list-style: none;
        overflow-x: hidden;
        scroll-behavior: smooth;
      }
      .tabs-box.dragging {
        scroll-behavior: auto;
        cursor: grab;
      }
      .tabs-box .tab {
        cursor: pointer;
        font-size: 1rem;
        white-space: nowrap;
        background: #f5f4fd;
        padding: 10px 15px;
        border-radius: 30px;
        border: 1px solid #d8d5f2;
      }
      .tabs-box .tab:hover{
        background: #efedfb;
      }
      .tabs-box.dragging .tab {
        user-select: none;
        pointer-events: none;
      }
      .tabs-box .tab.active{
        color: #fff;
        background: #5372F0;
        border-color: transparent;
      }
    </style>
    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center mb-1">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        
                            <div class="wrapper">
                                <div class="icon"><i id="left" class="bi bi-chevron-left"></i></div>
                                <ul class="tabs-box">
                                  @foreach ( $categories as $category )
                                  <li class="tab"><a style="text-decoration: none;" href="{{ route('ads.index', [$category->slug])}}"><i class="{{ $category->icon }}" ></i> {{ $category->name }}</a></li>
                                  @endforeach
                                  <li class="tab"><a style="text-decoration: none;" href="{{ route('index')}}"><i class="fa-solid fa-plus"></i></a></li>
                                </ul>
                                <div class="icon"><i id="right" class="bi bi-chevron-right "></i></div>
                              </div>        
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

    </section>


@endsection

@section('script')
<script>
    const tabsBox = document.querySelector(".tabs-box"),
    allTabs = tabsBox.querySelectorAll(".tab"),
    arrowIcons = document.querySelectorAll(".icon i");

    let isDragging = false;

    const handleIcons = (scrollVal) => {
        let maxScrollableWidth = tabsBox.scrollWidth - tabsBox.clientWidth;
        arrowIcons[0].parentElement.style.display = scrollVal <= 0 ? "none" : "flex";
        arrowIcons[1].parentElement.style.display = maxScrollableWidth - scrollVal <= 1 ? "none" : "flex";
    }

    arrowIcons.forEach(icon => {
        icon.addEventListener("click", () => {
            // if clicked icon is left, reduce 350 from tabsBox scrollLeft else add
            let scrollWidth = tabsBox.scrollLeft += icon.id === "left" ? -340 : 340;
            handleIcons(scrollWidth);
        });
    });

    allTabs.forEach(tab => {
        tab.addEventListener("click", () => {
            tabsBox.querySelector(".active").classList.remove("active");
            tab.classList.add("active");
        });
    });

    const dragging = (e) => {
        if(!isDragging) return;
        tabsBox.classList.add("dragging");
        tabsBox.scrollLeft -= e.movementX;
        handleIcons(tabsBox.scrollLeft)
    }

    const dragStop = () => {
        isDragging = false;
        tabsBox.classList.remove("dragging");
    }

    tabsBox.addEventListener("mousedown", () => isDragging = true);
    tabsBox.addEventListener("mousemove", dragging);
    document.addEventListener("mouseup", dragStop);

</script>
@endsection
