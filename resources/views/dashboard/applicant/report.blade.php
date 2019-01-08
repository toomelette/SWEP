@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Applicant Reports</h1>
  </section>

  <section class="content">




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Full List of Applicants</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="gl">

          {!! __form::select_dynamic(
            '3', 'du', 'Unit Applied', old('du'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('du'), $errors->first('du'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'c', 'Course', old('c'), $global_courses_all, 'course_id', 'name', $errors->has('c'), $errors->first('c'), 'select2', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




    <div class="box">
    
      <div class="box-header with-border">
        <h3 class="box-title">Shortlist of Applicants</h3>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form role="form" method="GET" autocomplete="off" action="{{ route('dashboard.applicant.report_generate') }}" target="_blank">

        <div class="box-body">

          <input type="hidden" name="r_type" value="sl">

          {!! __form::select_dynamic(
            '3', 'du', 'Unit Applied', old('du'), $global_department_units_all, 'department_unit_id', 'description', $errors->has('du'), $errors->first('du'), 'select2', ''
          ) !!}

          {!! __form::select_dynamic(
            '3', 'c', 'Course', old('c'), $global_courses_all, 'course_id', 'name', $errors->has('c'), $errors->first('c'), 'select2', ''
          ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-success">Generate <i class="fa fa-fw fa-refresh"></i></button>
        </div>

      </form>

    </div>




  </section>

@endsection