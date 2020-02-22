<?php
  
$span_sent = '<span class="badge bg-green">Sent</span>'; 
$span_failed = '<span class="badge bg-red">Failed</span>'; 

?>


@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Document Dissemination</h1>
      <div class="pull-right" style="margin-top: -25px;">
        {!! __html::back_button(['dashboard.document.index']) !!}
      </div>
  </section>

  <section class="content">

    <div class="box">

      <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.document.dissemination_post', $document->slug) }}">

        @csrf

        <div class="box-body">

          {{-- Navigation --}}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#email_dissemination" data-toggle="tab">Email Dissemination</a></li>
              <li><a href="#sent" data-toggle="tab">Sent</a></li>
            </ul>

            <div class="tab-content">


              {{-- Personal Info --}}
              <div class="tab-pane active" id="email_dissemination">
                <div class="row">   
                  <div class="col-md-12">


                      <div class="form-group col-md-12 {{ $errors->has('email_contact') ? 'has-error' : '' }}">
                        <label for="email_contact">Contacts: </label> <br>
                        <select name="email_contact[]" id="email_contact" class="form-control select2" multiple="multiple" data-placeholder="Recipients">
                            @foreach($global_email_contacts_all as $data)
                                @if(old('email_contact'))
                                    <option value="{{ $data->email_contact_id }}" {!! in_array($data->email_contact_id, old('email_contact')) ? 'selected' : '' !!}>{{$data->name}}</option>
                                @else
                                    <option value="{{ $data->email_contact_id }}">{{$data->name}}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('email_contact'))
                          <p class="help-block"> {{ $errors->first('email_contact') }} </p>
                        @endif
                      </div>
                      

                      <div class="form-group col-md-12 {{ $errors->has('employee') ? 'has-error' : '' }}" id="employee_div">
                        <label for="employee">Employees: </label> <br>
                        <select name="employee[]" id="employee" class="form-control select2" multiple="multiple" data-placeholder="Recipients">
                            @foreach($global_employees_all as $data)
                                @if(old('employee'))
                                    <option value="{{ $data->employee_no }}" {!! in_array($data->employee_no, old('employee')) ? 'selected' : '' !!}>{{$data->fullname}}</option>
                                @else
                                    <option value="{{ $data->employee_no }}">{{$data->fullname}}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('employee'))
                          <p class="help-block"> {{ $errors->first('subject') }} </p>
                        @endif
                      </div>


                      {!! __form::textbox(
                         '12', 'subject', 'text', 'Subject *', 'Subject', old('subject'), $errors->has('subject'), $errors->first('subject'), ''
                      ) !!}


                      {!! __form::textarea(
                         '12', 'content', 'Content', old('content'), $errors->has('content'), $errors->first('content'), ''
                      ) !!}


                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-default">Send <i class="fa fa-fw fa-envelope-o"></i></button>
                      </div>
                  </div>
                </div>
              </div>






              {{-- Family Info --}}
              <div class="tab-pane" id="sent">
                <div class="row">
                  <div class="col-md-12">

                      <table class="table table-hover">

                        <tr>
                          <th>Fullname</th>
                          <th>Email</th>
                          <th>Subject</th>
                          <th>Content</th>
                          <th>Status</th>
                        </tr>

                        <tbody>

                          @foreach ($document->documentDisseminationLog as $data)
                          
                            <tr>
                              @if (!empty($data->employee))
                                <td>{{ $data->employee->fullname }}</td>  
                              @else
                                <td>{{ $data->emailContact->name }}</td>
                              @endif
                              
                              <td>{{ $data->email }}</td>
                              <td>{{ Str::limit($data->subject, 30) }}</td>
                              <td>{{ Str::limit($data->content, 30) }}</td>
                              <td>{!! $data->status == 'SENT' ? $span_sent : $span_failed !!}</td>
                            </tr>
                            
                          @endforeach

                        </tbody>

                      </table>

                  </div>
                </div>
              </div>





            </div>
          </div>
        </div>

      </form>

    </div>

  </section>

@endsection





@section('modals')

  @if(Session::has('DISSEMINATION_SUCCESS'))
    {!! __html::modal('doc_dissemination', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DISSEMINATION_SUCCESS')) !!}
  @endif

@endsection 





@section('scripts')

  <script type="text/javascript">


    $('select[multiple]').select2({
        closeOnSelect: true,
    });


    @if(Session::has('DISSEMINATION_SUCCESS'))
      $('#doc_dissemination').modal('show');
    @endif

  </script> 
    
@endsection