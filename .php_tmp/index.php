<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="max-w-6xl overflow-hidden">
  <div class="container">
    <h4 class="sent-notification"></h4>
    <form action="send.php" method="post" id="myForm" class="grid grid-cols-1 w-1/2 ml-[50%] mt-60">
      <div class="mb-4">
        <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
        <input type="text" id="name" name="name" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
      <div class="mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
      <div class="mb-4">
        <label for="subject" class="leading-7 text-sm text-gray-600">Subject</label>
        <input type="text" id="subject" name="subject" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
      </div>
      <div class="mb-4">
        <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
        <textarea type="text" id="message" name="message" id="body" rows="5" placeholder="Type Message" required class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
      </div>
      <button class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" type="submit" onclick="sendEmail()">Send</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript">
        function sendEmail(){
          let name = $("#name");
          let email = $("#email");
          let subject = $("#subject");
          let body = $("#body");

          if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)){
            $.ajax({
              url: 'send.php',
              method: 'POST',
              dataType: 'json',
              data: {
                name: name.val(),
                email: email.val(),
                subject: subject.val(),
                body: body.val(),
              }, success: function(response){
                $('myForm')[0].reset();
                $('.sent-notification').text("Message sent seccessfully.");
              }
            });
          }
        }
        function isNotEmpty(caller){
          if(caller,val()==""){
            caller.css('border', '1px solid red');
            return false;
          }
          else {
            caller.css ('border', '');
            return true;
          }
        }
    </script>


</body>

</html>