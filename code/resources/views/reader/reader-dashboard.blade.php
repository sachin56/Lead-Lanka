@extends('layouts.reader.app')
<style>
    .container {
  margin: 0 auto;
  max-width: 910px;
}

.choose {
  width: 100%;
  height: 40px;
}
.fa {
  margin-right: 20px;
  font-size: 30px;
  color: gray;
  float: right;
}
/******************************************
Book stuff
*******************************************/

.book {
  display: inline-block;
  width: 230px;
  height: 390px;
  box-shadow: 0 0 20px #aaa;
  margin: 25px;
  padding: 10px 10px 0 10px;
  vertical-align: top;
  transition: height 1s;
}
/* star button */
.book:after {
  font-family: FontAwesome;
  content: "\f006";
  font-size: 35px;
  position: relative;
  left: -.1cm;
  top: -1.6cm;
  float: right;
}

.cover {
  border: 2px solid gray;
  height: 80%;
  overflow: hidden;
}

.cover img {
  width: 100%;
}

.book p {
  margin-top: 12px;
  font-size: 20px;
}

.book .author {
  font-size: 15px;
}
@media (max-width: 941px) {
  .container {
    max-width: 700px;
  }
  .book {
    margin: 49px;
  }
}
@media (max-width: 730px) {
  .book {
    display: block;
    margin: 0 auto;
    margin-top: 50px;
  }
  .cover {
    
  }
}

/*********************************
other
**********************************/

h1 {
  color: gray;
  text-align: center;
  font-size: 50px;
  margin-bottom: -3px;
}

/**********************************
display change
***********************************/
/*book height smaller, cover opacity, move text onto cover and star too
animate it */
#list-th:target .book {
  height: 100px;
  width: 250px;
  padding: 10px;
  margin: 25px auto 25px auto;
}

#list-th:target .cover {
  width: 246px;
}

#list-th:target img {
  opacity: .1;
}

#list-th:target p {
  margin-top: -62px;
  margin-left: 20px;
}
/* remove button? */
#large-th:target .book {
  height: 390px;
}

/***********************************
star animation
***********************************/
/***********************************
zoom on click
***********************************/
</style>
@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">Dashboard</h1>
        <br><br>

            <div id="large-th">
                <div class="container">
                  <h1> All list of borrow books</h1>
                  <br>
                  <div class="choose">
                    <a href="#list-th"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                    <a href="#large-th"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                  </div>
                  <div id="list-th">
                    @foreach($result as $book)
                        <div class="book read">
                            <div class="cover">
                                <img src="https://s-media-cache-ak0.pinimg.com/564x/f9/8e/2d/f98e2d661445620266c0855d418aab71.jpg">
                            </div>
                            <div class="description">
                                <p class="title">{{$book->bookname}}<br>
                                <span class="author">{{$book->auther_name}}</span></p>
                            </div>
                        </div>
                    @endforeach
              
                  </div>
                </div>
              </div>


    <script>
        $(document).ready(function(){

            // menu active
            $(".dashboard_route").addClass('active');

        });
    </script>
@endsection
