<?php

namespace App\Swep\ViewHelpers;

use Input;


class HtmlHelper{



    public static function modal($id, $header, $message){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			      <div class="modal-dialog">
			        <div class="modal-content">
			          <div class="modal-header">
			            <button class="close" data-dismiss="modal">
			              <span aria-hidden="true">&times;</span>
			            </button>
			            <h4 class="modal-title">'. $header .'</h4>

			          </div>
			          <div class="modal-body">
			            <p style="font-size: 17px;">'. $message .'</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			          </div>
			        </div>
			      </div>
			    </div>';
			    
    }



    public static function modal_delete($id){

       return '<div class="modal fade" id="'. $id .'" data-backdrop="static">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button class="close" data-dismiss="modal">
			            <span aria-hidden="true">&times;</span>
			          </button>
			          <h4 class="modal-title"><i class="fa fa-exclamation-circle "></i> Delete ?</h4>
			        </div>
			        <div class="modal-body" id="delete_body">
			          <form method="POST" id="form">
			            '. csrf_field() .'
			            <input name="_method" value="DELETE" type="hidden">
			            <p style="font-size: 17px;">Are you sure, you want to delete this record?</p>
			          </div>
			          <div class="modal-footer">
			            <button class="btn btn-default" data-dismiss="modal">Close</button>
			            <button type="submit" class="btn btn-danger">Delete</button>
			          </form>
			        </div>
			      </div>
			    </div>
			  </div>';
			    
    }



    public static function alert($type, $header, $message){

       return '<div class="alert alert-'. $type .' alert-dismissible">
	              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	              <h4>'. $header .'</h4>
	              '. $message .'
	            </div>';

    }
    


    public static function table_search($refresh_route){

       return '<div class="box-title">  
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input name="q" class="form-control pull-right" placeholder="Search any.." type="text" value="'. old("q") .'">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>

              <div class="box-tools">
                <a data-pjax href="'. $refresh_route .'" class="btn btn-sm btn-default">Refresh Data &nbsp;<i class="fa fa-refresh"></i></a>
              </div>';

    }



    public static function filter_open(){

       return '<div class="box '. self::collapsed_filter() .'">
		            <div class="box-header with-border" data-widget="collapse">
		                <h3 class="box-title">Advance Filters</h3>
		                <div class="box-tools pull-right">
		                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                </div> 
		            </div>
		            <div class="box-body">';

    }



    public static function filter_close(){

       return '</div>
            <button type="submit" id="submit_user_filter" style="display:none;">Filter</button>
        </div>';

    }


    /** UTILITY METHODS **/
    public static function collapsed_filter(){

       return Input::except('q', 'page') ? '' : 'collapsed-box';

    }



}