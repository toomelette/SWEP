@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Save as New Voucher</h1>
    <div class="pull-right" style="margin-top: -25px;">
      {!! __html::back_button(['dashboard.disbursement_voucher.user_index']) !!}
    </div>
</section>

<section class="content">

    <div class="box">
        
      <div class="box-header with-border">
        <h3 class="box-title">Form</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.disbursement_voucher.store') }}">

        <div class="box-body">
     
          @csrf    
          
          {!! __form::select_dynamic(
            '4', 'project_id', 'Station', old('project_id') ? old('project_id') : $disbursement_voucher->project_id, $global_projects_all, 'project_id', 'project_address', $errors->has('project_id'), $errors->first('project_id'), '', ''
          ) !!}

          {!! __form::select_dynamic(
            '4', 'fund_source_id', 'Fund Source', old('fund_source_id') ? old('fund_source_id') : $disbursement_voucher->fund_source_id, $global_fund_source_all, 'fund_source_id', 'description', $errors->has('fund_source_id'), $errors->first('fund_source_id'), '', ''
          ) !!}

          {!! __form::select_static(
            '4', 'mode_of_payment', 'Mode Of Payment', old('mode_of_payment') ? old('mode_of_payment') : $disbursement_voucher->mode_of_payment, __static::dv_mode_of_payment(), $errors->has('mode_of_payment'), $errors->first('mode_of_payment'), '', ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::textbox(
            '6', 'payee', 'text', 'Payee *', 'Payee', old('payee') ? old('payee') : $disbursement_voucher->payee, $errors->has('payee'), $errors->first('payee'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::textbox(
            '3', 'tin', 'text', 'TIN/Employee No', 'TIN / Employee No', old('tin') ? old('tin') : $disbursement_voucher->tin, $errors->has('tin'), $errors->first('tin'), ''
          ) !!}

          {!! __form::textbox(
            '3', 'bur_no', 'text', 'BUR No', 'BUR No', old('bur_no') ? old('bur_no') : $disbursement_voucher->bur_no, $errors->has('bur_no'), $errors->first('bur_no'), ''
          ) !!}

          <div class="col-md-12"></div>

          {!! __form::textbox(
            '6', 'address', 'text', 'Address', 'Address', old('address') ? old('address') : $disbursement_voucher->address, $errors->has('address'), $errors->first('address'), 'data-transform="uppercase"'
          ) !!}

          {!! __form::select_dynamic(
            '2', 'department_name', 'Department', old('department_name') ? old('department_name') : $disbursement_voucher->department_name, $global_departments_all, 'name', 'name', $errors->has('department_name'), $errors->first('department_name'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '2', 'department_unit_name', 'Unit', old('department_unit_name') ? old('department_unit_name') : $disbursement_voucher->department_unit_name, $global_department_units_all, 'name', 'name', $errors->has('department_unit_name'), $errors->first('department_unit_name'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '2', 'project_code', 'Project Code', old('project_code') ? old('project_code') : $disbursement_voucher->project_code, $global_project_codes_all, 'project_code', 'project_code', $errors->has('project_code'), $errors->first('project_code'), 'select2', ''
          ) !!}

          <div class="col-md-12">
            <div class="alert alert-warning">
              Note: Please put your computations in the <strong>Explanation Field</strong>, and the Total/Net of your computation in the <strong>Amount Field.</strong>
            </div>
          </div>

          {!! __form::textarea(
            '10', 'explanation', 'Explanation *', old('explanation') ? old('explanation') : $disbursement_voucher->explanation, $errors->has('explanation'), $errors->first('explanation'), ''
          ) !!}

          {!! __form::textbox_numeric(
            '2', 'amount', 'text', 'Amount *', 'Amount', old('amount') ? old('amount') : $disbursement_voucher->amount, $errors->has('amount'), $errors->first('amount'), ''
          ) !!}

          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                  <div class="col-md-12">
                     {!! __form::textbox(
                      '8', 'certified_by', 'text', 'Certified by:', 'Certified by', old('certified_by') ? old('certified_by') : $disbursement_voucher->certified_by, $errors->has('certified_by'), $errors->first('certified_by'), 'data-transform="uppercase" list="certified_list"'
                    ) !!}
                    @php 
                      $certified_bys = App\Models\DisbursementVoucher::select('certified_by')->groupBy('certified_by')->get();
                    @endphp
                    <datalist id="certified_list">
                      @if($certified_bys->count() > 0)
                        @foreach($certified_bys as $certified_by)
                          <option>{{$certified_by->certified_by}}</option>
                        @endforeach
                      @endif
                    </datalist>

                    {!! __form::textbox(
                      '8', 'certified_by_position', 'text', 'Position', 'Position', old('certified_by_position') ? old('certified_by_position') : $disbursement_voucher->certified_by_position, $errors->has('certified_by_position'), $errors->first('certified_by_position'), 'data-transform="uppercase" list="certified_list_position"'
                    ) !!}

                    @php 
                      $certified_by_positions = App\Models\DisbursementVoucher::select('certified_by_position')->groupBy('certified_by_position')->get();
                    @endphp
                    <datalist id="certified_list_position">
                      @if($certified_by_positions->count() > 0)
                        @foreach($certified_by_positions as $certified_by_position)
                          <option>{{$certified_by_position->certified_by_position}}</option>
                        @endforeach
                      @endif
                    </datalist>

                  </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="panel panel-default">
              <div class="panel-body">
                  <div class="col-md-12">
                    {!! __form::textbox(
                    '8', 'approved_by', 'text', 'Approved for payment by:', 'Approved by',old('approved_by') ? old('approved_by') : $disbursement_voucher->approved_by, $errors->has('approved_by'), $errors->first('approved_by'), 'data-transform="uppercase" list="approved_list"'
                    ) !!}
                    @php 
                      $approved_bys = App\Models\DisbursementVoucher::select('approved_by')->where('approved_by','!=','-')->groupBy('approved_by')->get();
                    @endphp
                    <datalist id="approved_list">
                      @if($approved_bys->count() > 0)
                        @foreach($approved_bys as $approved_by)
                          <option>{{$approved_by->approved_by}}</option>
                        @endforeach
                      @endif
                    </datalist>

                    {!! __form::textbox(
                      '8', 'approved_by_position', 'text', 'Position', 'Position', old('approved_by_position') ? old('approved_by_position') : $disbursement_voucher->approved_by_position, $errors->has('approved_by_position'), $errors->first('approved_by_position'), 'data-transform="uppercase" list="approved_list_position"'
                    ) !!}

                     @php 
                      $approved_by_positions = App\Models\DisbursementVoucher::select('approved_by_position')->where('approved_by_position','!=','-')->groupBy('approved_by_position')->get();
                    @endphp
                    <datalist id="approved_list_position">
                      @if($approved_by_positions->count() > 0)
                        @foreach($approved_by_positions as $approved_by_position)
                          <option>{{strtoupper($approved_by_position->approved_by_position)}}</option>
                        @endforeach
                      @endif
                    </datalist>
                  </div>

              </div>
            </div>
        
          </div>

          

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection





@section('modals')

  {{-- DV CREATE SUCCESS --}}
  @if(Session::has('DV_CREATE_SUCCESS'))

    {!! __html::modal_print(
      'dv_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DV_CREATE_SUCCESS'), route('dashboard.disbursement_voucher.show', Session::get('DV_CREATE_SUCCESS_SLUG'))
    ) !!}

  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">
  
    @if(Session::has('DV_CREATE_SUCCESS'))
      $('#dv_create').modal('show');
    @endif

    {!! __js::ajax_select_to_select(
      'department_name', 'department_unit_name', '/api/select_response_department_units_from_department/', 'name', 'name'
    ) !!}

    {!! __js::ajax_select_to_select(
      'department_name', 'project_code', '/api/select_response_project_codes_from_department/', 'project_code', 'project_code'
    ) !!}

    $(function () {
      CKEDITOR.replace('editor');
    });

  </script>
    
@endsection