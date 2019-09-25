@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Employee Management
            <small>Control panel</small>
        </h1>
        <span class="breadcrumb">
            <a href="{{ url('/employees/create') }}" class="btn btn-success btn-sm">Add New Employee</a>
        </span>
    </section>

            @if(Session::has('msg'))
                <div class="col-md-12">
                    <br>
                    <div class="text-center">
                        <p class="alert alert-warning text-center">{{ Session::get('msg') }}</p>
                    </div>
                </div>
            @endif

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- <div class="box-header">
                        <h3 class="box-title">Employees</h3>
                    </div> -->
                    
                    <div class="box-body">
                        <div class="table-responsive" id="laravel_datatables_container">			  
                            <table id="datatable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Date of Birth</th>
                                        <th>Picture</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Balance</th>
                                        <th class="text-center" style="width:20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->firstname }}</td>
                                            <td>{{ $employee->lastname }}</td>
                                            <td>{{ date('m/d/Y', strtotime($employee->dob)) }}</td>
                                            <td class="text-center table-profile-image">
                                                @if($employee->image)
                                                    <img src="{{ asset('images/' . $employee->image) }}" alt="">
                                                @else
                                                    <img src="{{ asset('images/employee.jpeg') }}" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $employee->contact_number }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td class="text-right">{{ number_format($employee->balance, 2,'.',',') }}</td>
                                            <td>
                                                
                                                <a href="{{ url('/employees/' . $employee->id . '/edit') }}">
                                                    <button class="btn btn-default btn-sm">
                                                        Edit
                                                    </button>
                                                </a>

                                                <!-- <a href="{{ url('/employees/' . $employee->id) }}"> -->
                                                    <button class="btn btn-default btn-sm deleteEmployee" data-toggle="modal" data-target="#DeleteModal" data-id="{{ $employee->id }}" data-url="{{ route('employees.destroy', $employee->id) }}">
                                                        Delete
                                                    </button>
                                                <!-- </a> -->
                                                
                                                <a href="{{ url('/employees/' . $employee->id . '/add-pay') }}">
                                                    <button class="btn btn-default btn-sm">
                                                        Add Pay
                                                    </button>
                                                </a>

                                                <a href="{{ url('/employees/' . $employee->id . '/pay-history/') }}">
                                                    <button class="btn btn-primary btn-sm">
                                                        View Pay History
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Date of Birth</th>
                                        <th>Picture</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="employeeDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:25%;">
            <div class="modal-content">
                <form action="" method="POST" class="remove-record-model">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title text-center" id="custom-width-modalLabel">
                            <i class="fa fa-warning"></i> &nbsp;Delete Employee Record
                        </h4>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Are you sure you want to delete this record?</h4>
                        <h5>All payment history will also be deleted.</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger waves-effect remove-data-from-delete-form">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        $('#datatable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            'stateSave'   : true,
            // "pageLength"  : 15
        })
    });


    $(document).on('click','.deleteEmployee',function(){
        var id = $(this).attr('data-id');
		var url = $(this).attr('data-url');
		$(".remove-record-model").attr("action",url);
        $('#employeeDeleteModal').modal('show'); 
    });
    
</script>
@endsection