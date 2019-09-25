@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Add Payment
            <small>Employee</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Employee</h3>
                    </div>
                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" value="{{ $employee->firstname }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" value="{{ $employee->lastname }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" class="form-control" value="{{ date('m/d/Y', strtotime($employee->dob)) }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" value="{{ $employee->contact_number }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" value="{{ $employee->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Balance</label>
                                            <input type="text" class="form-control" value="{{ 'Php ' . number_format((float)$employee->balance, 2,'.',',') }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group profile-image">
                                    <label>Picture</label>
                                    <img src="{{ asset('/images/' . $employee->image) }}" alt="">
                                </div>
                            </div>
                        </div>

                        <br>

                        <hr>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 col-md-offset-4">
                                    <form action="{{ route('addpayment') }}" method="post" role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                        @if(Session::has('payment-message'))
                                            <p class="alert alert-warning text-center">{{ Session::get('payment-message') }}</p>
                                        @endif
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount (max: Php 100,000.00)" onkeypress="return isNumberKey(event)">
                                            <span class="input-group-btn">
                                                <input type="submit" class="btn btn-info btn-flat" value="Add Payment">
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="box box-success">
                            <div class="box-header">
                                <h3 class="box-title">Pay History</h3>
                            </div>
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <th style="width:10%">#</th>
                                            <th class="text-right" style="width:45%">Amount (Php)</th>
                                            <th class="text-center" style="width:45%">Date</th>
                                        </tr>
                                        @foreach($pay_history as $index => $history)
                                            <tr>
                                                <td>{{ $index + $pay_history->firstItem() }}</td>
                                                <td class="text-right">{{ number_format((float)$history->amount, 2,'.',',') }}</td>
                                                <td class="text-center">{{ date('m/d/Y H:i', strtotime($history->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ url('/employees') }}" class="btn btn-default btn-sm">Return</a>
                            </div>
                            <div class="col-md-4 text-center">
                                Total Record: {{ $pay_history->total() }}
                            </div>
                            <div class="col-md-4 text-right pay-history-pagination">
                                {{ $pay_history->links() }}
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
@endsection