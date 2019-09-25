@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pay History
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