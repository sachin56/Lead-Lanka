@extends('layouts.admin.app')

@section('content')
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Book Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="hid" name="hid">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="rate">Book Category Name</label>
                            <input type="text" class="form-control" id="book_type" name="book_type" placeholder="Enter Category Name" required>
                        </div>
                    </div>
                </form>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success submit" id="submit">Save changes</button>
          </div>
      </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h1 class="m-0 text-dark">Book Category</h1>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Master</a></li>
              <li class="breadcrumb-item"><a href="#">Book</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary addNew"><i class="fa fa-plus"></i> Add New Book Category</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tbl_category">
                        <thead>
                            <tr>
                                <th style="width:20%">ID</th>
                                <th style="width:20%">Book Category Name</th>
                                <th style="width:20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function(){

    // menu active
    $(".Category_route").addClass('active');
    $(".Category_tree").addClass('active');
    $(".Category_tree_open").addClass('menu-open');
    $(".Category_tree_open").addClass('menu-is-opening');


    //csrf token error
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    show_Categorys();

    $(document).on("blur",".form-control",function(){
        $("#submit").css("display","block");
    });

    $(".addNew").click(function(){
        empty_form();
        $("#modal").modal('show');
        $(".modal-title").html('Save Category');
        $("#submit").html('Save Category');
        $("#submit").click(function(){
            $("#submit").css("display","none");
            var hid = $("#hid").val();
            //save Category
            if(hid == ""){
                var book_type =$("#book_type").val();

                $.ajax({
                'type': 'ajax',
                'dataType': 'json',
                'method': 'post',
                'data' : {book_type:book_type},
                'url' : 'book-category',
                'async': false,
                success:function(data){
                    if(data.validation_error){
                    validation_error(data.validation_error);//if has validation error call this function
                    }

                    if(data.db_error){
                    db_error(data.db_error);
                    }

                    if(data.db_success){
                    db_success(data.db_success);
                    setTimeout(function(){
                        $("#modal").modal('hide');
                        location.reload();
                    }, 2000);
                    }

                },
                error: function(jqXHR, exception) {
                    db_error(jqXHR.responseText);
                }
                });
            };
        });
    });

    $(document).on("click", ".edit", function(){

        var id = $(this).attr('data');

        empty_form();
        $("#hid").val(id);
        $("#modal").modal('show');
        $(".modal-title").html('Edit Category');
        $("#submit").html('Update Category');

        $.ajax({
            'type': 'ajax',
            'dataType': 'json',
            'method': 'get',
            'url': 'book-category/'+id,
            'async': false,
            success: function(data){

                $("#hid").val(data.id);
                $("#book_type").val(data.book_type);
            }

        });

        $("#submit").click(function(){

            if($("#hid").val() != ""){

                var id = $("#hid").val();
                var book_type = $("#book_type").val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {

                            $.ajax({
                                'type': 'ajax',
                                'dataType': 'json',
                                'method': 'put',
                                'data' : {book_type:book_type},
                                'url': 'book-category/'+id,
                                'async': false,
                                success:function(data){
                                if(data.validation_error){
                                    validation_error(data.validation_error);//if has validation error call this function
                                    }

                                    if(data.db_error){
                                    db_error(data.db_error);
                                    }

                                    if(data.db_success){
                                        toastr.success(data.db_success);
                                    setTimeout(function(){
                                        $("#modal").modal('hide');
                                        location.reload();
                                    }, 1000);
                                    }
                                },
                            });
                        }
                });
            }
        });
    });

    $(document).on("click", ".delete", function(){
        var id = $(this).attr('data');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'type': 'ajax',
                        'dataType': 'json',
                        'method': 'delete',
                        'url': 'book-category/'+id,
                        'async': false,
                        success: function(data){

                        if(data){
                            toastr.success('Delete Book Category');
                            setTimeout(function(){
                            location.reload();
                            }, 1000);

                        }

                        }
                    });

                }

        });

    });
});

//Data Table show
function show_Categorys(){
        $('#tbl_category').DataTable().clear();
        $('#tbl_category').DataTable().destroy();

        $("#tbl_category").DataTable({
            'processing': true,
            'serverSide': true,
            "bLengthChange": false,
            'ajax': {
                        'method': 'get',
                        'url': 'book-category/create'
            },
            'columns': [
                {data: 'id'},
                {data: 'book_type'},
                {
                data: null,
                render: function(d){
                    var html = "";
                    
                    html+="<td><button class='btn btn-warning btn-sm edit' data='"+d.id+"' title='Edit'><i class='fas fa-edit'></i></button>";
                    html+="&nbsp;<button class='btn btn-danger btn-sm delete' data='"+d.id+"' title='Delete'><i class='fas fa-trash'></i></button>";
                    return html;

                }

                }
            ]
        });
}

function empty_form(){
    $("#hid").val("");
    $("#name").val("");
    $("#code").val("");
}

function validation_error(error){
    for(var i=0;i< error.length;i++){
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: error[i],
        });
    }
}

function db_error(error){
    Swal.fire({
        icon: 'error',
        title: 'Database Error',
        text: error,
    });
}

function db_success(message){
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: message,
    });
}
</script>
@endsection