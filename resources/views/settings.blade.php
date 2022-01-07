@extends('fblayout.main')

@section('main')
    <div class="col-sm-6">
        <form action="{{ route('profile.edit',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("GET")
            <div class="text-center" onmouseover="showUploadButton();" onmouseout="hideUploadButton();">
                <div class="form-group button-image">
                    <img  style="height: 200px ; width:200px;" class="img-circle" src="{{asset(auth()->user()->photo?? '/images/no_user.jpg')}}">
                    <label onmouseover="showUploadButton();" class="btn btn-success image-upload" >
                        <input name="image" type="file" style="display: none;"/> Upload
                    </label>
                    <br><br>
                </div>
                <div class="form-group">
                    <button class="image-upload btn btn-success" style="display: none;" type="submit">Save</button>
                </div>
            </div>
        </form>

        <table style="width:100%" class="table table-striped">
            <tr>
                <td><strong>First Name</strong></td>
                <td id="first_name">{{ Auth::user()->fname }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('first_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Last Name</strong></td>
                <td id="last_name">{{ Auth::user()->lname }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('last_name');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>sex</strong></td>
                <td id="sex">{{ Auth::user()->sex==0?"female":"male" }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('sex');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td id="email">{{ Auth::user()->email }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('email');">
                        Edit
                    </button>
                </td>
            </tr>
            <tr>
                <td><strong>birthday</strong></td>
                <td id="birth_date">{{date("F j, Y",strtotime(Auth::user()->birthday))  }}</td>
                <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setField('birth_date');">
                        Edit
                    </button>
                </td>
            </tr>
        </table>
    </div>

    <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLongTitle"><b>Edit</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('profile.update',Auth::user()->id) }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-4">
                                <h4><label id="field_name" class="pull-right"></label></h4>
                                <input type="hidden" value="" id="p" name="field_name">
                            </div>
                            <div class="col-sm-8">
                                <input type="text" value="" id="field_value" name="x">
                            </div>
                        </div>
                        
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                   
                </div>
            </form>
            </div>
        </div>
    </div>

@endsection

@push('script')

<script type="text/javascript">

function setField(s){

document.getElementById("field_name").innerHTML=s;
document.getElementById("field_value").value=document.getElementById(s).innerHTML;
document.getElementById('p').value=s;


}
function hideUploadButton(){
            $('.image-upload').hide();
        }

        function showUploadButton(){
            $('.image-upload').show();
        }

</script>



@endpush