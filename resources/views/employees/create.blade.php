@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Employee Management
            <small>Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Add Employee</h3>
                    </div>
                    
                    <div class="box-body">
                        <form action="{{ route('employees.store') }}" method="post" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" name="firstname">
                                        @error('firstname')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" name="lastname">
                                        @error('lastname')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" name="dob">
                                        </div>
                                        @error('dob')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Contact Number" name="contact_number">
                                        </div>
                                        @error('contact_number')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                        </div>
                                        @error('email')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label>Picture</label>
                                    <div class="form-group" id="image-container">
                                        <img src="" alt="">
                                    </div>
                                    <div>
                                        <input type="file" name="image" id="input-image" accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            
                            <div>
                                <span class="pull-right">
                                    <a href="{{ url('/employees') }}" class="btn btn-default btn-sm">Cancel</a>
                                    <input type="submit" value="Save" class="btn btn-success btn-sm">
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $('#datepicker').datepicker({
        autoclose: true,
        // format: 'yyyy-dd-mm'
    });

    $("#input-image").change(function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $("#image-container");
            dvPreview.html("");            
            $($(this)[0].files).each(function () {
                var file = $(this);                
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<img />");
                        img.attr("style", "width: 202px; height:202px;");
                        img.attr("src", e.target.result);
                        dvPreview.append(img);
                    }
                    reader.readAsDataURL(file[0]);                
            });
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    });
</script>
@endsection