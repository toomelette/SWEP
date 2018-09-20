<?php

  $appended_requests = [
                        'q'=> Request::get('q'), 
                        'fs' => Request::get('fs'), 
                        'pi' => Request::get('pi'),
                        'dn' => Request::get('dn'),
                        'dun' => Request::get('dun'),
                        'ac' => Request::get('ac'),
                        'df' => Request::get('df'),
                        'dt' => Request::get('dt'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                      ];

  $span_not_set = '<span class="text-red"><b>Not Set!</b></span>';
  
?>




@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>My Vouchers</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.user_index') }}">


    {!! __html::filter_open() !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'fs', 'Fund Source', old('fs'), $global_fund_source_all, 'fund_source_id', 'description', 'submit_dv_filter', '', ''
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '3', 'pi', 'Station', old('pi'), $global_projects_all, 'project_id', 'project_address', 'submit_dv_filter', '', ''
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'dn', 'Department', old('dn'), $global_departments_all, 'name', 'name', 'submit_dv_filter', '', ''
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'dun', 'Unit', old('dun'), $global_department_units_all, 'name', 'name', 'submit_dv_filter', '', ''
      ) !!}

      {!! __form::select_dynamic_for_filter(
        '2', 'pc', 'Project Code', old('pc'), $global_project_codes_all, 'project_code', 'project_code', 'submit_dv_filter', '', ''
      ) !!}

      <div class="col-md-12 no-padding">
        
        <h5>Date Filter : </h5>

        {!! __form::datepicker('3', 'df',  'From', old('df'), '', '') !!}

        {!! __form::datepicker('3', 'dt',  'To', old('dt'), '', '') !!}

        <button type="submit" class="btn btn-primary" style="margin:25px;">Filter Date <i class="fa fa-fw fa-arrow-circle-right"></i></button>

      </div>

    {!! __html::filter_close('submit_dv_filter') !!}


    <div class="box" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.disbursement_voucher.user_index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('payee', 'Payee')</th>
            <th>Explanation</th>
            <th>@sortablelink('date', 'Date')</th>
            <th>Status</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($disbursement_vouchers as $data) 
            <tr>
              <td>{{ $data->payee }}</td>
              <td>{!! Str::limit($data->explanation, 120)  !!}</td>
              <td>{{ __dataType::date_parse($data->date, 'M d, Y') }}</td>
              <td>
                @if($data->processed_at == null && $data->checked_at == null)
                  <span class="label label-warning">Filed..</span>
                @elseif($data->processed_at != null && $data->checked_at == null)
                  <span class="label label-primary">Processing..</span>
                @elseif($data->processed_at != null && $data->checked_at != null)
                  <span class="label label-success">Completed!</span>
                @endif
              </td>
              <td> 
                <select id="action" class="form-control input-md">
                  <option value="">Select</option>
                  <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.show', $data->slug) }}">Details</option>
                  @if(Carbon::parse($data->date)->diffInDays(Carbon::now()->format('Y-m-d')) < 5)
                    <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.edit', $data->slug) }}">Edit</option>
                  @endif
                  <option data-type="1" data-url="{{ route('dashboard.disbursement_voucher.save_as', $data->slug) }}">Save as New</option>
                </select>
              </td>
            </tr>
            @endforeach
        </table>
      </div>

      @if($disbursement_vouchers->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($disbursement_vouchers) !!}
        {!! $disbursement_vouchers->appends($appended_requests)->render('vendor.pagination.bootstrap-4') !!}
      </div>

    </div>

  </section>

@endsection

