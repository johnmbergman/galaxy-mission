/*
Scrum of the Earth
Global Javascript functions for Galaxy Mission
*/ 


<script>

function uiMessageBox(uiTitle, uiMessage, imgSrc) {
/* 
|--------------------------------------------------------------|
|  Customized message box                                      | 
|  Takes string for title bar and body of Modal Dialog box and |
|  source location of image to be displayed in box             |
|  John Bergman - Adam Hill 3/16/15                            |
|--------------------------------------------------------------|
*/

   try {
      // Set the message
      var tempMessageBox = $("<div>").attr("class", "modal fade").append(
            $("<div>").attr("class", "modal-dialog").append(
               $("<div>").attr("class", "modal-content").append(

                  $("<div>").attr("class", "modal-header").append(
                     $("<h3>").attr("class", "modal-title").text(uiTitle)
                  )


               ).append(

                  $("<div>").attr("class", "modal-body").append(
                     $("<h3>").html(imgSrc).append(
                     $("<h3>").text(uiMessage))
                  )
                  

               ).append(

                  $("<div>").attr("class", "modal-footer").append(
                     $("<button>").attr("type", "button").attr("class", "btn btn-primary").attr("data-dismiss", "modal").text("OK")
                  )

               )
            )
         ).on("hidden.bs.modal", function () {
            $(this).remove();
         }).modal("show");

         $("body").append(tempMessageBox);
         tempMessageBox.modal("show");

   } catch (ex) {
      alert(uiMessage);
   }

}
</script>

