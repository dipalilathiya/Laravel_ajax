<!DOCTYPE html>
<html lang="en">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <form method="get" action="{{route('search')}}">
        <input type="text" id="ser" name="ser" class="form-control"placeholder="Search..." >
   </form> 

   <div id="search-results"></div>
 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{route('reg')}}" method="post" enctype="multipart/form-data" id="frmdata">
         @csrf
         <input type="hidden" name="id" value="" id="id">
        <p>Name</p>
        <input type="text" name="name" id="name"  value="">
        <p>Contact</p>
        <input type="text" name="contact" id="contact">
        <p>Email</p>
        <input type="email" name="email" id="email">
        <p>Password</p>
        <input type="password" name="password"  id="password">
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editdata">Save changes</button>
      </div>
    </div>
  </div>
</div> 
</form>

  <table border="1">
    <tr>
      <td>Name</td>
      <td>Contact</td>
      <td>Email</td>
      <td>Password</td>
      <td>Delete</td>
      <td>Update</td>
    </tr>
     <tbody id="dataShow">
     </tbody>
</table>
{{-- ajax link --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- bootstrap link --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){

    DataView()
  function DataView()
  {
    // alert()
      $.ajax({
               type:'GET',
               url: '{{route("viewdata")}}',
               data: {
                     "_token": "{{ csrf_token() }}",
                      },
                 success : function(response)
                {   
                  var html = ''
                  $.each(response , function(index, val){
                    html += '<tr><td>'+val.name+'</td><td>'+val.contact+'</td><td>'+val.email+'</td><td>'+val.password+'</td><td><a href="javascript:void(0)" class="delete" data-id=" '+val.id+'">Delete</a></td><td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="edit" data-eid=" '+val.id+'"> Edit</button</td><tr>'
                  })
                   $('#dataShow').html(html);
               }
      })
    }
    $(document).on('click' ,'.delete' ,function(){
      // alert('hello');
             var id = $(this).data('id')
             alert(id);
             $.ajax({
                   type:'POST',
                   url:'{{route("deleteData")}}',
                   data: {
                     "_token": "{{ csrf_token() }}",
                       "id": id
                      },
                   success:function(res){
                        // console.log(res);
                        if(res == 1)
                        {
                          DataView()
                        }         
                   }
             })
     })

     $(document).on('click' ,'#edit' ,function(){
         var id = $(this).data('eid')
          // alert(id);
            $.ajax({
                type: 'POST',
                url: '{{ route("edit")}}',
                data: {
                     "_token": "{{ csrf_token() }}",
                     "id": id
                 },
                success: function(res) {
                console.log(res);

                // $('#exampleModal').modal('show');
                  
                  $('#id').val(res.id)
                  $('#name').val(res.name)
                  $('#contact').val(res.contact)
                  $('#email').val(res.email)
                  $('#password').val(res.password)
                },
           });
 		});

     $(document).on('click','#editdata',function(){
         var formData = new FormData($('#frmdata')[0])
           $.ajax({
                      type:'POST',
                      url: '{{route("editData")}}',
                      data:formData,
                      contentType : false,
                      processData : false,
                     
                       success : function(response)
                      {
                        $('#exampleModal').modal('hide');
                        DataView()
                      }
                  })
                })
  })

$('#ser').on('keyup', function(){
  // alert('hello');
var text = $('#ser').val();
// alert(text)
$.ajax({
    type:"POST",
    url: '{{route("search")}}',
    data: {
                     "_token": "{{ csrf_token() }}",
                     text: text,
    },
    success: function(res) {
        // console.log(res);     
        var html = ''
                  $.each(res , function(index, val){
                    html += '<tr><td>'+val.name+'</td><td>'+val.contact+'</td><td>'+val.email+'</td><td>'+val.password+'</td><td><a href="javascript:void(0)" class="delete" data-id=" '+val.id+'">Delete</a></td><td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="edit" data-eid=" '+val.id+'"> Edit</button</td></tr>'
                  })
                  $('#dataShow').html(html);
     }
});
});
</script>
</body>
</html>