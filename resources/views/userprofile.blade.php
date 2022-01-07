@extends('fblayout.main')

@section('main')
    <div class="col-sm-6">
       
    
            <div class="text-center" onmouseover="showUploadButton();" onmouseout="hideUploadButton();">
                <div class="form-group button-image">
                    <img  class="img-circle" src="{{ asset($x->photo) }}">
            
                </div>
           
            </div>
   

        <table style="width:100%" class="table table-striped">
            <tr>
                <td><strong>First Name</strong></td>
                <td id="first_name">{{ $x->fname }}</td>
             
            </tr>
            <tr>
                <td><strong>Last Name</strong></td>
                <td id="last_name">{{ $x->lname }}</td>
                
            </tr>
            <tr>
                <td><strong>sex</strong></td>
                <td id="sex">{{ $x->sex==0?"female":"male" }}</td>
            
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td id="email">{{ $x->email }}</td>
                <td>
                
                </td>
            </tr>
            <tr>
                <td><strong>birthday</strong></td>
                <td id="birth_date">{{date("F j, Y",strtotime($x->birthday))  }}</td>
                
            </tr>
        </table>
    </div>

   

@endsection
