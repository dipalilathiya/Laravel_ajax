<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}
   </head>
<style>
     *{
        margin: 0;
        padding: 0;
        /* background-color: aliceblue; */
     }
     .box1{
        width: 400px;
        height: 450px;
        background-color: rgb(119, 112, 117);
        margin: auto;
        /* font-size: 20px;  */
        color: white;
        border: 4px solid darkgray;
        border-radius: 40px;
        margin-top: 200px;
        /* box-shadow:0px 0px 15px 0px black ; */

     }
     .box1 input{
        width:300px;
        height: 30px;
        margin-top: 10px;
        padding: 5px 8px;
        border-radius: 10px;
        border: none;
     }
     .box1 p{
        font-size: 20px;
        margin-top: 20px;
     }
     .box2{
        width: 300px;
        border: 1px solid rgb(119, 112, 117);
        height: 435px;
        background-color: rgb(119, 112, 117);
        /* font-size: 20px;  */
        color: white;
        margin: auto;
     }
     .box3 input
     {
        background-color:darkgray;
        color: white;
        width: 100px;
        height: 40px;
        border: 2px solid white;
        border-radius: 20px;
        margin-top: 10px;
     }
     .btn{
        text-decoration: none;
     }
     .btn i{
      color: gray;
     }
     .btn button{
      width: 50px;
      height: 30px;
      border-radius: 40px;
      border: none;
      border: 3px solid gray;
     }
     .msg{
      color: rgb(210, 24, 24);
      margin-left: 550px;
      font-size: 22px;
     }
</style>
<body>
    <div class="box1">
    <form id="frm">
      @csrf
         <div class="box2" >
         <p>Name</p>
         <input type="text" placeholder="Name" name="name">
         <p>Email</p>
         <input type="email" placeholder="Email" name="email">
         <p>Contact</p> 
         <input type="text" placeholder="Contact" name="contact">
         <p>Password</p>
         <input type="password" placeholder="Password" name="password">
         <div class="box3">
         {{-- <input type="submit" name="submit"> --}}
         <button id="formSubmit">Submit</button>
         </div>
         </div>
         </div>
    </form>
</body>
</html>
  <p id="data"></p>
  </table>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });  
      $(document).on('click','#formSubmit',function(){
      var formData = new FormData($('#frm')[0])
           $.ajax({
                      type:'POST',
                      url: '{{route("reg")}}',
                      data:formData,
                      contentType : false,
                      processData : false,
                      success : function(response)
                      {
                        console.log(response);     
                      }
      })
      })
   })
</script>